<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
</head>
<body>
    <?php $this->load->view('components/sidebar_admin_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="flex justify-between">
                <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white mb-1">Tambah Nomor Telepon</h6>
            </div>
                <p class="text-gray-400 dark:text-white text-center md:text-left mb-6">Anda dapat menambahkan nomor telepon dari user.</p>
            <!-- card -->
            <div class="max-w-2xl mx-auto p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-8">
                <form action="<?php echo base_url('admin/aksi_tambah_nomor_telepon'); ?>" method="post">
                    <div class="">
                        <label for="nomor_telepon" class="block mb-1 text-left text-xs">No.Telepon</label>
                        <input type="text" name="nomor_telepon" id="nomor_telepon" 
                            class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 mb-2" 
                            autocomplete="off" required />
                    </div>
                    <!-- button save -->
                    <div class="flex justify-between">
                        <a href="javascript:history.go(-1)" 
                            class="focus:outline-none text-white bg-red-400 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </a>
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
</html>