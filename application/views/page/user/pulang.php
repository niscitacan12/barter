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
                <form id="absenForm" action="<?php echo base_url(
                    'user/aksi_pulang'
                ); ?>" method="post">

                    <div class="mb-4 text-left">
                        <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Absen Pulang</h6>
                        <p class="text-center mb-5">
                            <?php echo $date; ?>
                            <br>
                            <?php echo $greeting; ?>,
                            <span><?php echo $this->session->userdata('username'); ?></span>
                        </p>
                        <hr class="mb-7">
                        <label for="location" class="block text-sm font-semibold mb-2">Lokasi:</label>
                        <div class="flex items-center justify-between">
                            <span id="geoData"
                                class="w-full py-2.5 px-4 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                readonly>
                            </span>
                        </div>
                    </div>
                    <!-- Camera Icon -->
                    <div class="mb-4 text-left">
                        <label for="webcam" class="block text-sm font-semibold mb-2">Foto:</label>
                        <div class="flex items-center justify-between">
                            <div id="photoContainer" class="border border-gray-300 rounded-md"></div>
                            <button id="takeSnapshot" class="bg-indigo-500 text-white px-4 py-2 rounded-md mr-4">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Input tersembunyi untuk foto_masuk dan lokasi -->
                    <input type="hidden" id="foto_masuk" name="foto_masuk">
                    <input type="hidden" id="lokasi" name="lokasi">

                    <!-- Tombol submit untuk mengirimkan formulir -->
                    <button type="submit" id="absen" class="bg-green-500 text-white px-4 py-2 rounded-md">
                        <i class="fas fa-home"></i>
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
                    // Periksa apakah kegiatan tidak kosong sebelum mengirimkan formulir
                    if (document.getElementById('foto_masuk').value.trim() === '') {
                        alert('Anda harus mengambil foto terlebih dahulu.');
                        event.preventDefault(); // Mencegah pengiriman formulir jika foto tidak diambil
                    }
                });
                </script>
            </div>
        </div>
    </div>
</body>

</html>