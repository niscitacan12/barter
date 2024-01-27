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
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white mb-1">Detail Barang</h6>
                </div>
                <!-- card -->
                <div class="w-full p-4 text-center border border-gray-100 rounded-lg shadow sm:p-8 max-w-xl mx-auto dark:bg-gray-500 dark:border-gray-500">
                    <form action="" 
                        method="post" enctype="multipart/form-data">
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="nama" class="block mb-1 text-left text-xs">Nama Barang</label>
                            <input type="text" name="nama" id="nama" 
                                value="<?php echo $item->nama_barang; ?>" 
                                class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                                autocomplete="off" required readonly/>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="date" class="block mb-1 text-left text-xs">Tanggal</label>
                            <input type="text" name="date" id="date" 
                                value="<?php echo $item ? $item->date : ''; ?>"
                                class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                                autocomplete="off" required readonly/>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="status" class="block mb-1 text-left text-xs">Status</label>
                            <input type="text" name="status" id="status" 
                                value="<?php echo $item ? $item->status : ''; ?>"
                                class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                                autocomplete="off" required readonly/>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="keterangan" class="block mb-1 text-left text-xs">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" 
                                value="<?php echo $item ? $item->keterangan : ''; ?>"
                                class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500 text-sm leading-5 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out"
                                autocomplete="off" required readonly/>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <label for="image" class="block mb-1 text-left text-xs">Image</label>
                            <input type="text" name="image" id="image" 
                                value="<?php echo isset($item->image) ? $item->image : ''; ?>"
                                class="w-full px-3 py-2 rounded-lg border-gray-200 focus:border-gray-500" 
                                autocomplete="off" required />
                        </div>
                        <div class="flex justify-between">
                            <a href="javascript:history.go(-1)" 
                                class="focus:outline-none text-white bg-red-400 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <i class="fa-solid fa-arrow-left-long"></i>
                            </a>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</body>
</html>