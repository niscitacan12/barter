<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
</head>
<body>
    <?php $this->load->view('components/sidebar_user_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white mb-1">komunikasi</h6>
                </div>
                <p class="text-gray-400 dark:text-white text-center md:text-left">Kelola nomor anda dan hubungi penggunaan</p>
                <p class="text-gray-400 dark:text-white text-center md:text-left mb-6">lain dengan menggunakan no.telp dibawah ini.</p>
            <!-- Card -->
            <div class="w-full p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <!-- Tabel -->
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                               Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                               Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                               No.Telp
                            </th>
                            <th scope="col" class="px-6 py-3">
                              Detail
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <!-- <?php
                            $no = 0;
                            foreach ($item as $row) :
                                $no++;
                        ?> -->
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $no; ?>
                            </th>
                            <td class="px-6 py-4">
                                <!-- <?php echo nama_user($row->id_user); ?> -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>