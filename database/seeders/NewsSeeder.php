<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Festival Sastra Nasional 2024: Merayakan Keindahan Bahasa Indonesia',
                'content' => 'Festival Sastra Nasional 2024 akan diselenggarakan di Jakarta pada bulan Juni mendatang. Acara yang digelar setiap dua tahun sekali ini akan menghadirkan berbagai kegiatan menarik seperti pembacaan puisi, diskusi sastra, workshop menulis, dan pameran buku.

Festival ini bertujuan untuk meningkatkan minat masyarakat terhadap sastra Indonesia dan melestarikan warisan budaya bangsa. Beberapa sastrawan ternama seperti Taufik Ismail, Sapardi Djoko Damono, dan Goenawan Mohamad akan hadir sebagai pembicara.

Selain itu, festival juga akan menampilkan pertunjukan musikalisasi puisi, teater sastra, dan berbagai kompetisi menulis untuk berbagai kategori usia. Acara ini terbuka untuk umum dan gratis.

"Kami berharap festival ini dapat menjadi wadah untuk menggali dan mengembangkan potensi sastra di Indonesia," kata Ketua Panitia Festival Sastra Nasional 2024.',
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Buku Baru: "Kumpulan Cerpen Remaja Indonesia"',
                'content' => 'Penerbit Gramedia Pustaka Utama baru saja meluncurkan buku "Kumpulan Cerpen Remaja Indonesia" yang berisi 25 cerita pendek karya penulis muda berbakat dari berbagai daerah di Indonesia.

Buku ini merupakan hasil dari program "Penulis Muda Berbakat" yang diselenggarakan oleh penerbit tersebut. Program ini bertujuan untuk menemukan dan mengembangkan talenta menulis di kalangan remaja.

Setiap cerita dalam buku ini memiliki tema yang berbeda-beda, mulai dari persahabatan, keluarga, cinta, hingga isu sosial yang relevan dengan kehidupan remaja masa kini. Bahasa yang digunakan mudah dipahami namun tetap memiliki nilai sastra yang tinggi.

"Kami sangat bangga dengan hasil karya para penulis muda ini. Mereka menunjukkan bahwa generasi muda Indonesia memiliki potensi besar dalam dunia sastra," ujar Editor Utama Penerbit Gramedia Pustaka Utama.

Buku ini sudah tersedia di seluruh toko buku Gramedia dan dapat dipesan secara online melalui website resmi penerbit.',
                'status' => 'published',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'title' => 'Workshop Menulis Puisi untuk Pemula',
                'content' => 'Komunitas Sastra Jakarta akan mengadakan workshop menulis puisi untuk pemula pada akhir pekan ini. Workshop yang akan diselenggarakan di Taman Ismail Marzuki ini terbuka untuk semua kalangan yang ingin belajar menulis puisi.

Workshop akan dipandu oleh penyair terkenal Indonesia, W.S. Rendra, yang akan membagikan teknik-teknik dasar dalam menulis puisi. Peserta akan diajarkan tentang pemilihan kata, rima, irama, dan struktur puisi yang baik.

Selama workshop, peserta akan diberikan waktu untuk menulis puisi sendiri dan kemudian membacakannya di depan peserta lain. Setiap puisi akan mendapat feedback dari pemandu workshop dan peserta lainnya.

"Workshop ini bertujuan untuk memberikan pemahaman dasar tentang menulis puisi dan memotivasi peserta untuk terus berkarya," kata Koordinator Komunitas Sastra Jakarta.

Workshop akan berlangsung selama 4 jam dengan biaya pendaftaran sebesar Rp 100.000. Peserta akan mendapatkan sertifikat dan buku panduan menulis puisi.',
                'status' => 'published',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
} 