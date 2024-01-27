<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php $this->load->view('components/sidebar_user_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <!-- Card -->
            <div class="max-w-2xl mx-auto p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-8">
                <div class="font-semibold mb-5 text-left">Pengaturan Akun</div>
                <hr>
                <br>
                <form action="<?= base_url('user/aksi_edit_data'); ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama_depan" class="block mb-1 text-left text-xs">
                            Nama Depan
                        </label>
                        <input type="text" name="nama_depan" id="nama_depan" value="<?php echo isset($user) ? $user->nama_depan : ''; ?>"
                            class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off" required />
                    </div>
                    <div class="mb-3">
                        <label for="nama_belakang" class="block mb-1 text-left text-xs">
                            Nama Belakang
                        </label>
                        <input type="text" name="nama_belakang" id="nama_belakang" value="<?php echo isset($user) ? $user->nama_belakang : ''; ?>" 
                            class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="nama_belakang" class="block mb-1 text-left text-xs">
                            Username
                        </label>
                        <input type="text" name="nama_belakang" id="nama_belakang" value="<?php echo isset($user) ? $user->username : ''; ?>" 
                            class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off">
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-1 text-left text-xs">
                            Akun E-mail
                        </label>
                        <input type="text" name="email" id="email" value="<?php echo isset($user) ? $user->email : ''; ?>" 
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
                <form action="<?= base_url('user/aksi_edit_password'); ?>" method="post" enctype="multipart/form-data">
                    <div class="">
                        <label for="passowrd_lama" class="block mb-1 text-left text-xs">Password Lama</label>
                        <input type="text" name="passowrd_lama" id="passowrd_lama" 
                            class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                            autocomplete="off" required />
                    </div>
                    <div class="">
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
                </form>
            </div>
        </div>
    </div>
</body>
</html>