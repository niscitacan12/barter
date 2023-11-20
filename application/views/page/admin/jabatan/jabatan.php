<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jabatan</title>
</head>

<body>
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <!-- Card -->
            <div
                class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Data Jabatan</h6>
                    <a type="button" href="<?php echo base_url('admin/tambah_jabatan'); ?>"
                        class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover-bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>
                <hr>

                <!-- Tabel -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <!-- Tabel Head -->
                        <thead
                            class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Jabatan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah Karyawan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <th>
                            <!-- Tabel Body -->

                            <?php
                            $no = 0;
                            foreach ($jabatan as $row):
                                $no++; ?>
                            <tbody class="text-center">
                                <tr>
                                    <div
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?php echo $no; ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?php echo $row->nama_jabatan; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo jumlah_karyawan($row->id_jabatan); ?>
                                        </td>
                                        <td class="px-6 py-4">

                                            <a type="button" href="<?= base_url(
                                            'admin/detail_jabatan/' . $row->id_jabatan
                                        ); ?>"
                                                class="text-white bg-indigo-500 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 mx-1 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>
                                            <a type="button" href="<?php echo base_url(
                                            'admin/update_jabatan/' .
                                                $row->id_jabatan
                                        ); ?>"
                                                class="text-white bg-yellow-400 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a type="button" href="<?php echo base_url(
                                            'admin/hapus_jabatan/' .
                                                $row->id_jabatan
                                        ); ?>"
                                                class="text-white bg-red-600 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                            </tbody>
                    </table>
                </div>
            </div>
</body>

<?php if($this->session->flashdata('berhasil_update')){ ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_update'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if($this->session->flashdata('berhasil_tambah')){ ?>
<script>
Swal.fire({
    title: "Berhasil",
    text: "<?php echo $this->session->flashdata('berhasil_tambah'); ?>",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

</html>