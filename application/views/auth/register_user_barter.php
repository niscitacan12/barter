<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex flex-col items-center justify-center w-full h-screen">
        <div class="bg-white rounded-xl shadow-2xl flex w-3/4 max-w-4xl flex-col md:flex-row overflow-hidden">
            <div class="w-full md:w-3/5 p-5">
                <div class="text-left font-bold">
                    <span class="text-gray-500">Pertukaran </span>Barang
                </div>
                
                <div class="py-5 md:py-10 text-center">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-500 mb-2">
                        Masukkan Akun Anda
                    </h2>
                    <div class="border-2 w-10 border-gray-500 inline-block mb-2"></div>
                    <p class="text-xs text-slate-500 mb-4">
                        Lakukan Registrasi Terlebih Dahulu
                    </p>
                    <form action="<?php echo base_url('auth/aksi_register_user'); ?>" method="post">
                        <div class="flex flex-col items-center">
                            <div class="mb-4 w-3/4 max-w-md">
                                <input type="nama_depan" name="nama_depan" placeholder="Nama Depan" autocomplete="off"
                                    class="w-full max-w-md border border-slate-400 rounded-full px-4 py-2 text-xs font-semibold bg-slate-100 focus:border-gray-500 focus:bg-white focus:outline-none" 
                                    required>
                            </div>
                            <div class="mb-4 w-3/4 max-w-md">
                                <input type="nama_belakang" name="nama_belakang" placeholder="Nama Belakang" autocomplete="off"
                                    class="w-full max-w-md border border-slate-400 rounded-full px-4 py-2 text-xs font-semibold bg-slate-100 focus:border-gray-500 focus:bg-white focus:outline-none" 
                                    required>
                            </div>
                            <div class="mb-4 w-3/4 max-w-md">
                                <input type="email" name="email" placeholder="Email" autocomplete="off"
                                    class="w-full max-w-md border border-slate-400 rounded-full px-4 py-2 text-xs font-semibold bg-slate-100 focus:border-gray-500 focus:bg-white focus:outline-none" 
                                    required>
                            </div> 
                            <div class="mb-4 w-3/4 max-w-md">       
                                <input type="text" name="username" placeholder="Username" autocomplete="off"
                                    class="w-full max-w-md border border-slate-400 rounded-full px-4 py-2 text-xs font-semibold bg-slate-100 focus:border-gray-500 focus:bg-white focus:outline-none" 
                                    required>
                            </div>
                            <div class="relative w-3/4 max-w-md mb-6">
                                <input type="password" name="password" placeholder="Password" autocomplete="off"
                                    class="w-full max-w-md border border-slate-400 rounded-full px-4 py-2 text-xs font-semibold bg-slate-100 focus:border-gray-500 focus:bg-white focus:outline-none" 
                                    id="passwordInput" required>
                                    <span onclick="togglePasswordVisibility()"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                        <i id="passwordVisibilityIcon" class="fas fa-eye"></i>
                                    </span>
                            </div>
                            <button type="submit" name="register" 
                                class="rounded-full py-1 px-4 inline-block font-semibold border-2 border-gray-500 text-black transition hover:border-2 hover:border-gray-400 hover:bg-white hover:text-gray-500 mx-auto">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full md:w-2/5 bg-gray-500 text-white py-10 px md:py-16 text-center">
                <h2 class="text-xl lg:text-2xl font-bold mb-2">
                    Hallo Pengguna
                </h2>
                <div class="border-2 w-10 border-white inline-block mb-2"></div>
                <p class="mb-4">
                    Sudah Punya Akun?
                </p>
                <p class="mb-8">Jika Anda Sudah 
                    Punya Akun
                    Silahkan Langsung Masukkan Akun Anda  
                </p>
                <a href="<?php echo base_url('auth/login_barter'); ?>"
                    class="border-2 border-white rounded-full px-2 py-1 inline-block font-semibold transition hover:bg-white hover:text-gray-500">
                    Login
                </a>
            </div>
        </div>
    </div>
</body>
<?php if ($this->session->flashdata('registrasi_error')) { ?>
<script>
Swal.fire({
    title: 'Registrasi Error',
    text: '<?php echo $this->session->flashdata('registrasi_error'); ?>',
    icon: 'error',
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>
<script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('passwordInput');
    var passwordVisibilityIcon = document.getElementById('passwordVisibilityIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordVisibilityIcon.classList.remove('fa-eye');
        passwordVisibilityIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordVisibilityIcon.classList.remove('fa-eye-slash');
        passwordVisibilityIcon.classList.add('fa-eye');
    }
}
</script>
</html>