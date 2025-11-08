# 🛍️ Epoy_Store - Sistem Jual Beli Pakaian

Proyek ini merupakan sistem jual beli pakaian berbasis web yang dibangun menggunakan **Laravel 10**, **PHP 9**, dan **Laragon v6.0.0**.  
Fitur utama meliputi tampilan produk, detail produk, testimoni pelanggan, serta halaman admin untuk mengelola data produk.  
Proses transaksi saat ini masih dilakukan secara manual melalui **WhatsApp**, tanpa integrasi pembayaran otomatis.

---

## ⚙️ 1. Setting Web Service & Konfigurasi Web

### Persiapan Lingkungan
1. Install **Laragon v6.0.0**  
   Unduh di: [https://laragon.org/download](https://laragon.org/download)
2. Pastikan versi:
   - **PHP**: 9.x
   - **Composer**: sudah terpasang (`composer -v`)
3. Clone project ke folder `C:\laragon\www`  
   ```bash
   git clone https://github.com/username/Epoy_Store.git
   cd Epoy_Store

Instalasi Dependensi
composer install
npm install && npm run dev

Konfigurasi file .env
Buat file .env dan sesuaikan:
```
APP_NAME=Epoy_Store
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://epoy-store.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=epoy_store
DB_USERNAME=root
DB_PASSWORD= `
```
Migrasi Database
`php artisan migrate --seed`

Jalankan Server
`php artisan serve`

Atau gunakan Laragon → klik Start All → buka `http://epoy-store.test.`

# 🧩 2. Business Process (Proses Bisnis)

![Logo Epoy Store](public/image/busines.png)

1. Pelanggan
    - Akses Halaman Home/Produk
    - Lihat Detail & Tertarik?
    - Kirim Pesan Otomatis ke Admin via WhatsApp
    - Lakukan Pembayaran (Transfer/QR)
      
2. Sistem Epoy_Store (Laravel)
   - Menampilkan Katalog Produk & Testimoni
   - Generate Tautan WhatsApp dengan Detail Produk
   - Menampilkan Produk/Stok Update

3. Admin (WA & Halaman Admin)
   - Terima Pesan WA & Negosiasi
   - Verifikasi Bukti Transfer
   - Proses Pesanan & Kirim Produk)
   - Halaman Admin

# 🗃️ 3. Model Data (Struktur Database)

![Logo Epoy Store](public/image/modeldata.png)


| Nama Tabel      | Deskripsi                            | Kolom Utama                                                           |
| --------------- | ------------------------------------ | --------------------------------------------------------------------- |
| **categories**  | Menyimpan kategori produk            | `id`, `name`                                                          |
| **products**    | Menyimpan data produk                | `id`, `category_id`, `name`, `description`, `price`, `stock`, `image` |
| **testimonies** | Menyimpan ulasan/testimoni pelanggan | `id`, `customer_name`, `message`, `rating`                            |
| **users**       | Menyimpan akun admin                 | `id`, `name`, `email`, `password`                                     |

# 👥 4. Schema Tim Proyek
👥 Skema Tim Proyek “Epoy_Store” (4 Orang)

| No | Nama Jabatan                              | Peran Utama                             | Tanggung Jawab                                                                                                               |
| -- | ----------------------------------------- | --------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- |
| 1  | **Project Manager & System Analyst**      | Pengarah dan perencana sistem           | Menentukan fitur utama, alur sistem, dan jadwal pengerjaan. Membuat dokumentasi kebutuhan sistem dan ERD database.           |
| 2  | **Backend Developer (Laravel Developer)** | Pengembang logika server                | Membuat model, controller, migration, dan fitur CRUD (produk, kategori, testimoni, admin). Mengatur redirect WhatsApp order. |
| 3  | **Frontend Developer (Blade + Tailwind)** | Pengembang tampilan website             | Mendesain dan membuat tampilan halaman home, produk, detail produk, testimoni, serta dashboard admin.                        |
| 4  | **QA Tester & Deployment Engineer**       | Penguji dan penanggung jawab deployment | Melakukan testing semua fitur, memperbaiki bug, menulis dokumentasi, dan melakukan upload proyek ke hosting/domain.          |

🗓️ Timeline Pengembangan (7 Minggu)

| Minggu | Tahapan Pekerjaan                                                          | Penanggung Jawab                     |
| :----: | :------------------------------------------------------------------------- | :----------------------------------- |
|    1   | Analisis kebutuhan sistem & desain alur (DFD, ERD)                         | Project Manager & System Analyst     |
|    2   | Desain UI/UX & struktur database                                           | Project Manager & Frontend Developer |
|   3–4  | Pengembangan backend (CRUD produk, kategori, testimoni, WhatsApp redirect) | Backend Developer                    |
|    5   | Pengembangan frontend (Blade + Tailwind)                                   | Frontend Developer                   |
|    6   | Pengujian fitur dan perbaikan bug                                          | QA Tester                            |
|    7   | Dokumentasi dan deployment ke hosting/domain                               | QA Tester & PM                       |



