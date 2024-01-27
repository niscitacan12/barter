<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-100">
    <div class="flex">
        <!-- navbar -->
        <nav class="fixed top-0 z-50 w-full bg-gray-500 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700"
            style="height: 60px;">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">

                    <div class="mx-auto relative px-5 max-w-screen-xl w-full">
                        <div class="flex items-center justify-start">
                            <!-- Menu Hamburger -->
                            <a class="flex ml-2 md:mr-24">
                                <img src="<?php echo base_url('./src/images/logo_barter.png'); ?>" 
                                    class="h-10 mr-0" alt="Barter Logo" />
                                <span
                                    class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Barter
                                    App</span>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <a type="button" href="<?php echo base_url('auth/register_user_barter'); ?>"
                            class="text-white bg-white-300 hover:bg-white-800 focus:ring-4 focus:ring-white-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-white-600 dark:hover:bg-white-700 focus:outline-none dark:focus:ring-white-800">
                            Daftar
                        </a>
                        <a type="button" href="<?php echo base_url('auth/login_barter'); ?>"
                            class="text-white bg-blue-300 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Masuk
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- background -->
        <div class="p-10 mt-16 mb-6 flex items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3">
                    Selamat Datang Di Website Barter
                </h1>
                <p class="text-lg text-gray-600">
                    Lakukan mencari barang yang anda inginkan dan lakukan tukar barang.
                </p>
            </div>
            <img src="https://i.pinimg.com/236x/8e/26/41/8e2641b5d92251036b6c3c379c1d3047.jpg" 
                class="md:w-1/3 h-auto ml-6" alt="Background Image" />
        </div>
    </div>
</body>

</html>