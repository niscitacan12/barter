<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('src/css/style.css') ?>" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php $this->load->view('components/sidebar_user_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <!-- Card -->
            <div class="max-w-2xl mx-auto p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700 mb-8">
                <form action="<?php echo base_url('user/aksi_rating_ulasan'); ?>" 
                    method="post" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="id_ulasan" value="<?php echo $id_ulasan; ?>"> -->
                    <!-- nama barang -->
                    <div class="flex justify-between">
                        <h6 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                            <?php echo $nama_barang; ?>
                        </h6>
                    </div>

                    <!-- form foto -->
                    <div class="text-center mb-8">
                        <img class="rounded w-64 h-64 object-cover mx-auto block" 
                            src=""
                            alt="image description">
                    </div>

                    <!-- textarea -->
                    <div>
                        <label for="message" class="mb-2 text-sm text-gray-900 dark:text-white">
                            Tulis Ulasan Anda Disini
                        </label>
                        <textarea id="message" rows="4" name="ulasan" class="block p-2.5 w-full text-sm text-gray-500 bg-gray-20 rounded-lg border border-gray-300 focus:ring-blue-300 focus:border-blue-300 dark:bg-gray-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-300 dark:focus:border-blue-300 text-left mb-8" 
                            placeholder="Write your thoughts here...">
                        </textarea>
                    </div>

                    <!-- button kembali dan save -->
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