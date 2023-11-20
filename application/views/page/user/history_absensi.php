<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">

            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-5 text-xl font-bold text-gray-900 dark:text-white">History Absensi</h6>
                </div>

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
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <?php
                        $no = 0;
                        foreach ($absensi as $row):
                            $no++; ?>
                        <tbody class="text-center">
                            <tr>
                                <div
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $no; ?>
                                    </th>
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
                                    <td class="px-5 py-3">
                                        <?php
                                        // Pastikan izin_diterima adalah properti yang ada pada objek $row dan nilainya true
                                        $isIzinDiterima = property_exists($row, 'izin_diterima') && $row->izin_diterima === true;
                                        $disabledAttribute = $isIzinDiterima ? 'disabled' : '';
                                        ?>
                                        <a href="<?php echo site_url('user/pulang/' . $row->id_absensi); ?>"
                                            class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                            <?php echo $disabledAttribute; ?>>
                                            <i class="fas fa-house-user"></i>
                                        </a>
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

</html>