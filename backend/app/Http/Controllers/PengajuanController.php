<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Nasabah;
use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
    // Tampilkan semua pengajuan
    public function index()
    {
        $pengajuans = Pengajuan::with('nasabah')->get();
        return response()->json($pengajuans);
    }

    // Tampilkan form pengajuan (kalau pake blade view, kalau API biasanya nggak perlu)
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'jenis_pengajuan' => 'required|in:konsumtif,produktif,darurat',
                'jumlah_dana' => 'required|numeric|min:500000|max:10000000',
                'deskripsi_penggunaan' => 'required|string',
                'bukti_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'swafoto_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'jenis_pengajuan.required' => 'Jenis pengajuan wajib dipilih.',
                'jenis_pengajuan.in' => 'Jenis pengajuan tidak valid.',

                'jumlah_dana.required' => 'Jumlah dana wajib diisi.',
                'jumlah_dana.numeric' => 'Jumlah dana harus berupa angka.',
                'jumlah_dana.min' => 'Jumlah dana minimal Rp100.000.',
                'jumlah_dana.max' => 'Jumlah dana maksimal Rp10.000.000.',

                'deskripsi_penggunaan.required' => 'Keterangan penggunaan wajib diisi.',
                'deskripsi_penggunaan.string' => 'Keterangan penggunaan harus berupa teks.',

                'bukti_ktp.required' => 'File KTP wajib diunggah.',
                'bukti_ktp.file' => 'File KTP tidak valid.',
                'bukti_ktp.mimes' => 'Format file KTP harus berupa JPG, JPEG, PNG, atau PDF.',
                'bukti_ktp.max' => 'Ukuran file KTP maksimal 2MB.',

                'swafoto_ktp.required' => 'File swafoto dengan KTP wajib diunggah.',
                'swafoto_ktp.file' => 'File swafoto tidak valid.',
                'swafoto_ktp.mimes' => 'Format swafoto harus berupa JPG, JPEG, PNG, atau PDF.',
                'swafoto_ktp.max' => 'Ukuran file swafoto maksimal 2MB.',
            ]);

            $user = $request->user();

            $buktiKtpPath = $request->file('bukti_ktp')->store('ktp', 'public');
            $swafotoPath = $request->file('swafoto_ktp')->store('swafoto', 'public');

            // Hitung jatuh tempo: hari ini + 6 bulan + 7 hari
            $jatuhTempo = Carbon::now()->addMonths(6)->addDays(7);

            Pengajuan::create([
                'nasabah_id' => $user->nasabah->id,
                'jenis_pengajuan' => $request->jenis_pengajuan,
                'jumlah_dana' => $request->jumlah_dana,
                'status' => 'pending',
                'status_verifikasi' => 'belum diverifikasi',
                'deskripsi_penggunaan' => $request->deskripsi_penggunaan,
                'bukti_ktp' => $buktiKtpPath,
                'swafoto_ktp' => $swafotoPath,
                'jatuh_tempo' => $jatuhTempo,
            ]);

            return redirect()->back()->with('success', 'Pengajuan berhasil dikirim.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:terverifikasi,verifikasi ditolak',
            'catatan' => 'nullable|string',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status_verifikasi = $request->status_verifikasi;
        $pengajuan->catatan = $request->catatan;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Status verifikasi berhasil diperbarui.');
    }

    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

        // Buat pesan dinamis berdasarkan status
        $statusLabel = [
            'pending' => 'menunggu konfirmasi',
            'disetujui' => 'disetujui',
            'ditolak' => 'ditolak',
        ];

        $pesan = 'Pengajuan telah ' . $statusLabel[$request->status] . '.';

        return redirect()->back()->with('success', $pesan);
    }


    public function showTagihan($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        // 1. Ambil tanggal awal pengajuan
        $startDate = Carbon::parse($pengajuan->created_at)->startOfDay();

        // 2. Hitung jatuh tempo (6 bulan dari tanggal pengajuan)
        $jatuhTempo = $startDate->copy()->addMonths(6);

        // 3. Hitung batas denda (7 hari setelah jatuh tempo)
        $batasDenda = $jatuhTempo->copy()->addDays(7);

        // 4. Cek apakah sudah lewat dari batas denda
        $hariIni = now(); // Ganti now() dengan tanggal simulasi jika perlu
        $kenaDenda = $hariIni->greaterThan($batasDenda);

        // 5. Hitung nilai denda jika terlambat
        if ($kenaDenda) {
            $mingguTerlambat = ceil($batasDenda->diffInDays($hariIni) / 7);
            $denda = ceil($pengajuan->jumlah_dana * 0.01 * $mingguTerlambat); // 1% per minggu
        } else {
            $denda = 0;
        }

        // 6. Ambil semua pembayaran dan statusnya
        $pembayaranBulan = DB::table('pembayarans')
            ->where('pengajuan_id', $pengajuan->id)
            ->select('bulan', 'status') // format bulan: Y-m
            ->get()
            ->groupBy('bulan');

        // 7. Hitung nominal per bulan (dibagi 6x)
        $jumlahPerBulan = floor($pengajuan->jumlah_dana / 6);
        $sisa = $pengajuan->jumlah_dana - ($jumlahPerBulan * 5);

        // 8. Buat daftar 6 bulan
        $bulanList = [];
        $sudahDibayar = 0;

        for ($i = 0; $i < 6; $i++) {
            $bulan = $startDate->copy()->addMonths($i);
            $formatBulan = $bulan->format('Y-m');
            $nominal = ($i < 5) ? $jumlahPerBulan : $sisa;

            // Cek status dari DB
            $statusPembayaran = $pembayaranBulan[$formatBulan][0]->status ?? null;
            $status = $statusPembayaran === 'success' ? 'lunas' : 'belum';

            // Tambahkan ke total sudah dibayar kalau lunas
            if ($status === 'lunas') {
                $sudahDibayar += $nominal;
            }

            $bulanList[] = [
                'nama' => $bulan->translatedFormat('F Y'),
                'format' => $formatBulan,
                'nominal' => $nominal,
                'status' => $status,
            ];
        }

        // 9. Kirim ke view
        return view('admin.tagihan.index', compact(
            'pengajuan',
            'bulanList',
            'sudahDibayar',
            'denda',
            'jatuhTempo',
            'batasDenda'
        ));
    }

    // public function bayar(Request $request)
    // {
    //     $user = $request->user();
    //     $pengajuanId = $request->pengajuan_id;
    //     $bulan = $request->bulan; // array bulan format 'YYYY-MM'
    //     $total = $request->total;

    //     // Cek apakah sudah ada pembayaran pending untuk bulan-bulan tersebut
    //     $pembayaran = Pembayaran::where('pengajuan_id', $pengajuanId)
    //         ->whereIn('bulan', $bulan)
    //         ->where('status', 'pending')
    //         ->first();

    //     if ($pembayaran) {
    //         // Jika sudah ada pending, pakai snap_token yang lama
    //         return response()->json(['token' => $pembayaran->snap_token]);
    //     }

    //     // Jika belum ada, buat pembayaran baru
    //     $orderId = 'ORDER-' . uniqid() . '-' . time();

    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => $orderId,
    //             'gross_amount' => (int) $total,
    //         ],
    //         'customer_details' => [
    //             'first_name' => auth()->$user->name ?? 'User',
    //             'email' => auth()->$user->email ?? 'user@mail.com',
    //         ],
    //     ];

    //     $snapToken = \Midtrans\Snap::getSnapToken($params);

    //     // Simpan pembayaran untuk tiap bulan (misalnya bulan = ['2025-06', '2025-07'])
    //     foreach ($bulan as $bln) {
    //         Pembayaran::create([
    //             'pengajuan_id' => $pengajuanId,
    //             'order_id' => $orderId,
    //             'bulan' => $bln,
    //             'nominal' => floor($total / count($bulan)), // optional: bagi rata
    //             'status' => 'pending',
    //             'snap_token' => $snapToken,
    //         ]);
    //     }

    //     return response()->json(['token' => $snapToken]);
    // }

    public function bayar(Request $request)
    {
        $user = $request->user();
        $pengajuanId = $request->pengajuan_id;
        $bulan = $request->bulan; // array format 'YYYY-MM'
        $total = $request->total;

        $snapTokens = [];
        foreach ($bulan as $bln) {
            // Cek apakah sudah ada pembayaran pending untuk bulan ini
            $existing = Pembayaran::where('pengajuan_id', $pengajuanId)
                ->where('bulan', $bln)
                ->where('status', 'pending')
                ->first();

            if ($existing) {
                $snapTokens[] = $existing->snap_token;
                continue;
            }

            $orderId = 'ORDER-' . uniqid() . '-' . time() . '-' . str_replace('-', '', $bln);

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => $user->name ?? 'User',
                    'email' => $user->email ?? 'user@mail.com',
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $snapTokens[] = $snapToken;

            Pembayaran::create([
                'user_id' => $user->id,
                'pengajuan_id' => $pengajuanId,
                'order_id' => $orderId,
                'bulan' => $bln,
                'nominal' => floor($total / count($bulan)),
                'status' => 'pending',
                'snap_token' => $snapToken,
            ]);
        }

        return response()->json(['token' => $snapTokens[0]]);
    }

    public function updateStatusManual(Request $request)
    {
        $pengajuanId = $request->input('pengajuan_id');

        if (!$pengajuanId) {
            return response()->json(['message' => 'pengajuan_id is required'], 400);
        }

        $pembayarans = Pembayaran::where('pengajuan_id', $pengajuanId)
            ->where('status', 'pending')
            ->get();

        if ($pembayarans->isEmpty()) {
            return response()->json(['message' => 'No pending payments found for this pengajuan_id'], 404);
        }

        foreach ($pembayarans as $pembayaran) {
            $pembayaran->status = 'success';
            $pembayaran->dibayar_pada = now();
            $pembayaran->save();
        }

        return response()->json(['message' => 'Payments status updated to success']);
    }





    // Tampilkan detail pengajuan
    public function show($id)
    {
        $pengajuan = Pengajuan::with('nasabah')->findOrFail($id);
        return response()->json($pengajuan);
    }

    // Update pengajuan
    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $request->validate([
            'jenis_pengajuan' => 'sometimes|string',
            'jumlah_dana' => 'sometimes|numeric|min:100000',
            'status' => 'sometimes|string',
            'keterangan' => 'nullable|string',
        ]);

        $pengajuan->update($request->all());

        return response()->json([
            'message' => 'Pengajuan berhasil diupdate',
            'data' => $pengajuan
        ]);
    }

    // Hapus pengajuan
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return response()->json([
            'message' => 'Pengajuan berhasil dihapus'
        ]);
    }
}
