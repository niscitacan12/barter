<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
</head>
<body>
<?php $this->load->view('components/sidebar_admin'); ?>
<div class="p-4 sm:ml-64">
    <div class="p-5 mt-10">

    <!-- Card -->
    <div class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between">
            <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Detail Shift</h6>
        </div>

        <hr>
        <!-- Profile -->
        <div class="mt-5 text-center">
            <img class="rounded-full w-96 h-96 mx-auto" src="https://cdnwpseller.gramedia.net/wp-content/uploads/2021/06/29145808/Bunga-Lavender.jpg" alt="image description"> 
        </div> 
        <br>
        
        <!-- GET Data dan ID -->
        <?php
        $id_shift = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id_shift !== null) {
            // Panggil model untuk mendapatkan data shift berdasarkan ID
            $this->load->model('admin_model');
            $shift = $this->admin_model->getShiftData($id_shift);

            if ($shift) {
                // Tampilkan data shift
                echo "ID: " . $shift->id_shift . "<br>";
            } else {
                echo "Data shift tidak ditemukan.";
            }
        } else {
            echo "ID tidak valid atau tidak ditemukan.";
        }
        ?>

        <div class="mt-5 text-left">
            <!-- Form Input -->
            <form action="<?php echo base_url(''); ?>" method="post" enctype="multipart/form-data">
                <!-- Nama & Email Input -->
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="nama" id="nama" value="<?php echo $shift->nama_shift; ?>"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " autocomplete="off" required />
                        <label for="nama"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                        </label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="jam_masuk" id="jam_masuk" value="<?php echo $shift->jam_masuk; ?>"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " autocomplete="off" required readonly />
                        <label for="jam_masuk"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jam Masuk
                        </label>
                    </div>
                    <!-- Provinsi Input -->
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="jam_pulang" id="jam_pulang" value="<?php echo $shift->jam_pulang; ?>"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " autocomplete="off" required />
                        <label for="jam_pulang"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jam Pulang
                        </label>
                    </div>
                </div>
                <!-- Button -->
                <div class="flex justify-between">
                    <a class="focus:outline-none text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                        href="javascript:history.go(-1)"> <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
</body>
</html>