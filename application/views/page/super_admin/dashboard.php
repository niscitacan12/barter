<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
</head>

<body>
    <?php $this->load->view('components/sidebar_super_admin'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div>

                    <div
                        class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Organisasi</h5>
                        <hr class="mb-4">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Total Organisasi:
                            <?= $jumlah_organisasi ?></p>
                    </div>

                </div>
                <div>

                    <div
                        class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Admin</h5>
                        <hr class="mb-4">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Total Admin:
                            <?= $jumlah_admin ?></p>
                        </p>
                    </div>

                </div>
                <div>

                    <div
                        class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">User</h5>
                        <hr class="mb-4">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Total User:
                            <?= $jumlah_user ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>