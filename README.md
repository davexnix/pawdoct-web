# 🐾 PAWDOCT WEB

Web berbasis Laravel 12 dengan Tailwind CSS v4.

## 🧱 Tech Stack

- **Laravel** 12.x
- **PHP** ^8.3
- **MySQL** (5.7+ / 8.0+)
- **Tailwind CSS** v4
- **Vite** (for frontend asset build)
- **Node.js** via NVM
- **npm** for frontend package management

## 🚀 Quick Setup

### 1. Clone project

```bash
git clone https://github.com/username/pawdoct-web.git
cd pawdoct-web
```

### 2. Install PHP dependencies

Pastikan sudah menginstall PHP 8.3 dan Composer:

```bash
composer install
```

### 3. Setup Node.js via NVM (Node Version Manager)

Install NVM (jika belum):

```bash
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
source ~/.nvm/nvm.sh
```

Install dan gunakan versi Node.js yang sesuai:

```bash
nvm install 20
nvm use 20
```

Untuk menginstal **NVM (Node Version Manager)** di **Windows**, kamu tidak bisa menggunakan versi NVM yang biasa dipakai di Linux/macOS. Kamu harus menggunakan versi khusus untuk Windows yang disebut **nvm-windows**.

Berikut langkah-langkah installasi **nvm-windows**:


### ✅ 1. **Download nvm-windows**

* Kunjungi halaman GitHub resmi:
  👉 [https://github.com/coreybutler/nvm-windows/releases](https://github.com/coreybutler/nvm-windows/releases)

* Download file:
  **`nvm-setup.exe`** (biasanya yang terbaru paling atas)


### ✅ 2. **Install nvm-windows**

* Jalankan `nvm-setup.exe`.
* Ikuti langkah-langkah di installer:

  * Pilih direktori instalasi (default biasanya oke).
  * Pilih lokasi untuk folder Node.js (juga bisa default).


### ✅ 3. **Cek instalasi**

Setelah instalasi selesai, buka **Command Prompt (CMD)** atau **PowerShell**, lalu ketik:

```bash
nvm version
```

Jika berhasil, akan muncul versi dari `nvm`.


### ✅ 4. **Install Node.js dengan NVM**

Misalnya kamu ingin install Node.js versi 20:

```bash
nvm install 20
```

Lalu untuk mengaktifkan versi itu:

```bash
nvm use 20
```

Cek versi aktif:

```bash
node -v
```

---

### 🔁 Beberapa perintah penting NVM Windows:

```bash
nvm list              # Melihat versi Node.js yang terinstal
nvm install <versi>   # Install versi tertentu, contoh: nvm install 20
nvm use <versi>       # Gunakan versi tertentu
nvm uninstall <versi> # Hapus versi tertentu
```


Kalau kamu mengalami error seperti `node is not recognized`, pastikan restart terminal atau logout/login kembali.

### 4. Install Frontend Dependencies

```bash
npm install
```

### 5. Build Frontend Assets

```bash
npm run build
```

Untuk development:

```bash
npm run dev
```

### 6. Salin file `.env` dan konfigurasi

```bash
cp .env.example .env
php artisan key:generate
```

### 7. Setup Database

Pastikan database MySQL sudah dibuat dan informasi koneksi benar di `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pawdoct
DB_USERNAME=root
DB_PASSWORD=
```

Lalu jalankan migrasi:

```bash
php artisan migrate
```

### 8. Jalankan server lokal

```bash
php artisan serve
```

## ✅ Tips Tambahan

* Jalankan `php artisan migrate:fresh --seed` untuk menghapus dan mengisi ulang data awal.
* Pastikan ekstensi PHP berikut aktif: `pdo`, `mbstring`, `openssl`, `fileinfo`, `tokenizer`, `curl`.


## 📁 Struktur Penting

```
.
├── app/           # Core Laravel logic
├── database/      # Migration dan Seeder
├── public/        # Entry point aplikasi
├── resources/     # View, Tailwind, JS
├── routes/        # Web & API routes
└── vite.config.js # Konfigurasi Vite
```
