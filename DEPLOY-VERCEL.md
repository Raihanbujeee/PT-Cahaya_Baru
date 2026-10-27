# Deploy ke Vercel

Aplikasi ini adalah Laravel 12 + Filament 4, jadi butuh penyesuaian khusus
supaya bisa jalan di Vercel (serverless). Semua penyesuaian itu sudah
disiapkan di repo ini — dokumen ini menjelaskan cara deploy-nya.

---

## 1. File yang sudah disiapkan

| File | Fungsi |
| --- | --- |
| `api/index.php` | Entry point serverless. Membuat folder tulis di `/tmp`, mengarahkan cache/compiled view Laravel ke `/tmp`, lalu menjalankan aplikasi. |
| `vercel.json` | Mendaftarkan `api/index.php` sebagai function `vercel-php@0.7.4` (PHP 8.3), menjadikan `public/` sebagai output statis, dan meneruskan request lain ke Laravel. |
| `.vercelignore` | Supaya `vendor/`, `node_modules/`, `.env`, `storage/`, dan `tests/` tidak ikut di-upload. |
| `app/Providers/AppServiceProvider.php` | Memaksa URL HTTPS saat `APP_ENV=production`. |
| `bootstrap/app.php` | Route `/storage/{path}` untuk menyajikan gambar dari disk default (pengganti symlink `public/storage`). |

> Runtime PHP di Vercel tidak resmi (community runtime `vercel-php`).
> Versi `0.7.4` dipilih karena memakai PHP 8.3, sama dengan kebutuhan
> `composer.lock` proyek ini (minimal PHP 8.3).

---

## 2. Prasyarat

1. **Repo GitHub/GitLab** yang berisi project ini.
2. **Database eksternal** — Vercel tidak menyediakan database untuk PHP.
   Pilih salah satu:
   - **MySQL** (paling aman, tidak perlu ubah apa pun): Aiven, Clever Cloud,
     Railway, atau TiDB Cloud Serverless (kompatibel MySQL).
   - **PostgreSQL**: Neon / Supabase. Set `DB_CONNECTION=pgsql` dan
     `DB_PORT=5432` (migrasi proyek ini kompatibel dengan Postgres).
3. **Akun Vercel** (plan Hobby cukup).
4. Pilih region function & database yang sama, misal **Singapore (`sin1`)**,
   supaya tidak lambat.

---

## 3. Deploy lewat dashboard Vercel

1. Buka <https://vercel.com/new>, import repo project ini.
2. Pada bagian **Configure Project**:
   - **Framework Preset**: pilih **Other** (sudah dipaksa lewat
     `"framework": null` di `vercel.json`).
   - **Build Command**: kosongkan / biarkan override mati (tidak ada build
     front-end yang dibutuhkan — aset ada di `public/css` & `public/js`).
   - **Output Directory**: `public` (sudah diatur lewat
     `"outputDirectory": "public"` di `vercel.json`).
   - **Install Command**: biarkan default.
3. Isi **Environment Variables** (lihat tabel di bawah).
4. Klik **Deploy**.

### Bagaimana routing-nya bekerja

`vercel.json` memakai urutan route berikut:

1. `/`, `/index.php`, dan `/.htaccess` dipaksa masuk ke `api/index.php`
   (mencegah source code `public/index.php` ikut tersaji mentah).
2. `handle: filesystem` — semua file yang benar-benar ada di `public/`
   (`/css/...`, `/js/...`, `/images/...`, `/fonts/...`, `/favicon.ico`,
   `/robots.txt`, aset Filament) disajikan langsung oleh CDN Vercel.
3. Sisanya (`/produk`, `/admin`, `/livewire/...`, `/storage/...`) masuk ke
   Laravel lewat `api/index.php`.

Runtime `vercel-php` otomatis menjalankan `composer install` saat build, jadi
folder `vendor/` tidak perlu di-commit.

### Deploy lewat CLI

```bash
npm i -g vercel
vercel login
vercel link
vercel env add APP_KEY production   # ulangi untuk variabel lain
vercel --prod
```

---

## 4. Environment Variables di Vercel

Wajib:

| Variable | Contoh nilai | Keterangan |
| --- | --- | --- |
| `APP_NAME` | `TB Cahaya Baru` | Nama aplikasi. |
| `APP_ENV` | `production` | Wajib `production` agar HTTPS dipaksa. |
| `APP_KEY` | `base64:...` | Hasil `php artisan key:generate --show`. |
| `APP_DEBUG` | `false` | Jangan `true` di produksi. |
| `APP_URL` | `https://project-anda.vercel.app` | Harus URL final (termasuk custom domain). |
| `DB_CONNECTION` | `mysql` atau `pgsql` | Sesuai database yang dipakai. |
| `DB_HOST` | `...` | Host database. |
| `DB_PORT` | `3306` / `5432` | Port database. |
| `DB_DATABASE` | `cahayabaru` | Nama database. |
| `DB_USERNAME` | `...` | User database. |
| `DB_PASSWORD` | `...` | Password database. |

Disarankan:

| Variable | Nilai | Keterangan |
| --- | --- | --- |
| `SESSION_DRIVER` | `database` | Butuh tabel `sessions` (sudah ada di migrasi). Bisa juga `cookie`. |
| `CACHE_STORE` | `database` | Butuh tabel `cache` (sudah ada di migrasi). |
| `QUEUE_CONNECTION` | `sync` | Tidak ada worker di Vercel. |
| `LOG_CHANNEL` | `stderr` | Log muncul di dashboard Vercel → Logs. |
| `LOG_LEVEL` | `error` | Agar tidak terlalu ramai. |
| `FILESYSTEM_DISK` | `public` atau `s3` | Lihat bagian Gambar/Upload. |

Jangan isi `APP_CONFIG_CACHE`, `VIEW_COMPILED_PATH`, dan sejenisnya — sudah
diatur otomatis oleh `api/index.php` ke `/tmp`.

---

## 5. Migrasi database & akun admin

Jalankan dari komputer lokal, diarahkan ke database produksi. Cara paling
mudah: buat file `.env.production` (sudah di-`.gitignore`), isi kredensial
produksi, lalu:

```bash
# 1. Buat .env.production berisi kredensial DB produksi + APP_KEY produksi
cp .env.example .env.production

# 2. Jalankan migrasi
php artisan migrate --force --env=production

# 3. (Opsional) Isi data contoh + akun admin
php artisan db:seed --force --env=production
```

Seeder membuat admin default:

- Email: `admin@simtb.com`
- Password: `password`

**Segera ganti password** lewat menu admin, atau buat user baru:

```bash
php artisan make:filament-user --env=production
```

Halaman admin ada di `https://<domain>/admin`.

---

## 6. Gambar / upload file

Filesystem Vercel **read-only** dan `/tmp` tidak persisten. Artinya upload
gambar dari panel admin tidak akan tersimpan kalau memakai disk lokal.

Karena itu aplikasi ini punya dua lapis:

1. **Gambar bawaan** di `public/images/` (ikut ter-commit, tersaji CDN):
   - `public/images/produk/*.jpg` — foto contoh per jenis material.
   - `public/images/hero/*.jpg` — banner beranda, layanan, kontak, tentang.
   Dipakai otomatis kalau produk/setting belum punya gambar, atau kalau file
   unggahan sudah hilang (mis. setelah redeploy). Sumber & lisensi tiap file
   ada di `public/images/KREDIT.md` — sebaiknya diganti foto asli toko.
2. **Upload dari admin** (butuh object storage, lihat di bawah).

Pilih salah satu untuk upload:

**A. Simpel (gambar statis saja)** — taruh gambar di `public/images/…` dan
isi kolom gambar dengan URL tersebut. Upload dari admin tidak akan permanen.

**B. Object storage (disarankan untuk produksi)** — pakai S3 / Cloudflare R2 /
Supabase Storage:

```bash
composer require league/flysystem-aws-s3-v3 "^3.0"
```

Lalu set di Vercel:

```
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=...
AWS_BUCKET=...
AWS_URL=https://...          # opsional, untuk custom domain / R2 public URL
AWS_ENDPOINT=...             # untuk R2 / S3-compatible
AWS_USE_PATH_STYLE_ENDPOINT=false
```

Filament akan menyimpan upload ke disk `s3`, dan route `/storage/{path}`
otomatis menyajikan file tersebut (URL di halaman publik tetap
`/storage/...`, tidak perlu ubah view).

> Catatan: `composer require` di atas harus dijalankan sebelum deploy karena
> `vercel-php` meng-install dependency dari `composer.lock`.

---

## 7. Batasan Vercel yang perlu diketahui

- **Tidak ada queue worker** → `QUEUE_CONNECTION=sync`.
- **Tidak ada scheduler** → kalau butuh cron, pakai Vercel Cron yang memanggil
  route khusus.
- **Batas durasi function** (default 10 detik di Hobby) → hindari request
  panjang (import/export besar).
- **Cold start** ~250 ms–1 detik karena vendor + runtime PHP dimuat ulang.
- **Ukuran function** dibatasi ±250 MB (uncompressed). `vendor` proyek ini
  ±100 MB, masih aman.
- **Region**: set region function ke `sin1` (Singapore) di
  Settings → Functions, samakan dengan region database.

---

## 8. Troubleshooting

| Gejala | Penyebab & solusi |
| --- | --- |
| `The bootstrap/cache directory must be present and writable` | Pastikan request masuk lewat `api/index.php` (bukan `public/index.php`). Cek `routes` di `vercel.json` dan file `api/index.php` tidak diubah. |
| `No application encryption key has been specified` | `APP_KEY` belum diisi di Environment Variables Vercel. |
| Halaman tampil tanpa CSS/JS | Aset tidak tersaji dari `public/`. Pastikan `outputDirectory` tetap `public` dan route `handle: filesystem` tidak dihapus dari `vercel.json`, serta file memang ada di `public/css`, `public/js`, `public/images`. |
| Build gagal saat `composer install` / `package:discover` | Biasanya karena dependency butuh ekstensi PHP yang tidak ada di runtime. Cek log build, atau tambahkan `"config": {"platform": {"php": "8.3.0"}}` di `composer.json` agar resolusi dependency mengikuti PHP 8.3. |
| `SQLSTATE[HY000] [2002] Connection refused` | Host/port DB salah, atau database menolak koneksi dari luar. Vercel memakai IP keluar dinamis — jangan pakai allowlist IP ketat. Untuk Neon, pakai host `...-pooler...`. |
| `could not find driver` | `DB_CONNECTION` tidak cocok dengan driver (mis. `pgsql` tapi memakai MySQL). |
| Error saat upload gambar | Disk lokal read-only. Pakai opsi B (S3/R2) di atas. |
| 500 dan log kosong | Set `LOG_CHANNEL=stderr`, lalu buka tab **Logs** di deployment Vercel. |
| Session/CSRF error terus | Pastikan `APP_URL` benar dan `SESSION_DRIVER` konsisten. `cookie` adalah pilihan paling aman di serverless. |

Untuk smoke test, buka `https://<domain>/up` — Laravel mengembalikan HTTP 200
kalau aplikasi berhasil boot.

---

## 9. Development lokal tetap seperti biasa

File `api/index.php` hanya dipakai Vercel. Di lokal tetap:

```bash
php artisan serve
npm run dev
```

`vercel dev` tidak didukung oleh runtime PHP ini; gunakan `php artisan serve`.

Catatan: saat build di Vercel, runtime hanya menjalankan
`composer install --no-dev --no-scripts`, jadi tidak ada perintah artisan yang
dijalankan. Konsekuensinya:

- Aset Filament (`public/css/filament`, `public/js/filament`) **wajib sudah
  ter-commit**. Kalau habis upgrade Filament, jalankan dulu
  `php artisan filament:assets` lalu commit.
- `vendor/` dan `bootstrap/cache/*.php` tidak perlu di-commit.
