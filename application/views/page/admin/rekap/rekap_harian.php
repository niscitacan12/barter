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
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Data Lokasi</h6>
                    <!-- <a type="button" href="<?php echo base_url('admin/tambah_lokasi') ?>"
                        class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"><i
                            class="fa-solid fa-plus"></i></a> -->
                </div>
                <hr>

                <form action="<?= base_url('admin/rekap_harian'); ?>" method="get"
                    class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-5">
                    <input type="date" class="border p-2 rounded-md" id="tanggal" name="tanggal" value="<?= isset(
                            $_GET['tanggal']
                        )
                            ? $_GET['tanggal']
                            : '' ?>">
                    <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo text-white font-bold py-2 px-4 rounded inline-block"><i
                            class="fa-solid fa-filter"></i></button>
                    <a href="<?= base_url('Admin/export_rekap_harian') ?>"
                        class="exp bg-indigo-500 hover:bg-indigo text-white font-bold py-2 px-4 rounded inline-block ml-auto"><i
                            class="fa-solid fa-file-export"></i></a>
                </form>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full whitespace-nowrap">
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
                            <?php
                            $no = 0;
                            foreach ($perhari as $row):
                                $no++; ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>