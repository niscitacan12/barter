<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <link rel="icon" href="<?php echo base_url(
        './src/assets/image/absensi.png'
    ); ?>" type="image/gif">
</head>

<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <form id="pulangForm" action="<?php echo base_url(
                    'user/aksi_pulang'
                ); ?>" method="post">
                    <!-- 
                    <input type="hidden" name="id_absensi" value="<?php echo $absen->id_absensi; ?>"> -->
                    <div class="mb-4 text-left">
                        <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Absen Pulang</h6>
                        <p class="text-center mb-5"><?php
                        $currentDateTime = date('d F Y H:i:s');
                        $currentHour = date('H', strtotime($currentDateTime));
                        $date = date('l, d F Y', strtotime($currentDateTime));
                        $time = date('H:i', strtotime($currentDateTime));
                        ?>
                            <?php echo getNamaHari($date); ?>,
                            <?php echo convDate($date); ?>
                            <span id="currentTime"></span>
                            <br>
                            <?php echo $greeting; ?>,
                            <span><?php echo $this->session->userdata(
                                'username'
                            ); ?></span>
                        </p>
                        <hr class="mb-7">
                        <label for="location" class="block text-sm font-semibold mb-2">Lokasi:</label>
                        <div class="flex items-center justify-between">
                            <span id="geoData"
                                class="w-full py-2.5 px-4 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                readonly>
                            </span>
                            <input type="hidden" name="lokasi_pulang" id="lokasi_pulang" />
                        </div>
                    </div>
                    <div class="mb-4 text-center">
                        <label for="webcam" class="block text-sm font-semibold mb-2">Foto:</label>
                        <div class="flex items-center justify-center mb-3">
                            <div id="photoContainer" class="border border-gray-300 rounded-md"></div>
                            <video id="video" width="400" height="300" autoplay></video>
                            <canvas id="canvas" style="display:none;"></canvas>
                            <input type="hidden" name="image_data" id="image-data" />
                        </div>
                        <!-- <button type="button" id="capture-btn" class="bg-green-500 text-white px-4 py-2 rounded-md">
                            <i class="fas fa-camera"></i>
                        </button> -->
                    </div>

                    <div class="flex justify-between mt-5">
                        <a class="text-white bg-red-500 px-4 py-2 rounded-md" href="javascript:history.go(-1)"><i
                                class="fa-solid fa-arrow-left"></i></a>

                        <button type="button" id="capture-btn" class="bg-indigo-500 text-white px-4 py-2 rounded-md">
                            <i class="fa-solid fa-address-card"></i>
                        </button>
                    </div>
                </form>
                <!-- script unutk menampilkan jam -->
                <script>
                function getCurrentTimeWIB() {
                    const currentTime = new Date();
                    const options = {
                        timeZone: 'Asia/Jakarta', // Setel zona waktu ke WIB (Asia/Jakarta)
                        hour12: false, // Format 24 jam
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric'
                    };
                    return currentTime.toLocaleTimeString('en-US', options);
                }

                // Fungsi untuk menampilkan waktu saat ini dalam format jam WIB
                function showCurrentTime() {
                    const timeElement = document.getElementById("currentTime");
                    if (timeElement) {
                        timeElement.textContent = getCurrentTimeWIB();
                    }
                }

                // Panggil fungsi showCurrentTime setiap detik
                setInterval(showCurrentTime, 1000);
                </script>
                <!-- script untuk menampilkan lokasi -->
                <script>
                // Deklarasikan variabel global untuk menyimpan data gambar
                let capturedImageData = '';

                // Fungsi untuk mendapatkan lokasi pengguna
                function getGeoLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition, showError);
                    } else {
                        document.getElementById("geoData").innerHTML = "Geolocation is not supported by this browser.";
                    }
                }

                function showPosition(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var accuracy = position.coords.accuracy;

                    // Menampilkan lokasi dalam elemen dengan id "geoData"
                    var geoDataElement = document.getElementById("geoData");
                    geoDataElement.innerHTML = "Latitude: " + latitude + ", Longitude: " + longitude +
                        ", Accuracy: " + accuracy + " meters";

                    // Mengupdate nilai input tersembunyi dengan data lokasi
                    var lokasiMasukInput = document.getElementById("lokasi_pulang");
                    lokasiMasukInput.value = "Latitude: " + latitude + ", Longitude: " + longitude;
                }

                // Fungsi untuk menangani kesalahan geolocation
                function showError(error) {
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            document.getElementById("geoData").innerHTML = "User denied the request for Geolocation.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            document.getElementById("geoData").innerHTML = "Location information is unavailable.";
                            break;
                        case error.TIMEOUT:
                            document.getElementById("geoData").innerHTML =
                                "The request to get user location timed out.";
                            break;
                        case error.UNKNOWN_ERROR:
                            document.getElementById("geoData").innerHTML = "An unknown error occurred.";
                            break;
                    }
                }

                // Panggil fungsi getGeoLocation saat halaman dimuat
                window.onload = function() {
                    getGeoLocation();
                };

                // Fungsi untuk mengambil foto dan menjalankan aksi pulang
                function captureAndSubmit() {
                    const video = document.getElementById('video');
                    const canvas = document.getElementById('canvas');
                    const photoContainer = document.getElementById('photoContainer');

                    const context = canvas.getContext('2d');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);

                    const imageData = canvas.toDataURL('image/png');
                    const imgElement = document.createElement('img');
                    imgElement.src = imageData;
                    photoContainer.innerHTML = '';
                    photoContainer.appendChild(imgElement);

                    // Simpan data gambar yang diambil ke dalam variabel global
                    capturedImageData = imageData;

                    // Sembunyikan elemen video setelah gambar diambil
                    video.style.display = 'none';

                    // Setel nilai input tersembunyi dengan data gambar yang diambil
                    const imageDataInput = document.getElementById('image-data');
                    imageDataInput.value = capturedImageData;

                    // Ambil dan setel lokasi pulang
                    getGeoLocation();

                    // Submit form
                    document.getElementById('pulangForm').submit();
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const video = document.getElementById('video');
                    const captureBtn = document.getElementById('capture-btn');

                    navigator.mediaDevices.getUserMedia({
                            video: true
                        })
                        .then(stream => {
                            video.srcObject = stream;
                        })
                        .catch(err => console.error('Error accessing camera:', err));

                    captureBtn.addEventListener('click', captureAndSubmit);
                });
                </script>
            </div>
        </div>
    </div>
</body>

</html>