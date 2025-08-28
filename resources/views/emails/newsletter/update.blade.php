<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Newsletter SETARA - Update Terbaru</title>
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
        .section {
            margin: 20px 0;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        .item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        .item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📰 Newsletter SETARA</h1>
        <p>Update terbaru dari dunia sastra Indonesia</p>
    </div>
    
    <div class="content">
        <h2>Halo, {{ $newsletter->email }}!</h2>
        <p>Berikut adalah update terbaru dari SETARA untuk Anda:</p>
        
        @if($latestNews->count() > 0)
        <div class="section">
            <h3>📰 Berita Terbaru</h3>
            @foreach($latestNews as $news)
            <div class="item">
                <h4>{{ $news->title }}</h4>
                <p>{{ Str::limit(strip_tags($news->content), 150) }}</p>
                <small>Dipublikasi: {{ $news->created_at->format('d F Y') }}</small>
                <br>
                <a href="{{ url('/berita/' . $news->slug) }}" class="btn">Baca Selengkapnya</a>
            </div>
            @endforeach
        </div>
        @endif
        
        @if($latestSastra->count() > 0)
        <div class="section">
            <h3>📖 Karya Sastra Terbaru</h3>
            @foreach($latestSastra as $sastra)
            <div class="item">
                <h4>{{ $sastra->title }}</h4>
                <p><strong>Kategori:</strong> {{ ucfirst(strtolower($sastra->category)) }}</p>
                <p>{{ Str::limit(strip_tags($sastra->body), 150) }}</p>
                <small>Dipublikasi: {{ $sastra->created_at->format('d F Y') }}</small>
                <br>
                <a href="{{ url('/pojok-cerita/open-book/' . $sastra->id) }}" class="btn">Baca Karya</a>
            </div>
            @endforeach
        </div>
        @endif
        
        <div class="section">
            <h3>🎯 Apa yang Menarik Minggu Ini?</h3>
            <ul>
                <li>📚 Tips menulis cerpen yang menarik</li>
                <li>🎭 Event literasi yang akan datang</li>
                <li>🏆 Kompetisi menulis bulanan</li>
                <li>💡 Inspirasi dari penulis terkenal</li>
            </ul>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/') }}" class="btn">Kunjungi Website SETARA</a>
        </div>
        
        <p><strong>Jangan lupa untuk:</strong></p>
        <ul>
            <li>Membagikan newsletter ini ke teman-teman</li>
            <li>Mengikuti kami di media sosial</li>
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
        <p>Tanggal kirim: {{ now()->format('d F Y H:i') }}</p>
    </div>
</body>
</html> 