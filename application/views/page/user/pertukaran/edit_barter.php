Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App - Edit Barang</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php $this->load->view('components/sidebar_user_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <!-- Card -->
            <div class="w-full p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <!-- Formulir Edit Barang -->
                <form action="<?php echo base_url('user/aksi_edit_barter'); ?>" method="post" enctype="multipart/form-data" class="text-left">
                    <input type="hidden" name="id_item" value="<?php echo $item->id_item; ?>">

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-white">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" 
                                class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md"
                                value="<?php echo $item->nama_barang; ?>">
                        </div>
                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-white">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" 
                                class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md"
                                value="<?php echo $item->keterangan; ?>">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-white">Kategori</label>
                            <input type="text" name="kategori" id="kategori"
                            class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md"
                            >
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-white">Status</label>
                            <input type="text" name="status" id="status" 
                                class="mt-1 p-2 w-full border border-gray-300 dark:border-gray-600 rounded-md"
                                >
                            </input>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="javascript:history.go(-1)" 
                            class="focus:outline-none text-white bg-red-400 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            <i class="fa-regular fa-floppy-disk"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>