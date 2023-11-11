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
    <div class="p-4">
        <div class="p-5 mt-10">
            <!-- Card -->
            <div class="max-w-md mx-auto">
                <label for="location" class="block mb-2 text-sm font-semibold">Lokasi:</label>
                <input type="text" id="geoData" class="w-full border rounded-md py-2 px-3 mb-4"
                    placeholder="Bujur dan Lintang" readonly>
                <button id="getLocation" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Dapatkan
                    Lokasi</button>

                <!-- Tambah label untuk foto -->
                <label for="webcam" class="block mb-2 text-sm font-semibold">Foto:</label>
                <div class="flex items-center justify-between mb-4">
                    <!-- Tombol untuk mengambil gambar dari webcam -->
                    <button id="takeSnapshot" class="bg-blue-500 text-white px-4 py-2 rounded-md mr-4">Ambil
                        Foto</button>
                    <!-- Container untuk menampilkan hasil foto -->
                    <div id="photoContainer" class="w-32 h-32 border border-gray-300 rounded-md"></div>
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
</body>

</html>