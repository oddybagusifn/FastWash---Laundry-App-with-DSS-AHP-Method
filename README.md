# FastWash App (Laravel)

Aplikasi **FastWash** adalah sistem manajemen laundry berbasis Laravel.  
Fitur utama:

- Manajemen bahan baku  
- Manajemen karyawan  
- Transaksi laundry (step 1 → 3)  
- Perhitungan HPP menggunakan AHP  
- Ringkasan transaksi & laporan biaya  

---

## Persiapan

Pastikan di komputer client sudah terpasang:

- PHP >= 8.1  
- Composer  
- MySQL / MariaDB  
- Node.js & npm (opsional untuk compile asset CSS/JS)  

---

## Cara Menjalankan Aplikasi

### 1️⃣ Clone Repository

```bash
git clone <REPOSITORY_URL>
cd fastwash-app

```

### 2️⃣ Install Dependencies
composer install


Jika menggunakan front-end (Tailwind / Vite):

```bash
npm install
npm run build
# atau live reload:
npm run dev

```


### 3️⃣ Setup Environment

Salin file .env.example menjadi .env:

```bash
cp .env.example .env
```
Edit .env sesuai konfigurasi lokal:


```bash
APP_NAME=FastWash
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fast_wash_app
DB_USERNAME=root
DB_PASSWORD=          # isi sesuai password database lokal
```


Pastikan database fast_wash_app sudah dibuat di MySQL.


### 4️⃣ Generate Key Laravel
```bash
php artisan key:generate
```

### 5️⃣ Jalankan Migrasi & Seeding
```bash
php artisan migrate --seed
```
Semua tabel database dan data awal (bahan baku, karyawan, overhead, dsb.) akan otomatis dibuat.

### 6️⃣ Serve Aplikasi
```bash
php artisan serve
```
Akses aplikasi di browser: http://localhost:8000

### 7️⃣ Login / Akses

Gunakan data user default (jika sudah ada seeding user admin) atau daftar akun baru.

### 8️⃣ Fitur Utama

Manajemen Bahan Baku – Tambah, edit, hapus stok bahan laundry.

Manajemen Karyawan – Tambah, edit, kelola gaji dan bagian karyawan.

Transaksi Laundry – Step 1 → 3, termasuk perhitungan HPP otomatis.

HPP AHP – Sistem menghitung Harga Pokok Produksi (biaya internal) per kg.

Ringkasan Transaksi – Total biaya, HPP, dan laporan konsistensi AHP.


### 9️⃣ Troubleshooting

Database not found → Pastikan database fast_wash_app sudah dibuat di MySQL.

Dependencies error → Jalankan ulang composer install.

CSS/JS tidak muncul → Jalankan npm run dev atau npm run build.

### 10️⃣ Tips

Gunakan .env lokal untuk konfigurasi database agar tidak menimpa data lain.

Backup .env sebelum mengubah pengaturan.

Semua migrasi & seeding sudah siap, sehingga aplikasi langsung bisa dijalankan.
