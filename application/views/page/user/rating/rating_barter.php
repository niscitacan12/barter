<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php $this->load->view('components/sidebar_user_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white mb-1">Rating Barang</h6>
                </div>
                    <p class="text-gray-400 dark:text-white text-center md:text-left mb-6">Anda dapat memberikan rating dan ulasan</p>
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
                               Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Barang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ulasan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            $no = 0;
                            foreach ($item as $row) :
                                $no++;
                        ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $no; ?>
                            </th>
                            <td class="px-6 py-4">
                                <!-- <?php echo nama_user($row->id_user); ?> -->
                            </td>
                            <td class="px-6 py-4">
                                <?php echo isset($row->nama_barang) ? ($row->nama_barang ): ''; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo isset($row->date) ? ($row->date) : ''; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo isset($row->ulasan) ? ($row->ulasan) : ''; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="">
                                    <a type="button" href="<?php echo base_url('user/rating_ulasan/' . $row->id_item); ?>"
                                        class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="fa-solid fa-star"></i>
                                    </a>
                                </div>
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