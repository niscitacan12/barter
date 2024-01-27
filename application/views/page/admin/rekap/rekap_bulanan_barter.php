<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <?php $this->load->view('components/sidebar_admin_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="flex justify-between">
                <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white mb-1">Rekap Bulan</h6>
            </div>
                <p class="text-gray-400 dark:text-white text-center md:text-left">Anda dapat melihat data rekap bulanan dengan memilih bulan</p>
                <p class="text-gray-400 dark:text-white text-center md:text-left mb-6">yang sesuai.</p>
            <main id="content" class="flex-1 p-4 sm:p-6">
                <div class="rounded-lg shadow-md p-4">
                    <div class="relative flex items-center">
                        <form action="<?php base_url('admin/rekap_bulanan_barter'); ?>" method="post" 
                            class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-5">
                            <select name="bulan" id="bulan"
                                class="w-auto px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-left">
                                <option value="" disabled selected>Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <!-- Tombol filter dan export -->
                            <button type="submit"
                                class="bg-indigo-400 hover:bg-indigo text-white font-bold py-2 px-4 rounded inline-block">Filter
                                <i class="fa-solid fa-filter"></i>
                            </button>
                            <a href="<?php echo base_url('admin/export_rekap_bulanan'); ?>"
                                class="exp bg-green-400 hover:bg-green text-white font-bold py-2 px-4 rounded inline-block" style="text-align: right;">
                                Export 
                                <i class="fa-solid fa-download"></i>
                            </a>
                        </form>
                    </div>

                    <br>
                    
                    <?php if (empty($item)): ?>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 py-3">
                        <h1 class="text-2xl font-bold text-center text-white-700 dark:text-white mt-5 mb-3">Data Kosong!!
                        </h1>
                        <p class="text-center">silahkan pilih bulan terlebih dahulu</p>
                    </div>
                    <?php else: ?>
                        <!-- Tabel -->
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Barang
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kategori
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $no = 0;
                                foreach ($item as $row):
                                    $no++;
                                    ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $no; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $row->nama_barang ; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row->kategori ; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $row->status ; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo convDate($row->date); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>