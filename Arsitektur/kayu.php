<!DOCTYPE html>
<html lang="id">
<head>
  <title>Rumah Kayu | KW Arsitek</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <!-- W3.CSS -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      color: #333;
      line-height: 1.7;
    }

    .hero-image-container {
      width: 100%;
      height: 70vh;
      min-height: 500px;
      overflow: hidden;
      position: relative;
      border-radius: 16px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
      margin-bottom: 40px;
    }

    .hero-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s ease;
      transform: scale(1.03);
    }

    .hero-image:hover {
      transform: scale(1.07);
    }

    .project-title {
      font-size: 2.8rem;
      font-weight: bold;
      margin-bottom: 30px;
      position: relative;
      padding-bottom: 15px;
      color: #2c3e50;
    }

    .project-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 80px;
      height: 4px;
      background-color: #e74c3c;
      border-radius: 2px;
    }

    .feature-card {
      background-color: #fff;
      border-left: 5px solid #e74c3c;
      border-radius: 10px;
      transition: box-shadow 0.3s ease;
    }

    .feature-card:hover {
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    .sidebar-card {
      background-color: #fafafa;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    }

    .team-member h4 {
      margin-bottom: 5px;
      font-size: 1.2rem;
    }

    .team-member p {
      margin: 4px 0;
    }

    .gallery-row {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -8px;
    }

    .gallery-col {
      flex: 0 0 50%;
      max-width: 50%;
      padding: 0 8px;
      box-sizing: border-box;
      margin-bottom: 16px;
    }

    .gallery-thumb {
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
    }

    .gallery-thumb:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .consultation-btn {
      background-color: #27ae60 !important;
      color: white;
      border-radius: 8px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .consultation-btn:hover {
      background-color: #219150 !important;
    }

    .footer {
      background-color: #111;
      color: #eee;
      font-size: 0.95rem;
      margin-top: 50px;
    }

    .footer a {
      color: #1abc9c;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .hero-image-container {
        height: 50vh;
        min-height: 400px;
      }

      .project-title {
        font-size: 2rem;
      }

      .w3-col.s6 {
        width: 100% !important;
      }

      .gallery-col {
        flex: 0 0 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="index.html" class="w3-bar-item w3-button"><b>KW</b> Arsitek</a>
    <div class="w3-right w3-hide-small">
      <a href="index.html#proyek" class="w3-bar-item w3-button">Proyek</a>
      <a href="index.html#tentang" class="w3-bar-item w3-button">Tentang</a>
      <a href="index.html#kontak" class="w3-bar-item w3-button">Kontak</a>
    </div>
  </div>
</div>

<!-- Konten Halaman Detail -->
<div class="w3-content w3-padding" style="max-width:1564px; padding-top: 100px;">

  <!-- Judul Proyek -->
  <div class="w3-container">
    <h1 class="project-title">Rumah Kayu Minimalis</h1>
  </div>

  <!-- Gambar Utama -->
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="hero-image-container">
        <img src="https://www.desain.id/blog/storage/uploads/contents/356/foto-desain-rumah-kayu.png" alt="Rumah Kayu" class="hero-image">
      </div>
    </div>
  </div>

  <!-- Detail Proyek -->
  <div class="w3-row-padding w3-margin-top">
    <div class="w3-col m8">
      <div class="w3-card w3-padding-large">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Deskripsi Proyek</h3>
        <p class="w3-large">Rumah kayu kontemporer yang memadukan kehangatan material kayu dengan garis-garis minimalis modern. Dibangun dengan kayu kelas premium yang tahan cuaca dan rayap.</p>
        
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Fitur Utama</h3>
        <div class="w3-row-padding">
          <div class="w3-col s6 w3-margin-bottom">
            <div class="w3-card w3-padding feature-card">
              <h4>Kayu Kelas Premium</h4>
              <p>Material kayu jati dan ulin pilihan dengan finishing alami</p>
            </div>
          </div>
          <div class="w3-col s6 w3-margin-bottom">
            <div class="w3-card w3-padding feature-card">
              <h4>Struktur Modular</h4>
              <p>Sistem konstruksi modular untuk presisi dan efisiensi waktu</p>
            </div>
          </div>
          <div class="w3-col s6 w3-margin-bottom">
            <div class="w3-card w3-padding feature-card">
              <h4>Desain Ramah Lingkungan</h4>
              <p>Material alami dan sistem daur ulang air hujan</p>
            </div>
          </div>
          <div class="w3-col s6 w3-margin-bottom">
            <div class="w3-card w3-padding feature-card">
              <h4>Insulasi Termal</h4>
              <p>Sistem insulasi khusus untuk kenyamanan sepanjang tahun</p>
            </div>
          </div>
        </div>
        
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Spesifikasi Teknis</h3>
        <div class="w3-responsive">
          <table class="w3-table w3-bordered w3-striped">
            <tr><th width="30%">Luas Bangunan</th><td>280 m²</td></tr>
            <tr><th>Luas Tanah</th><td>600 m²</td></tr>
            <tr><th>Material Utama</th><td>Kayu jati, kayu ulin, baja ringan</td></tr>
            <tr><th>Waktu Pembangunan</th><td>6 bulan</td></tr>
            <tr><th>Lokasi</th><td>Bandung</td></tr>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Sidebar -->
    <div class="w3-col m4">
      <div class="w3-card w3-padding-large sidebar-card">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Tim Proyek</h3>
        <div class="w3-panel w3-light-grey w3-round-large team-member">
          <h4>Kharena Br Sembiring</h4>
          <p class="w3-opacity">Arsitek Utama</p>
          <p>Spesialis desain bangunan kayu</p>
        </div>
        <div class="w3-panel w3-light-grey w3-round-large team-member">
          <h4>Leon Ray Sinulingga</h4>
          <p class="w3-opacity">Desainer Interior</p>
          <p>Ahli furnitur dan finishing kayu</p>
        </div>
        
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Galeri Proyek</h3>
        <div class="gallery-row">
          <div class="gallery-col">
            <img src="https://leisure-travel.vn/wp-content/uploads/2020/07/2.jpg" class="w3-round gallery-thumb" onclick="openModal(this)">
          </div>
          <div class="gallery-col">
            <img src="https://www.myboutiquehotel.com/photos/50071/conrad-maldives-rangali-island-mandhoo-152-46540-1110x700.jpg" class="w3-round gallery-thumb" onclick="openModal(this)">
          </div>
          <div class="gallery-col">
            <img src="https://pix.dotproperty.co.th/eyJidWNrZXQiOiJwcmQtbGlmdWxsY29ubmVjdC1iYWNrZW5kLWIyYi1pbWFnZXMiLCJrZXkiOiJwcm9wZXJ0aWVzLzMxNmQ5ZmZkLTg5ZWItNDcyOS1hNjUxLTk4M2M1ZTg4NGZhYS9lZmQzYTBlOC1kY2ZmLTQxYzktYWVjYy1hZDA5MjRkMTNjMGUuanBnIiwiYnJhbmQiOiJET1RQUk9QRVJUWSIsImVkaXRzIjp7InJlc2l6ZSI6eyJ3aWR0aCI6NDkwLCJoZWlnaHQiOjMyNSwiZml0IjoiY292ZXIifX19" class="w3-round gallery-thumb" onclick="openModal(this)">
          </div>
          <div class="gallery-col">
            <img src="https://thegorbalsla.com/wp-content/uploads/2019/12/Rumah-Kayu-dengan-Interior-Minimalis-700x562.jpg" class="w3-round gallery-thumb" onclick="openModal(this)">
          </div>
        </div>

        <a href="index.php#tentang" class="w3-button w3-block w3-padding-large w3-margin-top consultation-btn">Konsultasi Proyek Serupa</a>
      </div>
    </div>
  </div>
</div>

  <!-- Modal Gambar -->
  <div id="imageModal" class="w3-modal" onclick="closeModal()">
    <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
    <div class="w3-modal-content w3-animate-zoom">
      <img id="modalImage" style="width:100%">
    </div>
  </div>

  <footer class="w3-center w3-black w3-padding-16 footer">
    <p>&copy; 2023 KW Arsitek. Semua hak dilindungi.</p>
    <p><a href="index.html" class="w3-hover-text-green">Kembali ke Beranda</a></p>
  </footer>

  <script>
    function openModal(img) {
      document.getElementById("imageModal").style.display = "block";
      document.getElementById("modalImage").src = img.src;
    }
    function closeModal() {
      document.getElementById("imageModal").style.display = "none";
    }
  </script>
</body>
</html>