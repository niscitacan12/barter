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
                <h1 class="text-2xl font-bold text-center mb-4">REKAP HARIAN</h1>
                <form action="<?= base_url('admin/rekap_harian'); ?>" method="post" class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : ''; ?>">
                    <button type="submit" class="btn btn-info text-white">Filter</button>
                    <a href="<?= base_url('Admin/export_rekap_harian'); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded inline-block mt-1">Export Data</a>
                </form>

                <div class="overflow-x-auto mt-4">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold">
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>KEGIATAN</th>
                                <th>TANGGAL</th>
                                <th>JAM MASUK</th>
                                <th>JAM PULANG</th>
                                <th>KETERANGAN IZIN</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </main>
    </div>
        </div>
    </div>
</body>

</html>