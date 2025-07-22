<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #f8ffae, #43c6ac);
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="flex justify-center items-center min-h-screen" data-aos="zoom-in">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-700">
                <i class="fas fa-user-plus text-success"></i> Register Akun
            </h2>

            <form method="POST" action="register_process.php" enctype="multipart/form-data">
                <div class="row g-4">
                    <!-- Kanan -->
                    <div class="col-md-6">
                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username"
                                    required />
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email"
                                    required />
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan password" required />
                            </div>
                        </div>
                    </div>

                    <!-- Kiri -->
                    <div class="col-md-6">
                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konfirmasi Password <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="confirm_password" class="form-control"
                                    placeholder="Konfirmasi password" required />
                            </div>
                        </div>

                        <!-- Level -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Level <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                <select name="level" class="form-select" required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="pengunjung">Pengunjung</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <!-- Upload Foto -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto Profil <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                <input type="file" name="foto" class="form-control" accept="image/*"
                                    onchange="previewImage(event)" required />
                            </div>
                            <div class="mt-3 text-center">
                                <img id="image-preview" src="#" alt="Preview" class="img-thumbnail d-none"
                                    style="max-width: 150px; height: auto;" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </button>
                    <a href="login.php" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        function previewImage(event) {
            const preview = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>