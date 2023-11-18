<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
</head>

<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Absensi</h6>
                </div>
                <hr>

                <!-- Tabel -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                        <!-- Tabel Head -->
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    NO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NAMA
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    KEGIATAN
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TANGGAL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    JAM MASUK
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    JAM PULANG
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    LOKASI
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    KETERANGAN
                                </th>
                            </tr>
                        </thead>
                        <!-- Tabel Body -->
                        <!-- <tbody>
                            <?php
                            $no = 0;
                            foreach ($absensi as $row):
                                $no++; ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $no; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $row->email; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->username; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->nama_depan; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->nama_belakang; ?>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody> -->
                    </table>
                </div>
            </div>
        </div>
</body>

</html>