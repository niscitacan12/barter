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
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">

            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Edit Lokasi</h6>
                </div>

                <hr>

                <div class="mt-5 text-left">
                    <!-- Form Input -->
                    <form action="<?php echo base_url('superadmin/aksi_edit_lokasi'); ?>" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id_lokasi" value="<?php echo $lokasi->id_lokasi; ?>">
                        <!-- Nama & Alamat Input -->
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-white">
                                    Nama Lokasi
                                </label>
                                <input type="text" name="nama_lokasi" id="nama"
                                    value="<?php echo $lokasi->nama_lokasi; ?>"
                                    class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:text-white dark:border-gray-600 dark:focus:border-blue-500"
                                    placeholder="Nama Lokasi" autocomplete="off" required />
                            </div>
                            <!-- Update the 'alamat' input to be editable -->
                            <div class="relative z-0 w-full mb-6 group">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-white">
                                    Alamat
                                </label>
                                <input type="text" name="alamat" id="alamat" value="<?php echo $lokasi->alamat; ?>"
                                    class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-transparent border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:text-white dark:border-gray-600"
                                    placeholder="Alamat" autocomplete="off" required />
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="flex justify-between">
                            <!-- Updated this line -->
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