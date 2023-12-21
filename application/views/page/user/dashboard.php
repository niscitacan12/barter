<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <link rel="icon" href="<?php echo base_url(
        './src/assets/image/absensi.png'
    ); ?>" type="image/gif">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"
        integrity="sha512-7U4rRB8aGAHGVad3u2jiC7GA5/1YhQcQjxKeaVms/bT66i3LVBMRcBI9KwABNWnxOSwulkuSXxZLGuyfvo7V1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>

<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-2 sm:ml-64">
        <!-- Card Selamat Datang -->
        <div class="mt-10 w-full">
            <div
                class="p-4 text-center bg-gray-400 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <?php
             // Set the default timezone to UTC
                date_default_timezone_set('UTC');
                $currentDateTime = new DateTime();
            // Set the timezone to Asia/Jakarta
               $currentDateTime->setTimezone(new DateTimeZone('Asia/Jakarta'));
               $date = $currentDateTime->format('l, d F Y');
               $timeWIB = $currentDateTime->format('H:i');
               ?>

                <h2 class="text-2xl font-semibold mb-4">Selamat Datang
                    <span><?php echo $this->session->userdata('username'); ?></span>
                </h2>
                <p class="text-gray-600">Selamat datang di aplikasi Absensi, <?php echo getNamaHari($date); ?>
                    <?php echo convDate($date); ?>, <?php echo $timeWIB; ?> WIB</p>

            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            <a href="<?= base_url('user/absen') ?>"
                class="w-full p-4 text-center bg-indigo-500 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Absen</h5>
                <hr class="mb-4 border-gray-900">
                <div class="flex justify-between">
                    <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">

                    </p>
                    <div>
                        <i class="fa-solid fa-right-to-bracket fa-fw fa-lg me-3 fa-2xl"></i>
                    </div>
                </div>
            </a>
            <a href="javascript:void(0)" onclick="validatePulang()"
                class="w-full p-4 text-center bg-indigo-500 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Pulang</h5>
                <hr class="mb-4 border-gray-900">
                <div class="flex justify-between">
                    <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">

                    </p>
                    <div>
                        <i class="fa-solid fa-right-from-bracket fa-fw fa-lg me-3 fa-2xl"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="p-2 mt-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-5">
                <a href="<?= base_url('') ?>"
                    class="w-full p-4 text-center bg-blue-400 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Total</h5>
                    <hr class="mb-4 border-gray-900">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $total ?> Total
                        </p>
                        <div>
                            <i class="fa-solid fa-clock-rotate-left fa-fw fa-lg me-3 fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= base_url('user/izin') ?>"
                    class="w-full p-4 text-center bg-green-400 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Izin</h5>
                    <hr class="mb-4 border-gray-900">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $absensi ?> Izin
                        </p>
                        <div>
                            <i class="fa-solid fa-circle-xmark fa-fw fa-lg me-3 fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= base_url('user/cuti') ?>"
                    class="w-full p-4 text-center bg-purple-400 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Cuti</h5>
                    <hr class="mb-4 border-gray-900">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $cuti_count ?> Cuti
                        </p>
                        <div>
                            <i class="fa-solid fa-mug-hot fa-fw fa-lg me-3 fa-2xl"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div
                class="w-full mt-5 mb-5 p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <canvas id="myChart"></canvas>
            </div>

            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">History absensi</h6>
                </div>
                <hr>

                <!-- Tabel -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                        <thead
                            class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Masuk
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Pulang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kehadiran
                                </th>
                                </th>
                            </tr>
                        </thead>
                        <!-- Tabel Body -->
                        <tbody class="text-center">
                            <?php
                            $no = 0;
                            foreach ($absen as $row):
                                if ($no < 5):
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
                                    <?php echo $row->tanggal_absen; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->jam_masuk; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->jam_pulang; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->status_absen; ?>
                                </td>
                            </tr>
                            <?php
                                else:
                                    break;
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="flex justify-end">
                    <a class="focus:outline-none text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                        href="<?= base_url(
                            'user/history_absensi'
                        ) ?>" title="Ke Riwayat Absensi">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <br>
            <br>
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Permohonan cuti</h6>
                </div>
                <hr>

                <!-- Tabel -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Username</th>
                                <th scope="col" class="px-6 py-3">Awal Cuti</th>
                                <th scope="col" class="px-6 py-3">Akhir Cuti</th>
                                <th scope="col" class="px-6 py-3">Keperluan Cuti</th>
                            </tr>
                        </thead>
                        <!-- Tabel Body -->
                        <tbody class="text-center">
                            <?php if (!empty($cuti)): ?>
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
                                    <?php echo $row->keperluan_cuti; ?>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data cuti</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
                <br>
                <div class="flex justify-end">
                    <a class="focus:outline-none text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                        href="<?= base_url(
                            'user/history_cuti'
                        ) ?>" title="Ke Riwayat Absensi">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
    function validatePulang() {
        const currentHour = new Date().getHours();

        // Validasi waktu (hanya dapat pulang setelah jam 16:00)
        if (currentHour < 16) {
            // Jika belum pukul 16:00, tampilkan SweetAlert atau pesan lain
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Belum waktunya pulang!',
            });
        } else {
            // Jika sudah pukul 16:00, lanjutkan ke halaman 'user/pulang'
            window.location.href = '<?= base_url('user/pulang') ?>';
        }
    }
    </script>
    <script>
    const ctx = document.getElementById('myChart');

    function updateChart() {
        $.ajax({
            url: '<?= base_url('user/get_realtime_absensi') ?>',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const labels = data.map(item => moment(item.tanggal_absen).format('DD MMM'));
                const values = data.map(item => item.absensi_count);

                myChart.data.labels = labels;
                myChart.data.datasets[0].data = values;
                myChart.update();
            },
            error: function(error) {
                console.error('Error fetching realtime absensi data:', error);
            }
        });
    }

    // Set interval untuk memperbarui grafik setiap beberapa detik
    setInterval(updateChart, 1000); // Ganti sesuai dengan kebutuhan

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Absensi',
                data: [],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 30
                }
            }
        }
    });
    </script>
</body>

<?php if ($this->session->flashdata('login_success')) { ?>
<script>
Swal.fire({
    title: 'Berhasil Login',
    text: '<?php echo $this->session->flashdata('login_success'); ?>',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
})
</script>
<?php } ?>

</html>