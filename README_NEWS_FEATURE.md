# Fitur Berita - Jelita v1

## Deskripsi
Fitur berita memungkinkan admin untuk mengelola berita dengan judul, content, dan gambar, serta user dapat melihat berita yang dipublikasi.

## Fitur yang Tersedia

### Untuk Admin:
1. **Kelola Berita** (`/admin/news`)
   - Melihat daftar semua berita
   - Menambah berita baru
   - Mengedit berita yang ada
   - Menghapus berita
   - Mengatur status berita (draft/published)

2. **Form Berita**
   - Input judul berita
   - Input content berita (textarea)
   - Upload gambar berita (JPEG, PNG, JPG, GIF, max 2MB)
   - Pilihan status (draft/published)
   - Preview gambar sebelum upload

### Untuk User:
1. **Daftar Berita** (`/berita`)
   - Melihat berita yang dipublikasi
   - Layout card dengan gambar dan preview content
   - Pagination
   - Link ke detail berita

2. **Detail Berita** (`/berita/{slug}`)
   - Tampilan lengkap berita
   - Gambar berita
   - Content lengkap
   - Berita terkait
   - Tombol share ke social media
   - Breadcrumb navigation

## Struktur Database

### Tabel `news`:
- `id` - Primary key
- `title` - Judul berita
- `content` - Isi berita
- `image` - Nama file gambar (nullable)
- `slug` - URL-friendly title (unique)
- `status` - Status berita (published/draft)
- `created_at` - Timestamp pembuatan
- `updated_at` - Timestamp update

## File yang Dibuat/Dimodifikasi

### Controllers:
- `app/Http/Controllers/Admin/NewsController.php` - Admin CRUD berita
- `app/Http/Controllers/NewsController.php` - User view berita

### Models:
- `app/Models/News.php` - Model berita dengan auto-slug

### Views:
- `resources/views/admin/news/index.blade.php` - Admin daftar berita
- `resources/views/admin/news/create.blade.php` - Admin form tambah berita
- `resources/views/admin/news/edit.blade.php` - Admin form edit berita
- `resources/views/news/index.blade.php` - User daftar berita
- `resources/views/news/show.blade.php` - User detail berita

### Routes:
- Admin: `/admin/news/*` (CRUD operations)
- User: `/berita` (index), `/berita/{slug}` (show)

### Database:
- Migration: `database/migrations/2024_01_01_000000_create_news_table.php`
- Seeder: `database/seeders/NewsSeeder.php`

## Cara Penggunaan

### 1. Setup Database
```bash
php artisan migrate
php artisan db:seed --class=NewsSeeder
```

### 2. Akses Admin Panel
- Login sebagai admin
- Buka `/admin/news`
- Gunakan fitur CRUD untuk mengelola berita

### 3. Akses User View
- Buka `/berita` untuk melihat daftar berita
- Klik berita untuk melihat detail lengkap

## Fitur Tambahan

### Image Management:
- Gambar disimpan di `storage/app/public/news/`
- Auto-resize dan optimization
- Fallback icon jika tidak ada gambar

### SEO Friendly:
- URL menggunakan slug dari judul
- Meta tags untuk social sharing
- Clean URL structure

### Responsive Design:
- Mobile-friendly layout
- Bootstrap 5 components
- Font Awesome icons

### Security:
- File upload validation
- CSRF protection
- Admin middleware protection

## Dependencies
- Laravel 10+
- Bootstrap 5
- Font Awesome 6
- jQuery (untuk admin features)

## Notes
- Pastikan symbolic link storage sudah dibuat: `php artisan storage:link`
- Folder `storage/app/public/news/` harus writable
- Image validation: max 2MB, format: JPEG, PNG, JPG, GIF
- Status berita: draft (tidak terlihat user), published (terlihat user) 