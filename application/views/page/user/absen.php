<!-- application/views/izin_page.php -->

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
            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Absen</h6>
                </div>
                <hr class="mb-7">

                <div class="text-left">
                    <!-- <form> -->
                    <label for="location" class="block mb-2 text-sm font-semibold">Lokasi:</label>
                    <div class="flex items-center justify-between mb-4">
                        <input type="text" id="geoData" name="lokasi"
                            class="w-full block py-2.5 px-0 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder="klik tombol untuk tampilkan lokasi" readonly>
                        <!-- <div class="text-center mt-3"> -->
                        <button id="getLocation" class="bg-indigo-500 text-white px-4 py-2 rounded-md mb-4">
                            <i class="fa-solid fa-location-dot"></i>
                        </button>
                    </div>

                    <!-- Tambah label untuk foto -->
                    <label for="webcam" class="block mb-2 text-sm font-semibold">Foto:</label>
                    <div class="flex items-center justify-between mb-4">
                        <!-- Container untuk menampilkan hasil foto -->
                        <div id="photoContainer" class="border border-gray-300 rounded-md"></div>
                        <!-- Tombol untuk mengambil gambar dari webcam -->
                        <button id="takeSnapshot" class="bg-indigo-500 text-white px-4 py-2 rounded-md mr-4">
                            <i class="fa-solid fa-camera"></i>
                        </button>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
        <script>
        document.getElementById('getLocation').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var geoData = document.getElementById('geoData');
                    geoData.value = 'Bujur: ' + longitude + ', Lintang: ' + latitude;
                }, function(error) {
                    var geoData = document.getElementById('geoData');
                    geoData.value = 'Error: ' + error.message;
                });
            } else {
                var geoData = document.getElementById('geoData');
                geoData.value = 'Geolocation is not supported by this browser.';
            }
        });
        </script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var video = document.createElement('video');
            var canvas = document.createElement('canvas');
            var photoContainer = document.getElementById('photoContainer');
            var takeSnapshotBtn = document.getElementById('takeSnapshot');

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    console.error('Error accessing webcam:', err);
                });

            takeSnapshotBtn.addEventListener('click', function() {
                var context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                var img = document.createElement('img');
                img.src = canvas.toDataURL('image/png');

                // Bersihkan konten sebelumnya di dalam photoContainer
                photoContainer.innerHTML = '';
                // Tambahkan gambar baru ke dalam photoContainer
                photoContainer.appendChild(img);
            });
        });
        </script>
</body>

</html>