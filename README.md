# Post-BE

Dokumen ini menjelaskan struktur proyek, teknologi yang digunakan, dan pustaka (library) utama dalam aplikasi ini.

## 1. Tech Stack (Teknologi yang Digunakan)

Aplikasi ini dibangun menggunakan teknologi berikut:

-   **Bahasa Pemrograman Backend**: PHP ^8.2
-   **Framework Backend**: Laravel Framework ^12.0
-   **Frontend Build Tool**: Vite ^7.0.7
-   **CSS Framework**: TailwindCSS ^4.0.0
-   **Database**: (Diasumsikan MySQL/PostgreSQL berdasarkan struktur Laravel standar, konfigurasi ada di `.env`)
-   **Testing**: PHPUnit ^11.5.3

## 2. Struktur Folder

Berikut adalah penjelasan fungsi umum dari setiap folder utama dalam proyek Laravel ini:

-   **`app/`**: Folder inti tempat sebagian besar logika aplikasi berada (Models, Controllers, Services, Middleware, dll).
-   **`bootstrap/`**: Berisi file untuk inisialisasi framework dan konfigurasi autoloading.
-   **`config/`**: Berisi semua file konfigurasi aplikasi (database, mail, auth, dll).
-   **`database/`**: Berisi migrasi database (`migrations`), seeders (isi data awal), dan factory.
-   **`public/`**: Folder root web yang dapat diakses publik. Berisi `index.php` sebagai entry point request dan aset statis (gambar, js, css hasil build).
-   **`resources/`**: Berisi aset yang belum di-compile (masih mentah) seperti view (Blade templates), file CSS/SASS/JS mentah, dan file bahasa (lang).
-   **`routes/`**: Tempat definisi seluruh route (jalur URL) aplikasi (api.php, web.php, console.php).
-   **`storage/`**: Tempat penyimpanan file yang digenerate oleh aplikasi, seperti log, cache, sesi file, dan file upload pengguna.
-   **`tests/`**: Berisi automated tests (Feature tests dan Unit tests).
-   **`vendor/`**: Folder tempat dependency Composer (library PHP) diinstall. Folder ini tidak boleh diedit langsung.

## 3. Libraries (Pustaka)

Berikut adalah library utama yang digunakan dalam proyek ini:

### PHP (via Composer)

-   **`laravel/framework`**: Inti dari framework Laravel.
-   **`laravel/sanctum`**: Untuk sistem autentikasi API (token based) yang ringan.
-   **`guzzlehttp/guzzle`**: HTTP client untuk melakukan request ke API eksternal.
-   **`laravel/tinker`**: REPL (Read-Eval-Print Loop) untuk berinteraksi dengan aplikasi Laravel via terminal.
-   **`fakerphp/faker`** (Dev): Untuk generate data palsu saat testing/seeding.
-   **`mockery/mockery`** (Dev): Untuk membuat mock object saat testing.
-   **`nunomaduro/collision`** (Dev): Error handler yang cantik untuk aplikasi console/terminal.

### JavaScript (via NPM)

-   **`axios`**: HTTP client berbasis Promise untuk browser dan node.js.
-   **`tailwindcss`**: Utility-first CSS framework untuk styling.
-   **`vite`**: Build tool frontend yang sangat cepat.
-   **`laravel-vite-plugin`**: Plugin integrasi Vite khusus untuk Laravel.
-   **`concurrently`**: Menjalankan beberapa perintah terminal secara bersamaan (misal: serve PHP dan build Vite).
