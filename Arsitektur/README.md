# 🏛️ Arsitektur

Website ini adalah sistem E-Commerce untuk jasa dan produk arsitektur, dibangun menggunakan **PHP Native** dan **MySQL** tanpa framework, serta mengandalkan kombinasi **Bootstrap 5**, **Tailwind CSS**, dan berbagai library CDN untuk tampilan yang menarik dan fungsionalitas modern.

URL Aplikasi: [http://arsitektur.beauty/](http://arsitektur.beauty/)

---

## ✨ Fitur

- 🔐 Autentikasi Login dan Session Management
- 🧑‍💼 CRUD Data Akun (Admin & Pengunjung)
- 🖼️ Hero Section (Background Gambar, Judul Tengah)
- 🏷️ Produk Grid: Gambar, Judul, Deskripsi, Harga, Rating, Tombol Detail dan Tombol Keranjang
- 📄 Detail Produk: Judul, Gambar Produk, Deskripsi, Fitur Utama, Spesifikasi Teknis, Tim Proyek, Galeri Proyek, Tombol Checkout
- 💳 Halaman Checkout: Email, Nama, No Telepon, Metode Pembayaran, Total, Tombol Struk
- 🛒 Keranjang Kuning: Ikon dan tombol keranjang berwarna kuning untuk menarik perhatian pengguna dan meningkatkan pengalaman pengguna saat menambahkan produk 
- ℹ️ About Section: Profile, Nama, Karir, Deskripsi, Tombol Hubungi
- 📩 Form Kontak dengan penyimpanan ke database
- 📊 Dashboard Statistik Pengguna, Produk, Transaksi (Chart.js)
- 📈 Tabel Interaktif dengan DataTables (search, sort, pagination)
- ✨ Animasi Masuk saat scroll dengan AOS
- 📝 Editor Konten menggunakan CKEditor
- 📁 Upload & Preview Foto Profil
- 📂 Halaman Tambah & Edit Akun dengan Validasi
- 🛑 Konfirmasi Aksi dengan SweetAlert2
- 📉 Grafik interaktif jumlah pengguna per role
- 📱 Desain responsif (Bootstrap + Tailwind CSS)
- 🌐 URL Friendly & proteksi folder via `.htaccess`

---

## ⚙️ Teknologi yang Digunakan

| Teknologi | Deskripsi |
|----------|-----------|
| 🧠 **PHP** | Bahasa pemrograman utama untuk logika server-side, pemrosesan form, autentikasi, dan interaksi database tanpa framework tambahan. |
| 🗄️ **MySQL** | Basis data relasional untuk menyimpan informasi akun, kontak, dan login. |
| 🎨 **Bootstrap** | FraFramework CSS responsif yang menyediakan grid system, komponen UI, dan utilitas siap pakai.|
| 💨 **Tailwind CSS** | Utility-first CSS framework yang memberikan kendali penuh terhadap tampilan dengan class minimalis.|
| 🧱 **W3.CSS** | Framework CSS ringan untuk mendukung elemen UI tambahan secara cepat.|
| 📊 **DataTables** |– Untuk membuat tabel interaktif dengan fitur pencarian, sortir, dan pagination otomatis.|
| 📈 **Chart.js** | Library JavaScript untuk menampilkan data dalam bentuk grafik interaktif (Bar, Pie, Line).|
| 🛠️ **Font Awesome** | Icon SVG & web fonts yang digunakan untuk memperindah antarmuka pengguna.|
| 🔮 **jQuery**      | Library JavaScript dasar untuk DOM manipulation & AJAX |
| 🚀 **SweetAlert2** | Library popup modern untuk notifikasi aksi pengguna (contoh: sukses tambah data, konfirmasi hapus).|
| 💫 **AOS (Animate On Scroll)** | Library CSS/JS untuk menambahkan animasi masuk saat elemen terlihat di layar.|
| 📝 **CKEditor** | Rich text editor untuk input konten dinamis seperti deskripsi dan artikel.|
| 🌐 **.htaccess** | Digunakan untuk Mengaktifkan URL Rewrite, Redirect halaman, Membatasi akses folder tertentu (keamanan).|

---

## 📂 Struktur Folder
```
└── 📦 kelwasit
    └── 📂.history
    └── 📂.vscode
    └── 📂controllers
        ├── 📜 produkController.php
        ├── 📜 transaksiController.php
    └── 📂database
        ├── 📜 code.sql
    └── 📂pages
        ├── 📜 checkout.php
        ├── 📜 detail_produk.php
        ├── 📜 keranjang.php
        ├── 📜 struk.php
    └── 📂uploads
        └── 📂profile
            ├── 📜 devis.png
            ├── 📜 dwi.png
            ├── 📜 kharena.png
            ├── 📜 ray.png
            ├── 📜 risbelina.png
        ├── 📜 foto_687339de0c0a8.jpg
    ├── 📜 .htaccess
    ├── 📜 akun.php
    ├── 📜 bata.php
    ├── 📜 config.php
    ├── 📜 dashboard.php
    ├── 📜 db.php
    ├── 📜 devis.jpeg
    ├── 📜 dwi.jpeg
    ├── 📜 edit_akun_process.php
    ├── 📜 edit_akun.php
    ├── 📜 hapus_kontak.php
    ├── 📜 ibel.jpeg
    ├── 📜 index.php
    ├── 📜 javascript.js
    ├── 📜 kayu.php
    ├── 📜 kontak.php
    ├── 📜 LICENSE
    ├── 📜 login_process.php
    ├── 📜 login.php
    ├── 📜 logout.php
    ├── 📜 modern.php
    ├── 📜 panas.php
    ├── 📜 ray.jpeg
    ├── 📜 README.md
    ├── 📜 register_process.php
    ├── 📜 register.php
    ├── 📜 rena.jpeg
    ├── 📜 simpan.php
    ├── 📜 styles.css
    ├── 📜 tambah_akun_process.php
    └── 📜 tambah_akun.php
```

---

## ▶️ Cara Menjalankan Proyek

1. 📥 **Clone repositori:**
   ```bash
   git clone https://github.com/DevisWisley/Arsitektur.git

2. 🗃️ **Import Database**
   - Buka `phpMyAdmin` atau database manager Anda.
   - Import file: `db_architect.sql` yang disediakan ke dalam database MySQL.

3. ⚙️ **Konfigurasi Koneksi Database**
   - Buka file `config/db.php`, sesuaikan seperti ini:
     ```php
     $host = "localhost";   // Ganti jika database di server lain
     $user = "root";        // Ganti dengan user database Anda
     $password = "";        // Ganti dengan password user database Anda
     $db = "db_architect";  // Ganti dengan nama database Anda
     ```

4. 🖥️ **Jalankan di server lokal**:
   - Jalankan XAMPP
   - Pindahkan folder ke direktori htdocs (jika menggunakan XAMPP).
   - Akses via browser: `http://localhost/arsitek/`

5. 🔐 Login Admin dan Pengunjung:
   - Gunakan akun admin dan pengunjung yang tersedia atau buat akun baru

6. ✅ Proyek Siap Digunakan!
   - Jelajahi fitur-fitur lengkap seperti CRUD akun, manajemen produk, checkout, dashboard statistik, dan lainnya.

---

## 🖼️ Media & File Handling
- 📁 File Upload (PHP) – Fitur upload foto profil dengan validasi dan preview.
- 🔍 Image Preview (JavaScript) – Menampilkan preview gambar yang diunggah sebelum disimpan ke server.

---

## 🔧 Pengembangan & Testing

| Tools | Deskripsi |
|-------|-----------|
| 🖥️ XAMPP | Local server environment untuk menjalankan PHP + MySQL secara lokal.|
| 🗂️ phpMyAdmin | Antarmuka web untuk mengelola database MySQL.|
| 🧪 Google Chrome DevTools | Untuk inspeksi elemen, debug CSS/JS, dan responsif testing.|
| 📝 Visual Studio Code | Code editor utama yang digunakan untuk pengembangan proyek.|

---

## 📜 Lisensi

Proyek ini dikembangkan untuk kebutuhan pembelajaran dan non-komersial. Gunakan dan kembangkan kembali sesuai kebutuhan dengan menyertakan atribusi kepada pengembang asli.

---

## 🙋‍♂️ Pengembang

Proyek ini dikembangkan oleh **Devis Wisley**, seorang web developer yang memiliki minat tinggi dalam pengembangan aplikasi web berbasis PHP, desain UI/UX modern, serta integrasi teknologi front-end seperti Bootstrap dan Tailwind CSS. Jika Anda memiliki pertanyaan, ingin berdiskusi, atau tertarik bekerja sama dalam proyek serupa, silakan hubungi melalui salah satu platform berikut:

| Informasi Kontak | Detail |
|------------------|--------|
| 📛 **Nama**         | Devis Wisley |
| 📧 **Email**        | [deviswisley27@gmail.com](mailto:deviswisley27@gmail.com) – Silakan kirim pertanyaan, kolaborasi, atau feedback proyek. |
| 🌐 **Portfolio**    | [codingindo.vercel.app](https://codingindo.vercel.app/) – Lihat proyek-proyek lainnya yang telah dikerjakan. |
| 🐙 **GitHub**       | [github.com/deviswisley](https://www.github.com/deviswisley) – Repositori kode sumber dan kontribusi open source. |
| 📘 **Facebook**     | [facebook.com/devis.wisley](https://www.facebook.com/devis.wisley/) – Terhubung dan berdiskusi santai. |
| 📸 **Instagram**    | [instagram.com/deviswisley](https://www.instagram.com/deviswisley/) – Aktivitas dan karya desain yang dibagikan secara visual. |
| 🔗 **LinkedIn**     | [linkedin.com/in/deviswisley](https://www.linkedin.com/in/deviswisley/) – Jaringan profesional dan pengalaman kerja. |
| 📱 **WhatsApp**     | [Chat via WhatsApp](https://api.whatsapp.com/send?phone=6282274107967) – Langsung terhubung untuk komunikasi cepat. |

---

Silakan hubungi jika Anda memiliki saran, permintaan fitur tambahan, ingin memberikan dukungan, atau tertarik dengan proyek serupa.
