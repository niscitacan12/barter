<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <link rel="icon" href="<?php echo base_url('./src/assets/image/absensi.png'); ?>" type="image/gif">
</head>

<body>
    <?php $this->load->view('components/sidebar_super_admin'); ?>
    <div class="p-5 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="flex flex-col lg:flex-row mx-auto max-w-7xl py-6 px-4 lg:px-0 justify-between">
                <!-- Profile Picture -->
                <div class="card mb-4 lg:mr-4 p-8 md:w-1/2 lg:w-1/3 xl:w-1/4 border border-gray-300 rounded-md">
                    <div class="card-header text-2xl font-semibold">Profile Picture</div>
                    <div class="card-body text-center">
                        <?php if (isset($superadmin)): ?>
                        <div id="profile-picture-container"
                            class="rounded-full mt-2 mx-auto my-auto w-48 h-48 md:w-40 md:h-40 lg:w-56 lg:h-56 xl:w-64 xl:h-64 object-cover">
                            <img class="h-full object-cover rounded-full"
                                src="<?= base_url('images/superadmin/' . $superadmin->image) ?>" alt="Profile Picture">
                        </div>
                        <?php endif; ?>
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <form action="<?= base_url('superadmin/aksi_ubah_foto') ?>" method="post" class="grid gap-4"
                            enctype="multipart/form-data">
                            <div>
                                <div class="text-xl font-semibold mb-4">Previews</div>
                            </div>
                            <div id="image-preview" class="hidden flex items-center justify-center">
                                <img id="preview"
                                    class="rounded-full mt-2 mx-auto my-auto w-48 h-48 md:w-40 md:h-40 lg:w-56 lg:h-56 xl:w-64 xl:h-64 object-cover">
                            </div>
                            <div class="flex items-center mb-2">
                                <div class="mx-auto bg-green-500 p-2 rounded-md">
                                    <label for="image" class="mt-1 p-2 text-white rounded-md"
                                        style="cursor: pointer; font-size: 13px;">
                                        <i class="fas fa-pen-to-square" style="font-size: 13px;"></i>
                                    </label>
                                    <input type="file" name="image" id="image" accept="image/*"
                                        onchange="previewImage()" style="display: none;">
                                </div>


                                <button type="submit"
                                    class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800 mx-auto">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="lg:w-11/12 relative border border-gray-300 rounded-md mb-8">
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <div class="text-3xl font-semibold mb-8">Detail Akun</div>
                        <form method="post" action="<?= base_url('superadmin/aksi_ubah_detail_akun') ?>">
                            <div class="mb-4">
                                <label for="username" class="block mb-1 text-sm">Username</label>
                                <input type="text" autocomplete="off" class="border rounded-md w-full p-2" id="username"
                                    name="username" value="<?php echo $superadmin->username; ?>">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block mb-1 text-sm">Email</label>
                                <input type="text" class="border rounded-md w-full p-2" id="email" name="email"
                                    value="<?php echo $superadmin->email; ?>" readonly>
                            </div>
                            <div class="flex flex-col lg:flex-row lg:gap-4 mb-4">
                                <div class="w-full lg:w-1/2 m-2 mb-4 lg:mb-0">
                                    <label for="firstName" class="block mb-2 text-sm">Nama Depan</label>
                                    <input type="text" autocomplete="off" class="border rounded-md w-full p-2"
                                        id="firstName" name="nama_depan" value="<?php echo $superadmin->nama_depan; ?>">
                                </div>
                                <div class="w-full lg:w-1/2  m-2 mb-2 lg:mb-0">
                                    <label for="lastName" class="block mb-2 text-sm">Nama Belakang</label>
                                    <input type="text" autocomplete="off" class="border rounded-md w-full p-2"
                                        id="lastName" name="nama_belakang"
                                        value="<?php echo $superadmin->nama_belakang; ?>">
                                </div>
                            </div>
                            <button
                                class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"
                                type="submit"><i class="fa-solid fa-floppy-disk"></i></button>
                        </form>

                        <hr class="my-4">

                        <div class="text-xl font-semibold mb-4">Ganti Password</div>
                        <form method="post" action="<?= base_url('superadmin/aksi_ubah_password') ?>">
                            <div class="w-full lg:w-1/2 m-2 mb-4 lg:mb-0">
                                <label for="passwordBaru" class="block mb-1 text-sm">Password Baru</label>
                                <input type="password" class="border rounded-md w-full p-2" id="passwordBaru"
                                    name="password_baru" required>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="showpass" type="checkbox" value=""
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                            onchange="showPassword()">
                                    </div>
                                    <label for="showpass"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Show
                                        Password</label>
                                </div>

                            </div>
                            <div class="w-full lg:w-1/2 m-2">
                                <label for="konfirmasiPassword" class="block mb-1 text-sm">Konfirmasi Password</label>
                                <input type="password" class="border rounded-md w-full p-2" id="konfirmasiPassword"
                                    name="konfirmasi_password" required>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="showpass" type="checkbox" value=""
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                            onchange="showPassword()">
                                    </div>
                                    <label for="showpass"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Show
                                        Password</label>
                                </div>

                            </div>
                            <button
                                class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"
                                type="submit"><i class="fa-solid fa-floppy-disk"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Fungsi untuk menampilkan konfirmasi SweetAlert saat tombol logout ditekan
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Anda akan keluar dari akun Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika konfirmasi "Ya", maka alihkan ke logout
                window.location.href = "<?php echo base_url('auth/logout'); ?>";
            }
        });
    }

    function previewImage() {
        var input = document.getElementById('image');
        var preview = document.getElementById('preview');
        var previewContainer = document.getElementById('image-preview');

        previewContainer.style.display = 'block';

        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
        }
    }
    </script>
    <script>
    function showPassword() {
        var passwordInput = document.getElementById('passwordBaru');
        var confirmPasswordInput = document.getElementById('konfirmasiPassword');
        var showPassCheckbox = document.getElementById('showpass');

        if (showPassCheckbox.checked) {
            passwordInput.type = 'text';
            confirmPasswordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
            confirmPasswordInput.type = 'password';
        }
    }
    </script>

</body>

</html>