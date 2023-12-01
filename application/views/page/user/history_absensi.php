<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <link rel="icon" href="<?php echo base_url('./src/assets/image/absensi.png'); ?>" type="image/gif">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php $this->load->view('components/sidebar_user'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">

            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">History absensi</h6>
                </div>
                <hr>

                <!-- Tabel -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                        <thead
                            class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Masuk
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Pulang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <!-- Tabel Body -->
                        <tbody class="text-center">
                            <?php
                            $no = 0;
                            foreach ($absensi as $row):
                                $no++; ?>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $no; ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo convDate($row->tanggal_absen); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->jam_masuk; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->jam_pulang; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $row->keterangan_izin; ?>
                                </td>
                                <td class="px-5 py-3">
                                    <a type="button" href="<?= base_url('user/detail_absensi/' .  $row->id_absensi) ?>"
                                        class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 mx-1 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                    <?php if ($row->status != 'true'): ?>
                                    <a type="button" href="<?= base_url('user/pulang/' .  $row->id_absensi) ?>"
                                        class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 mx-1 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                        <i class="fa-solid fa-home"></i>
                                    </a>
                                    <?php else: ?>
                                    <button
                                        class="text-white bg-gray-500 opacity-50 cursor-not-allowed focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 mx-1 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800"
                                        disabled>
                                        <i class="fa-solid fa-home"></i>
                                    </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

<?php if ($this->session->flashdata('berhasil_absen')) { ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_absen'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>


<?php if ($this->session->flashdata('berhasil_izin')) { ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_izin'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>


<?php if ($this->session->flashdata('berhasil_cuti')) { ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_cuti'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if ($this->session->flashdata('berhasil_pulang')) { ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_pulang'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if ($this->session->flashdata('gagal_absen')) { ?>
<script>
Swal.fire({
    title: "Gagal",
    text: "<?php echo $this->session->flashdata('gagal_absen'); ?>",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if ($this->session->flashdata('gagal_izin')) { ?>
<script>
Swal.fire({
    title: "Gagal",
    text: "<?php echo $this->session->flashdata('gagal_izin'); ?>",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if ($this->session->flashdata('gagal_pulang')) { ?>
<script>
Swal.fire({
    title: "Gagal",
    text: "<?php echo $this->session->flashdata('gagal_pulang'); ?>",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if ($this->session->flashdata('berhasil_pulang')) { ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_pulang'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

</html>