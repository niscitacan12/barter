<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/auth.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <div class="cover">
            <div class="front">
                <div class="text">
                    <span class="text-1">Selamat Datang Di <br> Absensi App</span>
                    <span class="text-2">Silahkan Registrasi</span>
                </div>
            </div>
        </div>
<form action="<?php echo base_url('auth/register_superadmin'); ?>" method="post">
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Register Super Admin</div>
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-hashtag"></i>
                                <input type="text" placeholder="Enter your first name" name="nama_depan" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-hashtag"></i>
                                <input type="text" placeholder="Enter your last name" name="nama_belakang" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" placeholder="Enter your email" name="email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Enter your username" name="username" required>
                            </div>
                            <div class="input-box">
                            <i class="fas fa-lock" id="password-toggle"></i>
                            <input type="password" placeholder="Password" name="password" id="password" required />
                            <span class="fa fa-fw fa-eye-slash toggle-password" onclick="togglePassword()"></span>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="submit">
                            </div>
                            <div class="text sign-up-text">Anda sudah memiliki akun? <a
                                    href="<?php echo base_url('auth'); ?>">Login sekarang</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
            function togglePassword() {
                var passwordField = document.getElementById("password");
                var icon = document.querySelector(".toggle-password");
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                } else {
                    passwordField.type = "password";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                }
            }
            </script>
</body>
</html>