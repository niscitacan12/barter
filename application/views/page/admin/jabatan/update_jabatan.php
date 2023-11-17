<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
</head>

<body>
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">

            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Edit Jabatan</h6>
                </div>

                <hr>

                <div class="mt-5 text-left">
                    <!-- Form Update Jabatan -->
                    <form method="post" action="<?php echo base_url('admin/aksi_edit_jabatan'); ?>" id="updateForm">
                        <input type="hidden" name="id_jabatan" value="<?php echo $jabatan->id_jabatan; ?>">
                        
                        <!-- Nama Jabatan Awal -->
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="nama_jabatan_awal" class="block text-sm font-medium text-gray-700 dark:text-white">
                                Nama Jabatan Awal
                            </label>
                            <input type="text" id="nama_jabatan_awal" value="<?php echo $jabatan->nama_jabatan; ?>" disabled
                                class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:text-white dark:border-gray-600 dark:focus:border-blue-500"
                                placeholder="Nama Jabatan Awal" autocomplete="off" required />
                        </div>
                        
                        <!-- Nama Jabatan Baru -->
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="nama_jabatan" class="block text-sm font-medium text-gray-700 dark:text-white">
                                Nama Jabatan Baru
                            </label>
                            <input type="text" id="nama_jabatan" name="nama_jabatan"
                                class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:text-white dark:border-gray-600 dark:focus:border-blue-500"
                                placeholder="Nama Jabatan Baru" autocomplete="off" required />
                        </div>
                        
                        <!-- Tombol Simpan -->
                        <div class="flex justify-between">
                            <a class="focus:outline-none text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                href="javascript:history.go(-1)"><i class="fa-solid fa-arrow-left"></i></a>
                            <button type="submit"
                                class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"><i
                                    class="fa-solid fa-floppy-disk"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
