<!DOCTYPE html>
<html lang="id">
<head>
  <title>Rumah Musim Panas | KW Arsitek</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
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

    .gallery-thumb {
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: 150px;
      object-fit: cover;
      margin-bottom: 15px;
    }

    .gallery-thumb:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

<!-- Navigasi -->
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
    <h1 class="project-title">Rumah Musim Panas</h1>
  </div>

  <!-- Gambar Utama -->
  <div class="w3-row-padding">
    <div class="w3-col m12">
      <div class="hero-image-container">
        <img src="https://i.pinimg.com/originals/eb/4b/d4/eb4bd4c2520369760a5f5cfd2c6e92d7.jpg" alt="Rumah Musim Panas" class="hero-image">
      </div>
    </div>
  </div>

  <!-- Detail Proyek -->
  <div class="w3-row-padding w3-margin-top">
    <div class="w3-col m8">
      <div class="w3-card w3-padding-large">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Deskripsi Proyek</h3>
        <p class="w3-large">Rumah Musim Panas ini adalah masterpiece kami yang dirancang khusus untuk iklim tropis. Dengan fokus pada kenyamanan termal, rumah ini menawarkan solusi hidup sejuk tanpa ketergantungan pada AC.</p>
        
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Fitur Utama</h3>
        <div class="w3-row-padding">
          <div class="w3-col s6 w3-margin-bottom">
            <div class="w3-card w3-padding feature-card">
              <h4>Ventilasi Alami</h4>
              <p>Desain lorong angin dan bukaan strategis untuk sirkulasi udara optimal</p>
            </div>
          </div>
          <div class="w3-col s6 w3-margin-bottom">
            <div class="w3-card w3-padding feature-card">
              <h4>Atap Reflektif</h4>
              <p>Material atap khusus yang memantulkan 80% panas matahari</p>
            </div>
          </div>
          <div class="w3-col s6 w3-margin-bottom">
            <div class="w3-card w3-padding feature-card">
              <h4>Kolam Pendingin</h4>
              <p>Kolam renang alami dengan sistem sirkulasi yang mendinginkan lingkungan</p>
            </div>
          </div>
          <div class="w3-col s6 w3-margin-bottom">
            <div class="w3-card w3-padding feature-card">
              <h4>Taman Vertikal</h4>
              <p>Dinding hidup yang mengurangi suhu ruangan hingga 5°C</p>
            </div>
          </div>
        </div>
        
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Spesifikasi Teknis</h3>
        <div class="w3-responsive">
          <table class="w3-table w3-bordered w3-striped">
            <tr><th width="30%">Luas Bangunan</th><td>350 m²</td></tr>
            <tr><th>Luas Tanah</th><td>800 m²</td></tr>
            <tr><th>Jumlah Lantai</th><td>2</td></tr>
            <tr><th>Material Utama</th><td>Batu alam, kayu jati, baja ringan</td></tr>
            <tr><th>Tahun Pembangunan</th><td>2022</td></tr>
            <tr><th>Lokasi</th><td>Bogor, Jawa Barat</td></tr>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Sidebar -->
    <div class="w3-col m4">
      <div class="w3-card w3-padding-large sidebar-card">
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Tim Proyek</h3>
        <div class="w3-panel w3-light-grey w3-round-large team-member">
          <h4>Devis Wisley Situmorang</h4>
          <p class="w3-opacity">Arsitek Utama</p>
          <p>Spesialis desain iklim tropis dengan 10 tahun pengalaman</p>
        </div>
        <div class="w3-panel w3-light-grey w3-round-large team-member">
          <h4>Dwi Putra Limbong</h4>
          <p class="w3-opacity">Desainer Interior</p>
          <p>Ahli material alami dan sirkulasi udara</p>
        </div>
        
        <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Galeri Proyek</h3>
        <div class="gallery-row">
          <div class="gallery-col">
            <img src="https://cdn0-production-images-kly.akamaized.net/k4qMFR2waAGtjGcEl-Q1rhSsg2A=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/5235474/original/073384100_1748421327-ChatGPT_Image_May_28__2025__03_34_50_PM.jpg" style="width:100%" class="w3-round gallery-thumb" onclick="openModal(this)">
          </div>
          <div class="gallery-col">
            <img src="https://arsitagx-master-article.s3-ap-southeast-1.amazonaws.com/article-photo/233/02-Desain-rooftop-farming-Rumah-Beranda-Green-Boarding-House-karya-sigitkusumawijaya-architect-urbandesigner-Sumber-arsitagcom.jpeg" style="width:100%" class="w3-round gallery-thumb" onclick="openModal(this)">
          </div>
          <div class="gallery-col">
            <img src="https://www.pmlandscapes.co.uk/wp-content/uploads/2023/03/Wimbledon-garden-design-and-storage-800x600.jpg" style="width:100%" class="w3-round gallery-thumb" onclick="openModal(this)">
          </div>
          <div class="gallery-col">
            <img src="https://tse1.mm.bing.net/th/id/OIP.MiEShZVVUFZE5ChzKcaX4wHaFm?w=700&h=529&rs=1&pid=ImgDetMain" style="width:100%" class="w3-round gallery-thumb" onclick="openModal(this)">
          </div>
        </div>

        <a href="index.php#tentang" class="w3-button w3-block w3-padding-large w3-margin-top consultation-btn">Konsultasi Proyek Serupa</a>
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
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16 footer">
  <p>&copy; 2023 KW Arsitek. Semua hak dilindungi.</p>
  <p><a href="index.html" class="w3-hover-text-green">Kembali ke Beranda</a></p>
</footer>

<!-- Script -->
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