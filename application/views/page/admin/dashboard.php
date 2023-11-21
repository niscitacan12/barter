<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
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
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <a href="<?= base_url('admin/user') ?>"
                    class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">User</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $user_count ?>
                            User
                        </p>
                        <div>
                            <i class="fa-solid fa-users-gear fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= 'admin/absensi' ?>"
                    class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Absensi</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $absensi ?>
                            Absensi
                        </p>
                        <div>
                            <i class="fa-solid fa-address-card fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= 'admin/cuti' ?>"
                    class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Cuti</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $cuti ?>
                            Cuti
                        </p>
                        <div>
                            <i class="fa-solid fa-calendar-alt fa-fw fa-2xl"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div style="margin-left: 270px; margin-right: 80px; height: 300px;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
    const ctx = document.getElementById('myChart');

    function updateChart() {
        $.ajax({
            url: '<?= base_url('admin/get_realtime_absensi') ?>',
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
    setInterval(updateChart, 5000); // Ganti sesuai dengan kebutuhan

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