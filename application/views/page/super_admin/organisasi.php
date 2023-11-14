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

            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Data Organisasi</h6>
                    <a type="button" href="<?php echo base_url(
                        'superadmin/tambah_organisasi'
                    ); ?>"
                        class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"><i
                            class="fa-solid fa-plus"></i></a>
                </div>

                <hr>

                <!-- Tabel -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 mb-5">
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
                                    Alamat
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Telepon
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <!-- Tabel Body -->
                        <tbody class="text-center">
                            <?php
                            foreach ($organisasi as $row): ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo ++$start; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $row->nama_organisasi; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->alamat; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->nomor_telepon; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->email_organisasi; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-content-between">
                                        <a type="button" href="<?= base_url(
                                            'superadmin/detail_organisasi?id=' . 
                                                $row->id_organisasi) ?>"
                                            class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 mx-1 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                        <a type="button" href="<?php echo base_url(
                                            'superadmin/update_organisasi/' .
                                                $row->id_organisasi
                                        ); ?>"
                                            class="text-white bg-yellow-400 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a type="button" href="<?php echo base_url(
                                            'superadmin/hapus_organisasi/' .
                                                $row->id_organisasi
                                        ); ?>"
                                            class="text-white bg-red-600 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                            <i class="fa-solid fa-trash"></i>
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
                <hr class="my-8">
                <div class="flex justify-end">
                    <?= $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>