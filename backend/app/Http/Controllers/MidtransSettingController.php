<?php

namespace App\Http\Controllers;

use App\Models\MidtransSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransSettingController extends Controller
{
    public function index()
    {
        $setting = MidtransSetting::first();
        return view('admin.midtrans.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'server_key' => 'required',
            'client_key' => 'required',
            'is_production' => 'required|boolean',
        ]);

        MidtransSetting::updateOrCreate(['id' => 1], $request->only([
            'server_key',
            'client_key',
            'is_production'
        ]));

        return back()->with('success', 'Midtrans setting berhasil disimpan.');
    }

    public function testConnection(Request $request)
    {
        try {
            $serverKey = trim($request->input('server_key'));
            $isProduction = $request->input('is_production') == 1;

            $url = $isProduction
                ? 'https://app.midtrans.com/snap/v1/transactions'
                : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

            $auth = base64_encode($serverKey . ':');

            $payload = [
                "transaction_details" => [
                    "order_id" => "order-test-" . uniqid(),
                    "gross_amount" => 1000
                ],
                "customer_details" => [
                    "first_name" => "Tes",
                    "email" => "tes@example.com"
                ]
            ];

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . $auth,
                'Content-Type' => 'application/json',
            ])->post($url, $payload);

            $data = $response->json();

            if ($response->successful() && isset($data['token'])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Koneksi ke Midtrans berhasil.',
                    'snap_token' => $data['token'],
                    'redirect_url' => $data['redirect_url'] ?? null,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => $data['status_message'] ?? 'Koneksi gagal.',
                    'midtrans_response' => $data,
                ], $response->status());
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan internal: ' . $e->getMessage(),
            ], 500);
        }
    }

    // public function test()
    // {
    //     $serverKey = 'SB-Mid-server-QRtgjZ_A3NeNsAOculx9vuLk'; // Sandbox key
    //     $auth = base64_encode($serverKey . ':');

    //     $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';

    //     $payload = [
    //         'transaction_details' => [
    //             'order_id' => 'order-test-' . uniqid(),
    //             'gross_amount' => 1000
    //         ],
    //         'customer_details' => [
    //             'first_name' => 'Tes',
    //             'email' => 'tes@example.com'
    //         ]
    //     ];

    //     $response = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Authorization' => 'Basic ' . $auth,
    //         'Content-Type' => 'application/json',
    //     ])->post($url, $payload);

    //     $data = $response->json();

    //     if ($response->successful() && isset($data['token'])) {
    //         return response()->json([
    //             'status' => 'success',
    //             'token' => $data['token'],
    //             'redirect_url' => $data['redirect_url'] ?? null
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $data['status_message'] ?? 'Koneksi gagal.',
    //             'midtrans_response' => $data,
    //         ], $response->status());
    //     }
    // }
}
