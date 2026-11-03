# Inventaris Aset Kantor

Aplikasi web untuk mencatat aset kantor (laptop, monitor, dan sejenisnya).
Dibuat untuk tes praktik coding (90 menit).

**Stack:** PHP 8.2+, Laravel 12, MySQL (XAMPP / phpMyAdmin), Bootstrap 5 (CDN)

## Cara Menjalankan

Prasyarat: PHP >= 8.2, Composer, Git, dan XAMPP (MySQL aktif).

1. Clone repository
    ```bash
    git clone https://github.com/Ziyadrifqi/inventaris_aset_test.git
    cd inventaris_aset_test
    ```
2. Install dependency
    ```bash
    composer install
    ```
3. Salin file environment dan buat app key
    ```bash
    copy .env.example .env      # Windows (Linux/Mac: cp .env.example .env)
    php artisan key:generate
    ```
4. Jalankan **MySQL** di XAMPP Control Panel, lalu buat database kosong
   bernama `inventaris_aset` lewat phpMyAdmin (`http://localhost/phpmyadmin`).
   Collation: `utf8mb4_unicode_ci`.
5. Cek konfigurasi database di `.env` (default XAMPP):
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=inventaris_aset
    DB_USERNAME=root
    DB_PASSWORD=
    ```
6. Jalankan migration dan seeder
    ```bash
    php artisan migrate:fresh --seed
    ```
7. Jalankan server
    ```bash
    php artisan serve
    ```
    Buka http://127.0.0.1:8000 lalu login.

Catatan: Bootstrap dan ikon dimuat lewat CDN, jadi tidak perlu `npm install`,
tetapi butuh koneksi internet saat membuka aplikasi.

## Akun Demo

| Role  | Email              | Password    |
| ----- | ------------------ | ----------- |
| Admin | admin@farpoint.com | Password123 |
| Staff | staff@farpoint.com | Password123 |

Seeder membuat 1 admin, 1 staff, 3 kategori (Laptop, Monitor, Perangkat Lainnya),
dan 12 aset contoh.

## Hak Akses

| Fitur                                   | Admin | Staff |
| --------------------------------------- | :---: | :---: |
| Login / logout                          |  Ya   |  Ya   |
| Lihat daftar, cari, filter, detail aset |  Ya   |  Ya   |
| Akses API `/api/assets`                 |  Ya   |  Ya   |
| Tambah / ubah / hapus aset              |  Ya   | Tidak |

Pembatasan ditegakkan **di sisi server**, bukan hanya dengan menyembunyikan tombol:

- Middleware `admin` (`AdminOnly`) pada route create, store, edit, update, dan destroy.
- `authorize()` pada `AssetRequest` (lapis kedua).

Staff yang membuka `/assets/create` secara langsung akan mendapat **403**.

## Fitur

- Login dan logout; semua halaman hanya untuk pengguna yang sudah login.
- Daftar aset: pagination 10 per halaman, pencarian nama/kode, filter kategori
  dan status. Nama kategori dimuat dengan eager loading (`with('category')`)
  sehingga tidak ada N+1 query. Filter tetap terbawa saat pindah halaman.
- CRUD aset (admin) dengan modal konfirmasi sebelum hapus.
- Validasi: kode unik, nama wajib, nilai numerik >= 0, kategori harus ada.
  Pesan error tampil di form dan isian lama tidak hilang.
- Tampilan responsif dengan Bootstrap 5 (navbar, tabel responsif, form rapi,
  pesan sukses setelah simpan atau hapus).
- API JSON berpaginasi.

## API

```
GET /api/assets
GET /api/assets?status=tersedia
GET /api/assets?status=dipinjam&page=2
```

- Mengembalikan JSON berpaginasi (10 per halaman) berisi `kode`, `nama`,
  `kategori`, dan `status`.
- Nilai `status` yang valid: `tersedia`, `dipinjam`, `rusak`.
  Nilai lain menghasilkan respons **422**.
- Endpoint memakai session login, jadi harus login dulu di browser.

Contoh respons (dipersingkat):

```json
{
    "data": [
        {
            "kode": "AST-001",
            "nama": "Laptop Dell Latitude 5440",
            "kategori": "Laptop",
            "status": "tersedia"
        }
    ],
    "links": { "...": "..." },
    "meta": { "current_page": 1, "per_page": 10, "total": 12 }
}
```

## Struktur Singkat

```
app/Http/Controllers/AuthController.php      login & logout
app/Http/Controllers/AssetController.php     daftar, detail, CRUD
app/Http/Controllers/AssetApiController.php  API JSON
app/Http/Middleware/AdminOnly.php            pembatas role admin
app/Http/Requests/AssetRequest.php           validasi + otorisasi
app/Http/Resources/AssetResource.php         format JSON API
app/Models/{User,Category,Asset}.php
database/migrations, database/seeders
resources/views/{layouts,partials,auth,assets}
public/css/app.css
```

## Testing

```bash
php artisan test
```

Test memakai SQLite in-memory (bawaan `phpunit.xml`). Jika muncul error
"could not find driver", aktifkan `extension=pdo_sqlite` dan `extension=sqlite3`
di `php.ini` XAMPP.

## Asumsi yang Diambil

- Autentikasi dibuat manual (login/logout saja, tanpa Breeze) agar tidak
  bercampur dengan Tailwind bawaan Breeze. Tidak ada registrasi; user dibuat lewat seeder.
- Role disimpan sebagai kolom `role` (`admin` atau `staff`) di tabel `users`.
- `/api/assets` diletakkan di `routes/web.php` dengan middleware `auth`
  (autentikasi session), konsisten dengan aturan "semua halaman hanya untuk
  pengguna yang sudah login".
- Semua kolom aset wajib diisi. Tanggal beli tidak boleh di masa depan.
- Hapus aset bersifat permanen (hard delete).
- Bootstrap 5 dimuat lewat CDN.
- Kode aset diinput manual oleh admin dan divalidasi unik.

## Status Fitur

**Requirement wajib:** semua selesai (setup & seeder, autentikasi & role,
CRUD dengan pembatasan server-side, daftar aset dengan pencarian/filter/pagination
tanpa N+1, validasi, tampilan responsif, API).
