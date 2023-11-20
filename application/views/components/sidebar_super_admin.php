<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>

<body>

    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-full bg-indigo-500 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">

                    <!-- Hamburger Menu -->
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-black rounded-lg sm:hidden">
                        <i class="fa-solid fa-bars fa-xl" aria-hidden="true"></i>
                    </button>
                    <a class="flex ml-2 md:mr-24">

                        <!-- Logo Aplikasi -->
                        <img src="<?php echo base_url(
                            './src/assets/image/absensi.png'
                        ); ?>" class="h-10 mr-3" alt="Absensi Logo" />

                        <!-- Nama Aplikasi -->
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Absensi
                            App</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <a href="<?php echo base_url(
                                    'superadmin/profile'
                                ); ?>"><img class="w-8 h-8 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                        alt="user photo"></a>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">

                <!-- Menu Dashboard -->
                <li>
                    <a href="<?php echo base_url('superadmin'); ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-tachometer-alt fa-fw fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>

                <!-- Dropdown Data Admin -->
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-data-admin" data-collapse-toggle="dropdown-data-admin">
                        <i
                            class="fa-solid fa-database fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Data Admin</span>
                        <i
                            class="fa-solid fa-chevron-down fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    </button>

                    <ul id="dropdown-data-admin" class="hidden py-2 space-y-2">

                        <!-- Menu Admin -->
                        <li>
                            <a href="<?php echo base_url(
                                'superadmin/admin'
                            ); ?>"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fa-solid fa-chalkboard-user fa-fw fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Admin</span>
                            </a>
                        </li>

                        <!-- Menu Organisasi -->
                        <li>
                            <a href="<?php echo base_url(
                                'superadmin/organisasi'
                            ); ?>"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fa-solid fa-building fa-fw fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Organisasi</span>
                            </a>
                        </li>

                        <!-- Menu Jabatan -->
                        <li>
                            <a href="<?php echo base_url(
                                'superadmin/jabatan'
                            ); ?>"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fa-solid fa-briefcase fa-fw fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Jabatan</span>
                            </a>
                        </li>

                        <!-- Menu Jam Kerja -->
                        <li>
                            <a href="<?php echo base_url(
                                'superadmin/shift'
                            ); ?>"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fa-solid fa-business-time fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Shift</span>
                            </a>
                        </li>

                        </a>
                    </ul>
                </li>

                <!-- Dropdown Data User -->
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-data-user" data-collapse-toggle="dropdown-data-user">
                        <i
                            class="fa-solid fa-database fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Data User</span>
                        <i
                            class="fa-solid fa-chevron-down fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    </button>

                    <ul id="dropdown-data-user" class="hidden py-2 space-y-2">

                        <!-- Menu User -->
                        <li>
                            <a href="<?php echo base_url('superadmin/user'); ?>"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fa-solid fa-users fa-fw fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">User</span>
                            </a>
                        </li>

                        <!-- Menu Absensi -->
                        <li>
                            <a href="<?php echo base_url(
                                'superadmin/absensi'
                            ); ?>"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fa-solid fa-address-card fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                                <span class="flex-1 ml-3 whitespace-nowrap">Absensi</span>
                            </a>
                        </li>
                        </a>
                    </ul>
                </li>

                <!-- Menu Absensi -->
                <!-- <li>
                    <a href="<?php echo base_url('superadmin/absensi'); ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fa-solid fa-address-card fa-lg me-3 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                        <span class="flex-1 ml-3 whitespace-nowrap">Absensi</span>
                    </a>
                </li> -->
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
    </div>
</body>
<script>
function confirmLogout() {
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>

</html>