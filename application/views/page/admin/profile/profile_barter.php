<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php $this->load->view('components/sidebar_admin_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <!-- Card -->
            <div class="max-w-2xl mx-auto p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-8">
                <div class="font-semibold mb-5 text-left">Pengaturan Akun</div>
                <hr>
                <br>
                <form action="<?= base_url('admin/edit_data'); ?>" method="post" 
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama_depan" class="block mb-1 text-left text-xs">Nama Depan</label>
                        <input type="text" name="nama_depan" id="nama_depan" value="<?php echo $admin ? $admin->nama_depan: ''; ?>"
                             class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off" required />
                    </div>
                    <div class="mb-3">
                        <label for="nama_belakang" class="block mb-1 text-left text-xs">Nama Belakang</label>
                        <input type="text" name="nama_belakang" id="nama_belakang" value="<?php echo $admin ? $admin->nama_belakang: ''; ?>"
                             class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="nama_belakang" class="block mb-1 text-left text-xs">Username</label>
                        <input type="text" name="nama_belakang" id="nama_belakang" value="<?php echo $admin ? $admin->username: ''; ?>"
                             class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off">
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-1 text-left text-xs">Akun E-mail</label>
                        <input type="text" name="email" id="email" value="<?php echo $admin ? $admin->email: ''; ?>"
                             class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off" readonly>
                    </div>
                    <!-- button save -->
                    <div class="flex justify-between">
                        <button type="submit"
                            class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <i class="fa-regular fa-floppy-disk"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="max-w-2xl mx-auto p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-8">
                <div class="font-semibold mb-5 text-left">Pengaturan Password</div>
                <hr>
                <br>
                <form action="<?= base_url('admin/edit_password'); ?>" method="post" 
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="password_lama" class="block mb-1 text-left text-xs">Password Lama</label>
                        <input type="text" name="password_lama" id="password_lama" 
                            class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off" required />
                    </div>
                    <div class="mb-3">
                        <label for="password_baru" class="block mb-1 text-left text-xs">Password Baru</label>
                        <input type="text" name="password_baru" id="password_baru" 
                             class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off">
                    </div>
                    <div class="">
                        <label for="konfirmasi_password" class="block mb-1 text-left text-xs">Konformasi Password Baru</label>
                        <input type="text" name="konfirmasi_password" id="konfirmasi_password" 
                             class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off">
                    </div>
                    <div class="flex items-start mt-3 mb-6 ml-2">
                        <div class="flex items-center h-5">
                        <input id="showpass" type="checkbox" value=""
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                            onchange="showPassword()">
                        </div>
                        <label for="showpass"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Show Password
                        </label>
                    </div>
                    <!-- button save -->
                    <div class="flex justify-between">
                        <button type="submit"
                            class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <i class="fa-regular fa-floppy-disk"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
function showPassword() {
    var oldPasswordInput = document.getElementById('password_lama');
    var passwordInput = document.getElementById('password_baru');
    var confirmPasswordInput = document.getElementById('konfirmasi_password');
    var showPassCheckbox = document.getElementById('showpass');

    // Check if the checkbox is checked
    var isShowPassword = showPassCheckbox.checked;

    // Update the type attribute based on the checkbox state
    oldPasswordInput.type = isShowPassword ? 'text' : 'password';
    passwordInput.type = isShowPassword ? 'text' : 'password';
    confirmPasswordInput.type = isShowPassword ? 'text' : 'password';
}
</script>
<?php if ($this->session->flashdata('edit_profile')) { ?>
    <script>
        Swal.fire({
            title: "Success!",
            text: "<?php echo $this->session->flashdata('edit_profile'); ?>",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php } ?>
</html>