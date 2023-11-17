<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">

            <!-- Card -->
            <div class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Detail History Absensi</h6>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <div class="flex justify-between items-center p-4"> 

                        <!-- Form Bulan -->
                        <form id="form-bulan" action="<?php echo base_url('history_absensi/aksi_form_bulan') ?>" method="get" class="flex flex-col items-center gap-4 mx-10">
                            <div class="relative flex items-center">
                                <label for="bulan" class="mx-10 mb-2 text-gray-900 dark:text-white sm:mr-4"></label>
                                <select id="bulan-select" name="bulan" class="w-40 sm:w-64 sm:w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mx-3">
                                    <option value="" disabled selected>Pilih Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </form>

                        <!-- Form Tanggal -->
                        <form id="form-tanggal" action="<?php echo base_url('history_absensi/aksi_form_tanggal') ?>" method="get" class="flex flex-col items-center gap-4">
                            <div class="relative flex items-center mx-3">
                                <input type="text" id="tanggal" name="tanggal" class="w-40 sm:w-64 sm:w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mx-3" placeholder="Pilih Tanggal" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>">
                                <label for="tanggal" class="mx-2 mb-2 absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-900 dark:text-white mx-3 "></label>
                            </div>
                        </form>

                        <!-- Form Tahun -->
                        <form id="form-tahun" action="<?php echo base_url('history_absensi/aksi_form_tahun') ?>" method="get" class="flex flex-col items-center gap-4">
                            <div class="relative flex items-center">
                                <input type="number" id="tahun" name="tahun" class="w-40 sm:w-64 sm:w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ml-3 " placeholder="Pilih Tahun" pattern="[0-9]{4}">
                                <label for="tahun" class="mx-2 mb-2 absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-900 dark:text-white ml-auto">
                                </label>
                            </div>
                        </form> 

                        <!-- Tombol untuk Semua Form -->
                        <button type="button" id="submit-button" class="bg-indigo-500 hover:bg-indigo text-white font-bold py-2 px-4 rounded inline-block ml-auto">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                        <a href="<?= base_url('') ?>" class="exp bg-indigo-500 hover-bg-indigo text-white font-bold py-2 px-4 rounded inline-block ml-2">
                            <i class="fa-solid fa-file-export"></i>
                        </a>

                    </div>
                </div>
 
                    <br> 

                    <!-- Untuk Menampilkan Bulan Yang Dipilih -->
                    <div class="text-left">
                        <h1 class="font-bold text-gray-900">
                        <span id="absensi-text">Absensi :</span>
                        <?php 
                            $selectedMonth = $this->input->get('bulan'); 
                            $bulan_array = array(
                                '01' => 'Januari',
                                '02' => 'Februari',
                                '03' => 'Maret',
                                '04' => 'April',
                                '05' => 'Mei',
                                '06' => 'Juni',
                                '07' => 'Juli',
                                '08' => 'Agustus',
                                '09' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember'
                            );
                            echo $bulan_array[$selectedMonth] ?? '';
                        ?>
                        </h1>
                    </div>

                    <!-- Form Search -->
                    <form class="flex items-center">   
                        <label for="simple-search" class="text-sm font-medium text-gray-900 pr-2 sr-only dark:text-white">Search</label>
                        <div class="relative flex items-center flex-1">
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ml-auto" placeholder="Search..." required>
                        </div>
                        <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>

                    <!-- Tabel -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <!-- Tabel Head -->
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kegiatan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Keterangan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jam Masuk
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jam Pulang
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Lokasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php $no = 0; foreach ($absensi as $row): $no++ ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?php echo $no; ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?php echo $row->kegiatan; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $row->tanggal_absen; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $row->keterangan_izin; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $row->jam_masuk; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $row->jam_pulang; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo $row->lokasi; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>   
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <!-- Untuk JS Form Bulan, Tanggal, Tahun-->
    <script>
        document.getElementById("submit-button").addEventListener("click", function () {
            // Determine which form is active and submit it.
            if (document.getElementById("form-bulan").contains(document.activeElement)) {
                document.getElementById("form-bulan").submit();
            } else if (document.getElementById("form-tanggal").contains(document.activeElement)) {
                document.getElementById("form-tanggal").submit();
            } else if (document.getElementById("form-tahun").contains(document.activeElement)) {
                document.getElementById("form-tahun").submit();
            }
        });
    </script>
    <!-- JS Array Bulan -->
    <script>
    $(document).ready(function() {
        $('#bulan-select').change(function() {
            var selectedMonth = $(this).val();
            var bulan_array = {
                '01': 'Januari',
                '02': 'Februari',
                '03': 'Maret',
                '04': 'April',
                '05': 'Mei',
                '06': 'Juni',
                '07': 'Juli',
                '08': 'Agustus',
                '09': 'September',
                '10': 'Oktober',
                '11': 'November',
                '12': 'Desember'
            };
            var selectedMonthName = bulan_array[selectedMonth];
            $('#absensi-text').text('Absensi: ' + selectedMonthName);
        });
    });
    </script>
    <!-- JS Untuk Tahun -->
    <script>
        // Ambil elemen input tahun
        var tahunInput = document.getElementById('tahun');

        // Dapatkan tahun saat ini
        var tahunSaatIni = new Date().getFullYear();

        // Isi input tahun dengan tahun saat ini
        tahunInput.value = tahunSaatIni;
    </script>
</body>
</html>