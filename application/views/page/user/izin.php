<!-- application/views/izin_page.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Izin</title>
</head>

<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
             <!-- Card -->
             <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Halaman Izin</h6>
                </div>
                <hr>
            
            <!-- Formulir untuk permintaan izin -->
            <form action="#" method="post">
                <!-- Field formulir untuk cuti dari -->
                <div> 
                <label for="leave_from" class="block text-gray-700 font-bold mb-1 text-left">Cuti Dari:</label>
                <input type="date" name="leave_from" id="leave_from" class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500" required>
                </div>
                <br>

                <!-- Field formulir untuk cuti sampai -->
                <div> 
                <label for="leave_to" class="block text-gray-700 font-bold mb-1 text-left">Cuti Sampai:</label>
                <input type="date" name="leave_to" id="leave_to" class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500" required>
                </div>
                <br>

                <!-- Field formulir untuk waktu masuk kerja -->
                <div> 
                <label for="start_time" class="block text-gray-700 font-bold mb-1 text-left">Masuk Kerja:</label>
                <input type="time" name="start_time" id="start_time" class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500" required>
                </div>
                <br>

                <!-- Field formulir untuk jumlah cuti -->
                <div> 
                <label for="leave_duration" class="block text-gray-700 font-bold mb-1 text-left">Jumlah Cuti (hari):</label>
                <input type="number" name="leave_duration" id="leave_duration" class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500" required>
                </div>
                <br>

                <!-- Field formulir untuk keperluan cuti -->
                <div> 
                <label for="leave_purpose" class="block text-gray-700 font-bold mb-1 text-left">Keperluan Cuti:</label>
                <input type="text" name="leave_purpose" id="leave_purpose" class="w-full border-2 border-gray-300 p-2 rounded-md focus:outline-none focus:border-indigo-500" required>
                </div>
                <br>

                 <!-- Tombol Izin -->
                    <div class="text-right">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Kirim Izin</button>
                    </div>

            </form>
        </div>
    </div>
</body>

</html>
