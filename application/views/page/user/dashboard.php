<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <a href="<?= base_url('user/cuti') ?>" class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Cuti</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $cuti_count ?> Cuti
                        </p>
                        <div>
                            <i class="fa-solid fa-mug-hot fa-fw fa-lg me-3 fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= base_url('user/izin') ?>" class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Izin</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $absensi ?> Izin
                        </p>
                        <div>
                            <i class="fa-solid fa-circle-xmark fa-fw fa-lg me-3 fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= base_url('') ?>" class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Total</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $total ?> Total
                        </p>
                        <div>
                            <i class="fa-solid fa-clock-rotate-left fa-fw fa-lg me-3 fa-2xl"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

<?php if($this->session->flashdata('login_success')){ ?>
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