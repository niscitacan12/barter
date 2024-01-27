<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="font-sans bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white">
    <?php $this->load->view('components/sidebar_user_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10 container mx-auto">

            <!-- Pesan Selamat Datang -->
            <h1 class="text-3xl font-bold mb-6">Selamat Datang, <?php echo $this->session->userdata('username'); ?></h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                <a href="<?= base_url('user/permohonan_barter') ?>" class="w-full p-3 flex px-3 py-5 justify-between items-center rounded-xl bg-blue-400 border border-blue-200 rounded-lg shadow sm:p-8 dark:bg-blue-500 dark:border-blue-400">
                    <h5 class="text-white font-bold text-left">Data Barang</h5>
                    <div>
                        <i class="fa-brands fa-dropbox text-blue-500 text-3xl"></i>
                    </div>
                    <p class="text-white sm:text-lg dark:text-gray-400">
                        <?= $item_count ?>
                    </p>
                </a>
                <a href="<?= base_url('') ?>" class="w-full p-3 flex px-3 py-5 justify-between items-center rounded-xl bg-blue-400 border border-blue-200 rounded-lg shadow sm:p-8 dark:bg-blue-500 dark:border-blue-400">
                    <h5 class="text-white font-bold text-left">Pertukaran</h5>
                    <div>
                        <i class="fa-solid fa-arrow-right-arrow-left text-blue-500 text-3xl"></i>
                    </div>
                    <p class="text-white sm:text-lg dark:text-gray-400">
                       <!--  -->
                    </p>
                </a>
            </div>

            <br>

            <!-- Tabel -->
            <div class="w-full p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 overflow-x-auto">
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
                                Tanggal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            $no = 0;
                            foreach ($item as $row):
                                $no++; ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $no; ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $row->nama_barang ; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row->kategori ;?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo convDate($row->date); ?>
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
</body>
<?php if ($this->session->flashdata('login_success')) { ?>
<script>
Swal.fire({
    title: 'Berhasil Login',
    // text: '<?php echo $this->session->flashdata('login_success'); ?>',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
})
</script>
<?php } ?>
</html>