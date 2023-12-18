<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <link rel="icon" href="<?php echo base_url(
        './src/assets/image/absensi.png'
    ); ?>" type="image/gif">
</head>

<body>
    <?php $this->load->view('components/sidebar_super_admin'); ?>
    <div class="p-2 sm:ml-64">
        <!-- Card Selamat Datang -->
        <div class="mt-5 w-full">
            <div
                class="p-4 text-center bg-gray-400 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <?php
                $currentDateTime = date('d F Y H:i:s');
                $currentHour = date('H', strtotime($currentDateTime));
                $date = date('l, d F Y', strtotime($currentDateTime));
                ?>
                <h2 class="text-2xl font-semibold mb-4">Selamat Datang
                    <span><?php echo $this->session->userdata(
                        'username'
                    ); ?></span>
                </h2>
                <p class="text-gray-600">Selamat datang di aplikasi Absensi, <?php echo getNamaHari(
                    $date
                ); ?> <?php echo convDate($date); ?></p>
            </div>
        </div>
        <div class="p-2 mt-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="<?= 'superadmin/organisasi' ?>"
                    class="w-full p-4 text-center bg-blue-400 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Organisasi</h5>
                    <hr class="mb-4 border-black">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $organisasi ?> Organisasi
                        </p>
                        <div class="mt-4">
                            <i class="fa-solid fa-building fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= base_url('superadmin/admin') ?>"
                    class="w-full p-4 text-center bg-green-400 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Admin</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $admin ?> Admin
                        </p>
                        <div class="mt-4">
                            <i class="fa-solid fa-chalkboard-user fa-fw fa-2xl"></i>
                        </div>
                    </div>
                </a>
                <a href="<?= 'superadmin/user' ?>"
                    class="w-full p-4 text-center bg-purple-400 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">User</h5>
                    <hr class="mb-4">
                    <div class="flex justify-between">
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                            <?= $user ?> User
                        </p>
                        <div class="mt-4">
                            <i class="fa-solid fa-users fa-fw fa-2xl"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <br>
        <br>
        <div
            class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between">
                <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Token</h6>
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
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Token
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Dibuat
                            </th>
                            </th>
                        </tr>
                    </thead>
                    <!-- Tabel Body -->
                    <tbody class="text-center">
                        <?php
                        $no = 0;
                        foreach ($tokens as $row):
                            if ($no < 5):
                                $no++; ?>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $no; ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo isset($row->username)
                                    ? $row->username
                                    : 'N/A'; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row->token; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row->created; ?>
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
                    href="<?php echo base_url(
                        'superadmin/token'
                    ); ?>" title="Ke Riwayat Absensi">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
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