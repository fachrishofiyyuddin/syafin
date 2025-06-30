<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Notifikasi Pengajuan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 30px auto;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #4F46E5;
        }

        .highlight {
            background-color: #f0f0ff;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .footer {
            margin-top: 40px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>📄 Pengajuan Berhasil Dikirim</h2>
        <p>Halo,</p>
        <p>Pengajuan dana kamu telah berhasil dikirim dan sedang dalam proses verifikasi.</p>

        <p>No. Pengajuan kamu:</p>
        <div class="highlight">
            {{ $nomorPengajuan }}
        </div>

        <p>Silakan tunggu maksimal 2x24 jam untuk mendapatkan informasi status pengajuanmu.</p>

        <p>Terima kasih telah menggunakan layanan <strong>Syafin</strong>.</p>

        <div class="footer">
            &copy; {{ date('Y') }} Syafin App – All rights reserved.
        </div>
    </div>
</body>

</html>
