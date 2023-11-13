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
        <div class="p-5">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <a href="<?= 'superadmin/organisasi' ?>"
                    class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Organisasi</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $organisasi ?> Organisasi
                        </p>
                        <div>
                            <i class="fa-solid fa-building fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= 'superadmin/admin' ?>"
                    class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Admin</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $admin ?> Admin
                        </p>
                        <div>
                            <i class="fa-solid fa-chalkboard-user fa-fw fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= 'superadmin/user' ?>"
                    class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">User</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $user ?> User
                        </p>
                        <div>
                            <i class="fa-solid fa-users fa-fw fa-2xl"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>