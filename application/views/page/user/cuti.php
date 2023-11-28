<!-- application/views/izin_page.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <link rel="icon" href="<?php echo base_url('./src/assets/image/absensi.png'); ?>" type="image/gif">
</head>

<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Halaman Cuti</h6>
                </div>
                <hr class="mb-7">

                <!-- Formulir untuk permintaan izin -->
                <form action="<?php echo base_url('user/aksi_cuti') ?>" method="post">
                    <!-- Field formulir untuk cuti dari -->
                    <div>
                        <label for="awal_cuti" class="block text-gray-700 font-bold mb-1 text-left">Cuti Dari:</label>
                        <input type="date" name="awal_cuti" id="awal_cuti"
                            class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500"
                            required>
                    </div>
                    <br>

                    <!-- Field formulir untuk cuti sampai -->
                    <div>
                        <label for="akhir_cuti" class="block text-gray-700 font-bold mb-1 text-left">Cuti
                            Sampai:</label>
                        <input type="date" name="akhir_cuti" id="akhir_cuti"
                            class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500"
                            required>
                    </div>
                    <br>

                    <!-- Field formulir untuk waktu masuk kerja -->
                    <div>
                        <label for="masuk_kerja" class="block text-gray-700 font-bold mb-1 text-left">Masuk
                            Kerja:</label>
                        <input type="date" name="masuk_kerja" id="masuk_kerja"
                            class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500"
                            required>
                    </div>
                    <br>
                    <!-- Field formulir untuk keperluan cuti -->
                    <div>
                        <label for="keperluan_cuti" class="block text-gray-700 font-bold mb-1 text-left">Keperluan
                            Cuti:</label>
                        <input type="text" name="keperluan_cuti" id="keperluan_cuti"
                            class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500"
                            required autocomplete="off">
                    </div>
                    <br>

                    <!-- Tombol Izin -->
                    <div class="text-right">
                        <button type="submit"
                            class="bg-indigo-500 hover:bg-indigo500 text-white py-2 px-4 rounded-md"><i
                                class="fa-solid fa-paper-plane"></i></button>
                    </div>

                </form>
            </div>
        </div>
</body>

</html>