<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Newsletter SETARA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Selamat Datang di SETARA!</h1>
        <p>Terima kasih telah berlangganan newsletter kami</p>
    </div>
    
    <div class="content">
        <h2>Halo!</h2>
        <p>Terima kasih telah berlangganan newsletter SETARA. Sekarang Anda akan mendapatkan update terbaru tentang:</p>
        
        <ul>
            <li>📰 Berita terbaru dari dunia sastra</li>
            <li>📖 Karya sastra baru dari penulis lokal</li>
            <li>🎭 Event dan kegiatan literasi</li>
            <li>💡 Tips menulis dan inspirasi</li>
            <li>🏆 Kompetisi dan lomba menulis</li>
        </ul>
        
        <p>Kami akan mengirimkan newsletter setiap minggu dengan konten terbaik untuk Anda.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/') }}" class="btn">Kunjungi Website SETARA</a>
        </div>
        
        <p><strong>Jangan lupa untuk:</strong></p>
        <ul>
            <li>Mengikuti kami di media sosial</li>
            <li>Membagikan karya sastra favorit Anda</li>
            <li>Berpartisipasi dalam diskusi literasi</li>
        </ul>
        
        <p>Jika Anda ingin berhenti berlangganan, silakan klik link di bawah ini:</p>
        <p style="text-align: center;">
            <a href="{{ url('/newsletter/unsubscribe/' . $newsletter->email) }}" style="color: #666; text-decoration: underline;">
                Berhenti Berlangganan
            </a>
        </p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} SETARA - Platform Sastra Digital</p>
        <p>Email ini dikirim ke: {{ $newsletter->email }}</p>
        <p>Tanggal berlangganan: {{ $newsletter->subscribed_at->format('d F Y H:i') }}</p>
    </div>
</body>
</html> 