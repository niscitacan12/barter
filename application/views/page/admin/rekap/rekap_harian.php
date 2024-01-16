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
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-none shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Rekap Harian</h6>
                </div>
                <hr>

                <form method="get" id="filterForm"
                    class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-5">
                    <input type="date"
                        class="appearance-none block w-full bg-white border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-gray-500"
                        id="tanggal" name="tanggal" value="<?= isset(
                            $_GET['tanggal']
                        )
                            ? $_GET['tanggal']
                            : '' ?>">

                    <div class="flex sm:flex-row gap-4 mx-auto items-center">
                        <button type="button"
                            class="bg-indigo-500 hover:bg-indigo text-white font-bold py-2 px-4 rounded inline-block"
                            onclick="submitForm('filter')">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                        <button type="button"
                            class="exp bg-green-500 hover:bg-green text-white font-bold py-2 px-4 rounded inline-block ml-auto"
                            onclick="submitForm('export')">
                            <i class="fa-solid fa-file-export"></i>
                        </button>
                    </div>
                </form>
                <?php if (empty($perhari)): ?>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5 py-3">
                    <h1 class="text-2xl font-bold text-center text-gray-900 dark:text-white mt-5 mb-3">Data Kosong!!
                    </h1>
                    <p class="text-center">Silahkan pilih tanggal lain</p>
                </div>
                <?php else: ?>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Masuk
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Pulang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $no = 0;
                            foreach ($perhari as $row):
                                $no++; ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $no; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $row->tanggal_absen; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->keterangan_izin; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->jam_masuk; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->jam_pulang; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->status; ?>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
function submitForm(action) {
    var form = $('#filterForm');

    // Set the form action based on the button clicked
    if (action === 'filter') {
        form.attr('action', "<?= base_url('admin/rekap_harian') ?>");
    } else if (action === 'export') {
        form.attr('action', "<?= base_url('admin/export_harian') ?>");
    }

    // Submit the form
    form.submit();
}
</script>

</html>