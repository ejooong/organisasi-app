# Panduan Deployment Aplikasi ke VPS (Laravel)

Panduan ini berisi langkah-langkah detail untuk meng-online-kan (deploy) **Sistem Keanggotaan Gerakan Indonesia Makmur** ke server VPS (seperti Niagahoster, DigitalOcean, AWS, atau VPS lainnya dengan OS Ubuntu Linux).

---

## 1. File yang DI-UPLOAD vs TIDAK DI-UPLOAD

Jangan asal *copy-paste* semua file, karena ada file yang sifatnya *local* atau berukuran sangat besar.

### ❌ JANGAN Di-upload (Kecualikan file/folder ini):
- Folder `vendor/` (Ukurannya besar. Kita akan install ulang di server).
- Folder `node_modules/` (Jika ada).
- File `.env` (File ini berisi konfigurasi lokal Anda, kita akan buat yang baru di server).
- Folder `.git/` (Jika Anda menggunakan Git).

### ✅ YANG HARUS Di-upload:
**Semua file dan folder sisanya**, seperti:
`app/`, `bootstrap/`, `config/`, `database/`, `public/`, `resources/`, `routes/`, `storage/`, `tests/`, `artisan`, `composer.json`, `composer.lock`, `package.json`, dll.

> [!TIP]
> **Cara termudah:**
> 1. Zip seluruh folder `organisasi-app` KECUALI folder `vendor` dan file `.env`.
> 2. Upload file `.zip` tersebut ke VPS via SFTP (FileZilla/Cyberduck) atau SCP.
> 3. *Ekstrak* file zip tersebut di dalam VPS.

---

## 2. Persiapan di VPS (Ubuntu)

Pastikan VPS Anda sudah terinstall komponen **LEMP Stack**:
1. **Nginx** (Web Server) atau Apache.
2. **PHP 8.2** (beserta ekstensi: `php-fpm, php-mysql, php-xml, php-mbstring, php-curl, php-zip, php-gd`).
3. **MySQL** / MariaDB.
4. **Composer** (Untuk mengunduh `vendor/`).

---

## 3. Langkah-langkah Instalasi di VPS

Setelah file aplikasi Anda berada di VPS (misalnya di direktori `/var/www/organisasi-app`), ikuti langkah via terminal/SSH berikut:

### Langkah 1: Masuk ke folder proyek
```bash
cd /var/www/organisasi-app
```

### Langkah 2: Install Dependensi PHP (Vendor)
Jalankan perintah ini untuk mengunduh ulang folder `vendor/` secara bersih dan dioptimasi untuk kecepatan (production):
```bash
composer install --optimize-autoloader --no-dev
```

### Langkah 3: Setup Environment
Salin file contoh konfigurasi dan ubah isinya.
```bash
cp .env.example .env
nano .env
```
Ubah bagian berikut di dalam file `.env`:
```ini
APP_NAME="Sistem Keanggotaan Gerakan Indonesia Makmur"
APP_ENV=production        # <--- Ubah ke production
APP_DEBUG=false           # <--- Wajib false agar error tidak tampil di publik
APP_URL=https://domain-anda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_db_di_vps
DB_USERNAME=user_db_di_vps
DB_PASSWORD=password_db_di_vps
```

Lalu, hasilkan Application Key baru:
```bash
php artisan key:generate
```

### Langkah 4: Setup Database & Storage
Migrasi tabel ke database VPS beserta akun super_admin awal:
```bash
php artisan migrate --seed
```

> [!IMPORTANT]
> Jalankan perintah berikut agar gambar (seperti Layout Kartu atau Pas Foto) bisa diakses publik:
```bash
php artisan storage:link
```

### Langkah 5: Optimasi Cache (Sangat Penting)
Agar aplikasi berjalan sangat cepat di *production*:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Langkah 6: Atur Hak Akses (Permissions)
Server web (biasanya `www-data`) harus memiliki hak akses untuk membaca dan menulis di folder `storage` dan `bootstrap/cache`.
```bash
sudo chown -R www-data:www-data /var/www/organisasi-app
sudo chmod -R 775 /var/www/organisasi-app/storage
sudo chmod -R 775 /var/www/organisasi-app/bootstrap/cache
```

---

## 4. Konfigurasi Web Server (Nginx)

Anda perlu memberi tahu VPS untuk mengarahkan domain web Anda ke folder `public/` milik Laravel.

Buat file konfigurasi Nginx:
```bash
sudo nano /etc/nginx/sites-available/organisasi-app
```
Isi dengan:
```nginx
server {
    listen 80;
    server_name domain-anda.com;
    root /var/www/organisasi-app/public; # <--- HARUS menunjuk ke folder public

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock; # Sesuaikan versi PHP
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Aktifkan konfigurasi dan *restart* Nginx:
```bash
sudo ln -s /etc/nginx/sites-available/organisasi-app /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

Selesai! Aplikasi Anda sekarang sudah online di VPS dan siap digunakan di *production*.
