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
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="p-0">
                    <img class="h-auto max-w-full rounded-lg max-h-40" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg" alt="">
                </div>
                <div class="p-0">
                    <img class="h-auto max-w-full rounded-lg max-h-40" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
                </div>
                <div class="p-0">
                    <img class="h-auto max-w-full rounded-lg max-h-40" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt="">
                </div>
                <div class="p-0">
                    <img class="h-auto max-w-full rounded-lg max-h-40" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="">
                </div>
                <div class="p-0">
                    <img class="h-auto max-w-full rounded-lg max-h-40" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" alt="">
                </div>
                <div class="p-0 max-w-64">
                    <a href="<?php echo base_url('user/tukar_barter'); ?>">
                        <label for="dropzone-file" 
                            class="max-h-40 flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <i class="fas fa-cart-plus text-6xl"></i>
                        </label>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>