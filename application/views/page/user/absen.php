<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
</head>

<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <!-- Form untuk Absen -->
                <form id="absenForm" action="<?php echo base_url(
                    'user/aksi_absen'
                ); ?>" method="post">

                    <div class="mb-4 text-left">
                        <?php
                        // Mendapatkan nama user dari session
                        $username = $this->session->userdata('username');

                        // Mendapatkan jam dari currentDateTime
                        $currentHour = date('H', strtotime($currentDateTime));

                        // Tampilkan salam berdasarkan jam
                        $greeting = '';
                        if ($currentHour >= 1 && $currentHour < 10) {
                            $greeting = 'Selamat Pagi';
                        } elseif ($currentHour >= 10 && $currentHour < 15) {
                            $greeting = 'Selamat Siang';
                        } elseif ($currentHour >= 15 && $currentHour < 19) {
                            $greeting = 'Selamat Sore';
                        } else {
                            $greeting = 'Selamat Malam';
                        }
                        ?>
                        <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">
                            <?php echo $currentDateTime; ?><br><?php echo $greeting; ?> <span><?php echo $this->session->userdata(
     'username'
 ); ?></span></h6>
                        <hr class="mb-7">
                        <label for="location" class="block text-sm font-semibold mb-2">Lokasi:</label>
                        <div class="flex items-center justify-between">
                            <span id="geoData"
                                class="py-2.5 px-4 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                readonly>
                                <!-- Lokasi akan ditampilkan di sini -->
                            </span>
                        </div>
                    </div>

                    <div class="mb-4 text-left">
                        <label for="webcam" class="block text-sm font-semibold mb-2">Foto:</label>
                        <div class="flex items-center justify-between">
                            <div id="photoContainer" class="border border-gray-300 rounded-md"></div>
                            <button id="takeSnapshot" class="bg-indigo-500 text-white px-4 py-2 rounded-md mr-4">
                                <i class="fa-solid fa-camera"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Input tersembunyi untuk foto_masuk dan lokasi -->
                    <input type="hidden" id="foto_masuk" name="foto_masuk">
                    <input type="hidden" id="lokasi" name="lokasi">

                    <!-- Tombol submit untuk mengirimkan formulir -->
                    <button type="submit" id="absen" class="bg-green-500 text-white px-4 py-2 rounded-md">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    getAndDisplayLocation();
                });

                function getAndDisplayLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;
                            var geoData = document.getElementById('geoData');
                            geoData.innerText = 'Bujur: ' + longitude + ', Lintang: ' + latitude;

                            // Set the value of hidden input for form submission
                            document.getElementById('lokasi').value = 'Bujur: ' + longitude +
                                ', Lintang: ' + latitude;

                            // Tampilkan lokasi
                            alert('Lokasi berhasil ditampilkan.');
                        }, function(error) {
                            var geoData = document.getElementById('geoData');
                            geoData.innerText = 'Error: ' + error.message;
                            alert('Gagal mendapatkan lokasi: ' + error.message);
                        });
                    } else {
                        var geoData = document.getElementById('geoData');
                        geoData.innerText = 'Geolocation is not supported by this browser.';
                        alert('Geolocation is not supported by this browser.');
                    }
                }

                document.getElementById('takeSnapshot').addEventListener('click', function() {
                    var video = document.createElement('video');
                    var canvas = document.createElement('canvas');
                    var photoContainer = document.getElementById('photoContainer');
                    var context = canvas.getContext('2d');

                    navigator.mediaDevices.getUserMedia({
                            video: true
                        })
                        .then(function(stream) {
                            video.srcObject = stream;
                            video.play();
                        })
                        .catch(function(err) {
                            console.error('Error accessing webcam:', err);
                            alert('Error accessing webcam: ' + err.message);
                        });

                    // Ambil snapshot dari video
                    video.addEventListener('loadeddata', function() {
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        var img = document.createElement('img');
                        img.src = canvas.toDataURL('image/png');

                        // Set the value of hidden input for form submission
                        document.getElementById('foto_masuk').value = img.src;

                        // Tampilkan foto
                        photoContainer.innerHTML = '';
                        photoContainer.appendChild(img);

                        alert('Foto berhasil ditampilkan.');
                    });
                });

                document.getElementById('absenForm').addEventListener('submit', function(event) {
                    var kegiatanValue = document.getElementById('kegiatan').value;

                    // Periksa apakah kegiatan tidak kosong sebelum mengirimkan formulir
                    if (kegiatanValue.trim() === '') {
                        alert('Kegiatan tidak boleh kosong.');
                        event.preventDefault(); // Mencegah pengiriman formulir jika kegiatan kosong
                    }
                });
                </script>
            </div>
        </div>
    </div>
</body>

</html>