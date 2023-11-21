<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
</head>

<body>
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="p-5 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="flex flex-col lg:flex-row mx-auto max-w-7xl py-6 px-4 lg:px-0">
                <!-- Profile Picture -->
                <div class="lg:w-1/3 pr-4 mb-4 lg:mb-0">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="text-xl font-semibold mb-2">Foto Profil</div>
                        <div class="text-center">
                            <p class="text-xs text-gray-500 mb-4">JPG or PNG no larger than 5 MB</p>
                            <form method="post" action="<?= base_url(
                                'admin/aksi_ubah_akun'
                            ) ?>" enctype="multipart/form-data">
                                <img class="w-32 h-32 rounded-full mx-auto mb-2" src="<?= base_url(
                                    'images/admin/' . $admin->image
                                ) ?>" alt="Profile Picture">
                                <label for="image" class="block mb-1">Upload new image</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="border rounded-md p-1">
                        </div>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="lg:w-2/3 relative">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="text-xl font-semibold mb-4">Detail Akun</div>
                        <form method="post" action="<?= base_url(
                            'admin/aksi_ubah_akun'
                        ) ?>">
                            <div class="mb-4">
                                <label for="username" class="block mb-1 text-sm">Username</label>
                                <input type="text" autocomplete="off" class="border rounded-md w-full p-2" id="username"
                                    name="username" value="<?php echo $admin->username; ?>">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block mb-1 text-sm">Email</label>
                                <input type="text" class="border rounded-md w-full p-2" id="email" name="email"
                                    value="<?php echo $admin->email; ?>" readonly>
                            </div>
                            <div class="flex flex-col lg:flex-row lg:gap-4 mb-4">
                                <div class="w-full lg:w-1/2 m-2 mb-4 lg:mb-0">
                                    <label for="firstName" class="block mb-2 text-sm">Nama Depan</label>
                                    <input type="text" autocomplete="off" class="border rounded-md w-full p-2"
                                        id="firstName" name="nama_depan" value="<?php echo $admin->nama_depan; ?>">
                                </div>
                                <div class="w-full lg:w-1/2  m-2 mb-2 lg:mb-0">
                                    <label for="lastName" class="block mb-2 text-sm">Nama Belakang</label>
                                    <input type="text" autocomplete="off" class="border rounded-md w-full p-2"
                                        id="lastName" name="nama_belakang" value="<?php echo $admin->nama_belakang; ?>">
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row lg:gap-4 mb-4">
                                <div class="w-full lg:w-1/2 m-2 mb-4 lg:mb-0">
                                    <label for="passwordBaru" class="block mb-1 text-sm">Password Baru</label>
                                    <input type="password" class="border rounded-md w-full p-2" id="passwordBaru"
                                        name="password_baru">
                                </div>
                                <div class="w-full lg:w-1/2 m-2">
                                    <label for="konfirmasiPassword" class="block mb-1 text-sm">Konfirmasi
                                        Password</label>
                                    <input type="password" class="border rounded-md w-full p-2" id="konfirmasiPassword"
                                        name="konfirmasi_password">
                                </div>
                            </div>
                            <button
                                class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"
                                type="submit">
                                <i class="fa-solid fa-check"></i> </button>
                            <a href="javascript:void(0);" onclick="confirmLogout();" type="button"
                                class="text-white bg-red-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"><i
                                    class="fa-solid fa-right-from-bracket"></i></a>
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
    </script>
</body>

</html>