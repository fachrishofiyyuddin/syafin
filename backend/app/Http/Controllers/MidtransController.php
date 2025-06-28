<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Log;
use Midtrans\Transaction;

class MidtransController extends Controller
{
    // public function callback(Request $request)
    // {
    //     Log::info('MIDTRANS CALLBACK:', $request->all());

    //     $serverKey = config('midtrans.server_key');

    //     $orderId      = $request->input('order_id');
    //     $statusCode   = $request->input('status_code');
    //     $grossAmount  = $request->input('gross_amount');
    //     $signatureKey = $request->input('signature_key');

    //     // Normalize gross_amount to 2 decimal places
    //     $formattedAmount = number_format((float)$grossAmount, 2, '.', '');

    //     $expectedSignature = hash('sha512', $orderId . $statusCode . $formattedAmount . $serverKey);

    //     // Logging untuk debugging signature
    //     Log::info("SIGNATURE DEBUG", [
    //         'expected' => $expectedSignature,
    //         'received' => $signatureKey,
    //         'order_id' => $orderId,
    //         'gross_amount' => $grossAmount,
    //         'status_code' => $statusCode,
    //     ]);

    //     if ($signatureKey !== $expectedSignature) {
    //         Log::warning("Invalid signature for order_id: $orderId");
    //         return response()->json(['message' => 'Invalid signature'], 403);
    //     }

    //     try {
    //         $status = Transaction::status($orderId);
    //         Log::info("Transaction status for $orderId: {$status->transaction_status}");

    //         if (in_array($status->transaction_status, ['settlement', 'capture'])) {
    //             Pembayaran::where('order_id', $orderId)
    //                 ->update([
    //                     'status' => 'success',
    //                     'dibayar_pada' => now(),
    //                 ]);
    //             Log::info("Pembayaran updated to success for $orderId");
    //         } elseif (in_array($status->transaction_status, ['deny', 'expire', 'cancel'])) {
    //             Pembayaran::where('order_id', $orderId)
    //                 ->update([
    //                     'status' => 'failed',
    //                     'dibayar_pada' => null,
    //                 ]);
    //             Log::info("Pembayaran updated to failed for $orderId");
    //         }
    //     } catch (\Exception $e) {
    //         Log::error("Error checking transaction status: " . $e->getMessage());
    //     }

    //     return response()->json(['message' => 'Callback processed']);
    // }

    public function callback(Request $request)
    {
        Log::info('SIMPLE CALLBACK RECEIVED:', $request->all());

        $orderId = $request->input('order_id');
        $status = $request->input('transaction_status');

        // Cari pembayaran yang cocok berdasarkan order_id
        $pembayaran = Pembayaran::where('order_id', $orderId)->first();

        if (!$pembayaran) {
            Log::warning("Pembayaran dengan order_id $orderId tidak ditemukan.");
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Tentukan status berdasarkan dari Midtrans
        if (in_array($status, ['settlement', 'capture'])) {
            $pembayaran->status = 'success';
        } elseif (in_array($status, ['deny', 'expire', 'cancel'])) {
            $pembayaran->status = 'failed';
        } else {
            $pembayaran->status = 'pending';
        }

        $pembayaran->dibayar_pada = now(); // jika ada field ini
        $pembayaran->save();

        Log::info("Pembayaran {$pembayaran->order_id} updated to {$pembayaran->status}");

        return response()->json(['message' => 'Callback processed']);
    }
}
