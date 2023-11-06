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
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Rekap Bulanan</h6>
                </div>
                <!-- form filter -->
                <form action="<?= base_url(
                    'admin/rekapPerBulan'
                ) ?>" method="get">
                    <div class="flex justify-between items-center">
                        <select id="bulan" name="bulan"
                            class="w-35 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ml-auto">
                            <option>Pilih Bulan</option>
                            <option value="1" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '1'
                            ) {
                                echo 'selected';
                            } ?>>Januari
                            </option>
                            <option value="2" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '2'
                            ) {
                                echo 'selected';
                            } ?>>
                                Februari</option>
                            <option value="3" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '3'
                            ) {
                                echo 'selected';
                            } ?>>Maret
                            </option>
                            <option value="4" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '4'
                            ) {
                                echo 'selected';
                            } ?>>April
                            </option>
                            <option value="5" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '5'
                            ) {
                                echo 'selected';
                            } ?>>Mei
                            </option>
                            <option value="6" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '6'
                            ) {
                                echo 'selected';
                            } ?>>Juni
                            </option>
                            <option value="7" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '7'
                            ) {
                                echo 'selected';
                            } ?>>Juli
                            </option>
                            <option value="8" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '8'
                            ) {
                                echo 'selected';
                            } ?>>Agustus
                            </option>
                            <option value="9" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '9'
                            ) {
                                echo 'selected';
                            } ?>>September
                            </option>
                            <option value="10" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '10'
                            ) {
                                echo 'selected';
                            } ?>>Oktober
                            </option>
                            <option value="11" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '11'
                            ) {
                                echo 'selected';
                            } ?>>November
                            </option>
                            <option value="12" <?php if (
                                isset($_GET['bulan']) &&
                                $_GET['bulan'] == '12'
                            ) {
                                echo 'selected';
                            } ?>>Desember
                            </option>
                        </select>
                        <button type="submit"
                            class="focus:outline-none text-white bg-indigo-500 hover:bg-indigo focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-0.9 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                        <div class="flex justify-between items-center">
                            <button type="submit" name="submit"
                                class="focus:outline-none text-white bg-indigo-500 hover:bg-indigo focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-0.9 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 ml-auto"
                                formaction="<?php echo base_url(
                                    'admin/export_bulanan'
                                ); ?>">
                                <i class="fa-solid fa-file-export"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <br>
                <hr>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <!-- Head Tabel -->
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    NO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NAMA
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    KEGIATAN
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TANGGAL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    JAM MASUK
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    JAM PULANG
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    KETERANGAN IZIN
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    STATUS
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>