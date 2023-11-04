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
            <main id="content" class="flex-1 p-4 sm:p-6">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h1 class="text-2xl font-bold text-center mb-4">REKAP MINGGUAN</h1>
                    <form action="<?= base_url('admin/rekap_mingguan'); ?>" method="post" class="flex flex-col sm:flex-row justify-center items-center gap-4">
                        <input type="week" class="border p-2 rounded-md" id="tanggal" name="tanggal" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : ''; ?>">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">Filter</button>
                        <a href="<?= base_url('Admin/export_rekap_mingguan'); ?>" class="exp bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block ml-auto">Export Data</a>
                        <!-- Class "ml-auto" akan mendorong elemen ke kanan -->
                    </form>

                    <div class="overflow-x-auto mt-4">
                        <table class="w-full whitespace-nowrap">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">NO</th>
                                    <th scope="col" class="px-6 py-3">KEGIATAN</th>
                                    <th scope="col" class="px-6 py-3">TANGGAL</th>
                                    <th scope="col" class="px-6 py-3">JAM MASUK</th>
                                    <th scope="col" class="px-6 py-3">JAM PULANG</th>
                                    <th scope="col" class="px-6 py-3">KETERANGAN</th>
                                  </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
