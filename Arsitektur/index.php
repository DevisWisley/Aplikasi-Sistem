<!DOCTYPE html>
<html lang="id">

<head>
    <title>kelompok wasit</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">

            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium"
                onclick="toggleSidebar()">☰</a>
            <a href="#beranda" class="w3-bar-item w3-button w3-left"><b>KW</b> Arsitek</a>

            <div class="w3-right w3-hide-small">
                <a href="#proyek" class="w3-bar-item w3-button">Proyek</a>
                <a href="#tentang" class="w3-bar-item w3-button">Tentang</a>
                <a href="#kontak" class="w3-bar-item w3-button">Kontak</a>
                <a href="login.php" class="w3-bar-item w3-button">Login</a>
            </div>

        </div>
    </div>


    <nav id="mySidebar" class="w3-sidebar w3-bar-block w3-white w3-animate-left w3-hide"
        style="left:0; top:0; height:100%; z-index:1000; box-shadow: 2px 0 10px rgba(0,0,0,0.1); border-right: 1px solid #eee; border-radius: 0 10px 10px 0;">

        <button onclick="closeSidebar()" class="w3-bar-item w3-button w3-large w3-text-red"
            style="font-weight:bold; font-size:22px; background: #f9f9f9;">
            × Tutup
        </button>

        <a href="#beranda" class="w3-bar-item w3-button" onclick="closeSidebar()" style="transition: 0.3s;">
            <i class="fa fa-home w3-margin-right"></i> Beranda
        </a>
        <a href="#proyek" class="w3-bar-item w3-button" onclick="closeSidebar()" style="transition: 0.3s;">
            <i class="fa fa-briefcase w3-margin-right"></i> Proyek
        </a>
        <a href="#tentang" class="w3-bar-item w3-button" onclick="closeSidebar()" style="transition: 0.3s;">
            <i class="fa fa-user w3-margin-right"></i> Tentang
        </a>
        <a href="#kontak" class="w3-bar-item w3-button" onclick="closeSidebar()" style="transition: 0.3s;">
            <i class="fa fa-envelope w3-margin-right"></i> Kontak
        </a>

        <a href="login.php" class="w3-bar-item w3-button w3-margin-top w3-text-blue" onclick="closeSidebar()"
            style="transition: 0.3s; font-weight: bold;">
            <i class="fa fa-sign-in w3-margin-right"></i> Login
        </a>

    </nav>



    <header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="beranda">
        <img class="w3-image" src="https://img.locationscout.net/images/2017-05/heydar-aliyev-centre-azerbaijan_l.jpeg"
            alt="Arsitektur" width="1500" height="800">
        <div class="w3-display-middle w3-margin-top w3-center">
            <h1 class="w3-xxlarge w3-text-white">
                <span class="w3-padding w3-black w3-opacity-min"><b>KW</b></span>
                <span class="w3-hide-small w3-text-light-grey">Arsitek</span>
            </h1>
        </div>
    </header>

    <div class="w3-content w3-padding" style="max-width:1564px">

        <div class="w3-container w3-padding-32" id="proyek">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16 section-title">Proyek</h3>
        </div>

        <div class="w3-row-padding">
            <div class="w3-col l3 m6 w3-margin-bottom">
                <a href="panas.php" class="project-link">
                    <div class="w3-display-container project-card">
                        <div class="w3-display-topleft w3-black w3-padding">Rumah Musim Panas</div>
                        <img src="https://i.pinimg.com/originals/eb/4b/d4/eb4bd4c2520369760a5f5cfd2c6e92d7.jpg"
                            alt="Rumah Musim Panas" style="width:100%">
                    </div>
                </a>
            </div>

            <div class="w3-col l3 m6 w3-margin-bottom">
                <a href="bata.php" class="project-link">
                    <div class="w3-display-container project-card">
                        <div class="w3-display-topleft w3-black w3-padding">Rumah Batu Bata</div>
                        <img src="https://www.harapanrakyat.com/wp-content/uploads/2020/04/Desain-Rumah-dengan-Bata-Ekspos.jpg"
                            alt="Rumah Batu Bata" style="width:100%">
                    </div>
                </a>
            </div>

            <div class="w3-col l3 m6 w3-margin-bottom">
                <a href="kayu.php" class="project-link">
                    <div class="w3-display-container project-card">
                        <div class="w3-display-topleft w3-black w3-padding">Rumah Kayu</div>
                        <img src="https://www.desain.id/blog/storage/uploads/contents/356/foto-desain-rumah-kayu.png"
                            alt="Rumah Kayu" style="width:100%">
                    </div>
                </a>
            </div>

            <div class="w3-col l3 m6 w3-margin-bottom">
                <a href="modern.php" class="project-link">
                    <div class="w3-display-container project-card">
                        <div class="w3-display-topleft w3-black w3-padding">Rumah Modern</div>
                        <img src="https://i.pinimg.com/originals/f6/18/d4/f618d45070df9b62500bafb771238eea.jpg"
                            alt="Rumah Modern" style="width:100%">
                    </div>
                </a>
            </div>
        </div>

        <div class="w3-container w3-padding-32" id="tentang">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Tentang</h3>
            <p>Kami adalah tim arsitek profesional yang berdedikasi untuk menciptakan desain inovatif dan fungsional.
                Dengan
                pengalaman lebih dari 15 tahun di industri ini, kami telah menyelesaikan berbagai proyek mulai dari
                perumahan
                hingga bangunan komersial. Pendekatan kami menggabungkan estetika modern dengan fungsionalitas praktis
                untuk
                menciptakan ruang yang indah dan nyaman.</p>

            <div class="team-container">
                <div class="team-card animate-on-scroll">
                    <div class="team-img-container">
                        <img src="devis.jpeg" alt="Devis">
                    </div>
                    <div class="team-content">
                        <h3>Devis Wisley Situmorang</h3>
                        <span class="w3-opacity">CEO & Pendiri</span>
                        <p>Lulusan UNIKA dengan spesialisasi dalam desain perkotaan. Memimpin tim dengan visi yang jelas
                            dan
                            kreativitas tanpa batas.</p>
                        <a class="team-contact-btn"
                            href="https://wa.me/6282274107967?text=Halo%20Devis,%20saya%20tertarik%20dengan%20jasa%20arsitektur%20Anda."
                            target="_blank">Hubungi</a>
                    </div>
                </div>

                <div class="team-card animate-on-scroll">
                    <div class="team-img-container">
                        <img src="ibel.jpeg" alt="Risbelina">
                    </div>
                    <div class="team-content">
                        <h3>Risbelina Br Sitepu</h3>
                        <span class="w3-opacity">Arsitek Utama</span>
                        <p>Spesialis dalam desain interior dan eksterior dengan pendekatan ramah lingkungan dan
                            berkelanjutan.</p>
                        <a class="team-contact-btn"
                            href="https://wa.me/6281275645437?text=Halo%20Risbelina,%20saya%20tertarik%20dengan%20desain%20interior%20Anda."
                            target="_blank">Hubungi</a>
                    </div>
                </div>

                <div class="team-card animate-on-scroll">
                    <div class="team-img-container">
                        <img src="rena.jpeg" alt="Kharena">
                    </div>
                    <div class="team-content">
                        <h3>Kharena Br Sembiring</h3>
                        <span class="w3-opacity">Arsitek</span>
                        <p>Ahli dalam desain struktural dan teknik dengan fokus pada bangunan tahan gempa dan efisiensi
                            energi.</p>
                        <a class="team-contact-btn"
                            href="https://wa.me/6282164945346?text=Halo%20Kharena,%20saya%20ingin%20membahas%20desain%20bangunan%20tahan%20gempa."
                            target="_blank">Hubungi</a>
                    </div>
                </div>

                <div class="team-card animate-on-scroll">
                    <div class="team-img-container">
                        <img src="ray.jpeg" alt="Ray">
                    </div>
                    <div class="team-content">
                        <h3>Leon Ray Sinulingga</h3>
                        <span class="w3-opacity">Desainer Interior</span>
                        <p>Berpengalaman. mahir merancang tata ruang, palet warna menenangkan, dan pencahayaan
                            ambient.</p>
                        <a class="team-contact-btn"
                            href="https://wa.me/6282162422109?text=Halo%20Ray,%20saya%20tertarik%20dengan%20desain%20interior%20modern."
                            target="_blank">Hubungi</a>
                    </div>
                </div>

                <div class="team-card animate-on-scroll">
                    <div class="team-img-container">
                        <img src="dwi.jpeg" alt="Dwi">
                    </div>
                    <div class="team-content">
                        <h3>Dwi Putra Limbong</h3>
                        <span class="w3-opacity">Desainer Interior</span>
                        <p>Desainer Interior yang mengutamakan kualitas material dan craftsmanship dalam setiap sudut
                            ruangan.</p>
                        <a class="team-contact-btn"
                            href="https://wa.me/6281540001952?text=Halo%20Dwi,%20saya%20ingin%20diskusi%20tentang%20desain%20produk%20arsitektur."
                            target="_blank">Hubungi</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w3-container w3-padding-32" id="kontak">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Kontak</h3>
            <p>Hubungi kami untuk mendiskusikan proyek Anda.</p>
            <form id="formKontak" action="simpan.php" method="post" enctype="multipart/form-data">
                <input class="w3-input w3-border" type="text" placeholder="Nama" required name="nama">
                <input class="w3-input w3-section w3-border" type="email" placeholder="Email" required name="email">
                <input class="w3-input w3-section w3-border" type="text" placeholder="Subjek" required name="subjek">
                <textarea class="w3-input w3-section w3-border" placeholder="Pesan" required name="pesan" rows="4"
                    id="pesan"></textarea>
                <input class="w3-input w3-section w3-border" type="file" name="gambar" accept="image/*">
                <button class="w3-button w3-green w3-section" type="submit">KIRIM PESAN</button>
            </form>
        </div>
    </div>

    <footer class="w3-center w3-black w3-padding-16">
        <p>Dibuat dengan <a href="https://www.w3schools.com/w3css/default.asp" target="_blank"
                class="w3-hover-text-green">w3.css</a></p>
        <p>&copy; 2023 BR Arsitek. Semua hak dilindungi.</p>
    </footer>
    <script src="javascript.js"></script>

</body>

</html>