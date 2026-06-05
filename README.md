# Bintaro Land Property

Website listing properti premium untuk area Bintaro dan sekitarnya. Dibangun dengan Laravel 11, Tailwind CSS, dan MySQL.

## Tech Stack

- **Backend:** Laravel 11 (PHP 8.2+)
- **Database:** MySQL 5.7+ / MariaDB 10.3+
- **Frontend:** Blade + Tailwind CSS
- **Build Tool:** Vite
- **Icons:** Heroicons (SVG)

## Fitur

- Dark mode toggle dengan localStorage
- Responsive design (mobile-first)
- Filter properti berdasarkan kategori, kondisi, dan pencarian
- Detail properti dengan tombol WhatsApp CTA
- Pagination
- SEO-friendly URL dengan slug

## Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer 2.x
- Node.js 18+ dan npm
- MySQL 5.7+ atau MariaDB 10.3+
- Extension PHP: `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`

## Instalasi

### 1. Clone atau Extract Project

```bash
cd bintaro-property
```

### 2. Install Dependencies PHP

```bash
composer install --no-dev --optimize-autoloader
```

Untuk development:
```bash
composer install
```

### 3. Install Dependencies Node.js

```bash
npm install
```

### 4. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
APP_NAME="Bintaro Land Property"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bintaro_property
DB_USERNAME=root
DB_PASSWORD=your_password

WHATSAPP_NUMBER=6281234567890
```

### 5. Create Database

```bash
mysql -u root -p -e "CREATE DATABASE bintaro_property CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Seed Database

```bash
php artisan db:seed
```

### 8. Build Assets

Development:
```bash
npm run dev
```

Production:
```bash
npm run build
```

### 9. Create Storage Link

```bash
php artisan storage:link
```

### 10. Start Development Server

```bash
php artisan serve
```

Akses website di: http://localhost:8000

## Deployment ke Shared Hosting (cPanel)

### 1. Upload File

Upload semua file ke public_html (atau subdomain folder).

### 2. Atur Document Root

Document root harus mengarah ke folder `public/`:
- Jika menggunakan subdomain, arahkan document root ke `public_html/subdomain/public`
- Atau rename folder `public/` menjadi `public_html/` (untuk main domain)

### 3. Konfigurasi .env

```bash
cp .env.example .env
```

Edit `.env`:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_cpanel_db_name
DB_USERNAME=your_cpanel_db_user
DB_PASSWORD=your_db_password

WHATSAPP_NUMBER=6281234567890
```

### 4. Set Permissions

```bash
chmod -R 775 storage bootstrap/cache
chmod -R 775 public/build
```

### 5. Run Migrations & Seed

Akses terminal di cPanel atau gunakan phpMyAdmin untuk import struktur database.

```bash
php artisan migrate --force
php artisan db:seed --force
```

### 6. Build untuk Production

```bash
npm run build
```

### 7. Konfigurasi .htaccess (sudah tersedia di public/.htaccess)

## Perintah Artisan

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Cache untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database refresh dengan seed
php artisan migrate:fresh --seed
```

## Struktur Database

### Tabel

- **categories** - Kategori properti (Sekitar Bintaro, Luar Bintaro, Khusus Developer)
- **conditions** - Kondisi properti (Baru, Second)
- **properties** - Data properti
- **category_property** - Pivot table kategori-properti
- **condition_property** - Pivot table kondisi-properti

### Relasi

- Property `belongsToMany` Category
- Property `belongsToMany` Condition

## API Endpoint / Routes

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | home | Homepage dengan listing & filter |
| GET | `/properti/{property}` | property.show | Detail properti |
| GET | `/kategori/{category}` | category.show | Filter by category |
| POST | `/cari` | search | Search redirect |

## Konfigurasi WhatsApp

Ubah nomor WhatsApp di `.env`:
```env
WHATSAPP_NUMBER=6281234567890
```

Format nomor: 62 (Indonesia) + nomor tanpa 0 di depan.

## License

MIT License
