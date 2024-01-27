<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <!-- <link rel="icon" href="<?php echo base_url('./src/assets/image/barter.png'); ?>"
        type="image/gif"/> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .content {
            transition: margin-left 0.5s;
        }

        .sidebar-open .content {
            margin-left: 240px; 
        }
    </style>
</head>

<body class="font-sans bg-gray-100">
    <div class="flex">
        <nav class="fixed top-0 z-50 w-full bg-gray-500 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700"
            style="height: 60px;">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">

                        <!-- Menu Hamburger -->
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-black rounded-lg sm:hidden">
                            <i class="fa-solid fa-bars fa-xl" aria-hidden="true"></i>
                        </button>
                        <a class="flex ml-2 md:mr-24">
                            <img src="<?php echo base_url('./src/images/logo_barter.png'); ?>" 
                                class="h-10 mr-0" alt="Barter Logo" />
                            <span
                                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Barter
                                App</span>
                        </a>
                    </div>

                    <div class="flex items-center">

                        <!-- Menu Profil -->
                        <div class="flex items-center ml-3">
                            <div class="relative">
                                <button type="button" 
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" 
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user" onclick="toggleDropdown()">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full" src="<?= base_url(); ?>" alt="">
                                </button>

                                <div class="z-50 hidden my-4 text-base list-none bg-indigo-50 divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                                    id="dropdown-user">
                                    <ul class="py-1" role="none">
                                        <li>
                                            <a href="<?php echo base_url('admin/profile_barter'); ?>" 
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem">Profile</a>
                                        </li>
                                        <li>
                                            <button onclick="logoutFunction()"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="button">Log out</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-200 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-200 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="<?php echo base_url('admin'); ?>"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i
                                class="fa-solid fa-house fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                            <span class="ml-3">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/user_barter'); ?>"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i
                                class="fa-solid fa-user fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                            <span class="ml-3">User</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/permohonan_barter'); ?>"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i
                                class="fa-solid fa-circle-check fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                            <span class="ml-3">Permohonan Pertukaran Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/rekap_bulanan_barter'); ?>"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i
                                class="fa-solid fa-calendar fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                            <span class="ml-3">Rekap Bulanan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
</body>
<!-- <script>
        const sidebarButton = document.querySelector('[data-drawer-toggle="logo-sidebar"]');
        const sidebar = document.getElementById('logo-sidebar');
        const content = document.querySelector('.content');

        sidebarButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            content.classList.toggle('sidebar-open');
        });
    </script> -->
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdown-user');
        dropdown.classList.toggle('hidden');
    }
</script>
<script>
function logoutFunction() {
    Swal.fire({
        title: 'Yakin ingin logout?',
        text: "Anda akan keluar dari akun Anda.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo base_url('auth/logout'); ?>";
        }
    });
}
</script>
</html>