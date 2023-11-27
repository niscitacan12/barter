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
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Permohonan Cuti</h6>

                </div>

                <hr>

                <div class="flex justify-between mt-5 mb-5">

                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-blue-800"
                        type="button">Filter <i class="fa-solid fa-chevron-down ml-2" aria-hidden="true"></i>
                    </button>

                    <!-- Filter -->
                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">5</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">10</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">20</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Search -->
                    <form action="<?= base_url('admin/cuti') ?>" method="get">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <input type="search" id="default-search" name="keyword"
                                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search . . . " required autocomplete="off">
                            <button type="submit"
                                class="text-white absolute right-2.5 bottom-2.5 bg-indigo-500 hover:bg-indigo focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <hr>

                <!-- Tabel -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                        <!-- Tabel Head -->
                        <thead
                            class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cuti Dari
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sampai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Masuk Kerja
                                </th>
                                <!-- <th scope="col" class="px-6 py-3">
                                    Jumlah Cuti
                                </th> -->
                                <th scope="col" class="px-6 py-3">
                                    Keperluan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <!-- Tabel Body -->
                        <tbody class="text-center">
                            <?php
                            $no = 0;
                            foreach ($cuti as $row):
                                $no++; ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $no; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo nama_user($row->id_user); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo convDate($row->awal_cuti); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo convDate($row->akhir_cuti); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo convDate($row->masuk_kerja); ?>
                                </td>
                                <!-- <td class="px-6 py-4">
                                </td> -->
                                <td class="px-6 py-4">
                                    <?php echo $row->keperluan_cuti; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->status; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-content-between">
                                        <a href="javascript:void(0);"
                                            onclick="konfirmasiSetujuCuti(<?= $row->id_cuti ?>)"
                                            class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 mx-1 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="BatalkanCuti(<?= $row->id_cuti ?>)"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 mx-1 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </a>
                                        <a id="downloadPdfButton" type="button" href="<?php echo base_url(
                                            'admin/permohonan_pdf/'
                                        ) . $row->id_cuti; ?>"
                                            class="text-white bg-yellow-400 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
document.getElementById('downloadPdfButton').addEventListener('click', function() {
    // Tidak perlu melakukan apa-apa di sini, karena URL sudah diatur di href tombol
    // Fungsi downloadPdf dihilangkan, karena URL tombol sudah mengarah ke fungsi yang benar
});
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
function konfirmasiSetujuCuti(idCuti) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah yakin ingin menyetujui izin cuti ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Setuju!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            setujuCuti(idCuti);
        }
    });
}

function BatalkanCuti(idCuti) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah yakin ingin membatalkan izin cuti ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'rgb(185 28 28)',
        confirmButtonText: 'Ya, Batalkan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            tidakSetujuCuti(idCuti);
        }
    });
}

function setujuCuti(cutiId) {
    // Menggunakan AJAX untuk mengirim aksi ke server
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?= base_url('admin/setujuCuti/') ?>' + cutiId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Di sini, Anda dapat menangani respons dari server jika diperlukan
            console.log(xhr.responseText);

            // Contoh: Refresh halaman setelah tombol diklik
            location.reload();
        }
    };
    xhr.send();
}

function tidakSetujuCuti(cutiId) {
    // Menggunakan AJAX untuk mengirim aksi ke server
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?= base_url('admin/tidakSetujuCuti/') ?>' + cutiId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Di sini, Anda dapat menangani respons dari server jika diperlukan
            console.log(xhr.responseText);

            // Contoh: Refresh halaman setelah tombol diklik
            location.reload();
        }
    };
    xhr.send();
}
</script>

</html>