# Dashboard Laporan Penjualan
## Hosting
Link: (https://dashboard-penjualan-vercel-production.up.railway.app/)

🚀 Fitur
- Tabel untuk menampilkan data penjualan secara keseluruhan
- Total penjualan
- Grafik untuk visualisasi data seperti, tren penjualan berdasarkan tanggal
- filter data berdasarkan rentang tanggal

## Cara menjalankan
1. Clone repository
   - cd dashboard-penjualan-vercel
2. Install dependensi
   - composer install
   - cp .env.example .env
3. Atur konfigurasi environmennt
    DB_CONNECTION=mysql
    DB_HOST=your_db_host
    DB_PORT=3306
    DB_DATABASE=your_db_name
    DB_USERNAME=your_db_user
    DB_PASSWORD=your_db_password
4. Generate app key
   - php artisan key:generate
5. Migrasi database & seed data
   - php artisan migrate --seed
6. Jalankan server lokal
   - php artisan serve

🛠️ Tools yang Digunakan
- Laravel 10
- MySQL
- Railway (Deployment)
- TailwindCSS
