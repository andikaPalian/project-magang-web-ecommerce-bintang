# 🛒 TI MART - Omnichannel E-Commerce & POS ERP System

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4.svg?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1.svg?logo=mysql)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC.svg?logo=tailwind-css)
![Architecture](https://img.shields.io/badge/Architecture-MVC-orange.svg)

**TI MART** adalah sistem *Enterprise Resource Planning* (ERP) berskala ringan yang memadukan platform E-Commerce (B2C) dengan *Point of Sale* (POS) Toko Fisik secara terintegrasi (Omnichannel). Dibangun menggunakan arsitektur MVC (Model-View-Controller) PHP Native dengan antarmuka bergaya **Neo-Brutalism** yang responsif, tangguh, dan interaktif.

---

## 🚀 Latar Belakang & Arsitektur Sistem

Sistem ini dirancang untuk mengatasi masalah pemisahan data antara penjualan *online* dan *offline*. TI MART menggunakan standar arsitektur **Global Master Data** pada katalog produk, di mana relasi inventaris fisik diikat berdasarkan titik lokasi (`location_id`). 

Dengan sistem ini, Gudang Pusat dapat menyuplai barang ke berbagai Toko Cabang secara *real-time*. Setiap cabang memiliki sistem POS serta inventarisnya masing-masing secara independen, namun tetap bermuara pada satu buku besar (*Ledger*) logistik dan keuangan di tingkat pusat.

---

## 🛠️ Tech Stack

* **Backend:** PHP (Native / Custom MVC Framework)
* **Database:** MySQL / MariaDB (Relasional)
* **Frontend:** HTML5, Tailwind CSS (Neo-Brutalism UI Design)
* **JavaScript:** Vanilla JS, Fetch API (AJAX Interactivity)
* **Keamanan:** Password Hashing (Bcrypt), Anti SQL Injection (PDO Prepared Statements / Binding).

---

## 👥 Fitur Utama Berdasarkan Hak Akses (Role-Based Access Control)

Sistem ini memiliki 6 tingkat otoritas pengguna dengan hak akses eksklusif:

### 1. 🏪 Admin Toko (OPERATIONS.SYS)
Divisi kasir untuk operasional toko fisik (Cabang).
* **POS System:** Mesin kasir interaktif dengan fitur *Live Search*, Keranjang (*Cart*), dan perhitungan kembalian otomatis.
* **Payment Gateway Simulation:** Mendukung simulasi pembayaran QRIS (Auto-Generate Barcode), Tunai (Cash), dan EDC/Debit.
* **Inventaris Lokal:** Memantau sisa stok fisik khusus di cabang tersebut dengan indikator warna (*Low Stock Alert* / *Critical*).
* **History Log:** Buku besar pencatatan riwayat transaksi harian.

### 2. 📦 Gudang (WAREHOUSE & FULFILLMENT)
Divisi manajemen logistik dan pergerakan barang.
* **Inbound:** Penerimaan stok barang baru dari *supplier* ke Gudang Pusat.
* **Outbound (B2C):** Manajemen daftar pesanan E-Commerce dan *Verifikasi Handover* paket kepada pihak ekspedisi.
* **Internal Transfer (B2B):** Distribusi pemindahan stok dari Gudang Pusat ke Toko Cabang secara *real-time* menggunakan *Database Transaction* (Aman dari kegagalan sinkronisasi data).

### 3. 💻 Admin Web (MASTER DATA MANAGEMENT)
Pusat kendali inti aplikasi utama.
* **User Management:** Menambah, mengedit, dan menghapus staf serta menetapkan penempatan lokasi dinamis (Pusat/Cabang) menggunakan *Dropdown* relasional.
* **Product Management:** Mengelola *Global Master Data* produk, menetapkan harga, berat, gambar, manajemen spesifikasi dinamis (RAM, Storage, dll), dan manajemen kategori.

### 4. 🛵 Ekspedisi (LOGISTICS FLEET)
Divisi pengiriman jalur darat.
* Memantau antrean *pickup* barang dari Loading Dock Gudang.
* Memperbarui status rute pengiriman (*Shipped* menjadi *Delivered*).

### 5. 👑 Pemilik (EXECUTIVE SUITE)
Dasbor analitik untuk manajemen level-C (C-Level).
* Memantau total laba/pendapatan (*Finance*).
* Melihat performa penjualan keseluruhan cabang dan E-commerce (*Radar Analytics*).

### 6. 👤 Pembeli (CUSTOMER)
* Mendaftar, melihat katalog E-commerce, memasukkan ke keranjang (*Cart*), dan melakukan transaksi pembelian (*Checkout*).

---

## ⚙️ Panduan Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di mesin lokal Anda:

1.  **Clone Repository:**
    ```bash
    git clone [https://github.com/username-anda/website-ecommerce-bintang.git](https://github.com/username-anda/website-ecommerce-bintang.git)
    cd website-ecommerce-bintang
    ```

2.  **Persiapkan Server Lingkungan:**
    * Pastikan Anda telah menginstal **XAMPP**, **MAMP**, atau **Laragon** dengan PHP versi 8.x ke atas.
    * Pindahkan folder proyek ke dalam direktori `htdocs` (jika menggunakan XAMPP) atau `www`.

3.  **Setup Database:**
    * Buka phpMyAdmin (`http://localhost/phpmyadmin`).
    * Buat database baru dengan nama `ecommerce_bintang`.
    * Import file `ecommerce_bintang.sql` yang terdapat di dalam *repository* ke database tersebut.

4.  **Konfigurasi Koneksi:**
    * Buka file konfigurasi utama di `app/core/Config.php`.
    * Sesuaikan `BASEURL` dan kredensial *database* Anda:
        ```php
        define('BASEURL', 'http://localhost/website-ecommerce-bintang/public');
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'ecommerce_bintang');
        ```

5.  **Jalankan Aplikasi:**
    * Buka *browser* dan akses: `http://localhost/website-ecommerce-bintang/public`

---

## 🔐 Akun Akses Pengujian (Testing Accounts)

Gunakan akun berikut untuk melakukan pengujian masing-masing modul di aplikasi:

| Role | Email | Password | Penempatan Lokasi |
| :--- | :--- | :--- | :--- |
| **Admin Web** | `admin@timart.com` | `rahasia123` | *Global* |
| **Pemilik** | `pemilik@gmail.com` | `rahasia123` | *Global* |
| **Admin Toko** | `kasir1@timart.com` | `rahasia123` | *Cabang Panakkukang* |
| **Gudang** | `gudang@gmail.com` | `rahasia123` | *Gudang Pusat Bintang* |
| **Ekspedisi** | `speedy@timart.com` | `rahasia123` | *Fleet A* |
| **Pembeli** | `johndoe@email.com`| `rahasia123` | - |

*(Catatan: Anda juga dapat membuat akun baru melalui modul Admin Web)*

---

## 📸 Screenshots UI / UX (Neo-Brutalism Theme)

*(Silakan ganti link gambar di bawah dengan hasil screenshot dari aplikasi Anda sesungguhnya)*

<details>
  <summary><b>Klik untuk melihat Screenshot POS System (Admin Toko)</b></summary>
  <img src="https://via.placeholder.com/800x400.png?text=Screenshot+Point+of+Sale" alt="POS System">
</details>

<details>
  <summary><b>Klik untuk melihat Screenshot Modul Outbound (Gudang)</b></summary>
  <img src="https://via.placeholder.com/800x400.png?text=Screenshot+Outbound+Logistics" alt="Outbound Module">
</details>

<details>
  <summary><b>Klik untuk melihat Screenshot User & Product Management (Admin Web)</b></summary>
  <img src="https://via.placeholder.com/800x400.png?text=Screenshot+Data+Management" alt="Data Management">
</details>

---

## 📄 Lisensi

Didistribusikan di bawah Lisensi MIT. Lihat `LICENSE` untuk informasi lebih lanjut.

---
*Architecture & Code by Andika Palian.*
