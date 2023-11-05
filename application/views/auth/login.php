<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-indigo-500">
    <div class="flex justify-center items-center h-screen">

        <!-- Login Card -->
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="<?php echo base_url('auth/aksi_login')?>" method="post">
                <h5 class="text-xl text-center font-medium text-gray-900 dark:text-white">Login</h5>
                <hr>


                <!-- <div class="flex justify-between">
                    <div class="flex items-center mr-4">
                        <input checked id="inline-checked-radio" type="radio" value="" name="inline-radio-group"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-checked-radio"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">User</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input id="inline-2-radio" type="radio" value="" name="inline-radio-group"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-radio"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Admin</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input id="inline-radio" type="radio" value="" name="inline-radio-group"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-radio"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Superadmin</label>
                    </div>
                </div> -->

                <!-- Input email -->
                <div class="relative z-0 w-full mb-6 group">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " autocomplete="off" required />
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>

                <!-- Password Input -->
                <div class="relative z-0 w-full mb-6 group">
                    <input type="password" name="password" id="password"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " autocomplete="off" required />
                    <label for="password"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="showpass" type="checkbox" value=""
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                            onchange="showPassword()">
                    </div>
                    <label for="showpass" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Show
                        Password</label>
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
                <!-- Login text -->
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Tidak memiliki akun? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Registrasi
                        sekarang</a>
                </div>
            </form>
        </div>

    </div>
</body>

<script>
function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.querySelector('form');
//     const radios = document.querySelectorAll('input[type="radio"]');
//     const url = "<?php echo base_url('auth/aksi_login_'); ?>";

//     radios.forEach(radio => {
//         radio.addEventListener('click', function() {
//             if (this.id === 'inline-radio') {
//                 form.action = url + 'superadmin';
//             } else if (this.id === 'inline-2-radio') {
//                 form.action = url + 'admin';
//             } else {
//                 form.action = url + 'user';
//             }
//         });
//     });
// });
</script>

</html>