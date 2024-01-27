<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <?php $this->load->view('components/sidebar_admin_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <div class="flex justify-between">
                <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white mb-1">User</h6>
            </div>
                <p class="text-gary-300 dark:text-white mb-7"></p>
            <!-- Card -->
            <div class="w-full p-4 text-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <!-- Tabel -->  
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nomor Telepon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        if (!isset($data_user)) {
                            $data_user = [];
                        }
                        $no = 0;
                        foreach ($data_user as $row):
                            $no++;
                        ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $no; ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $row->username ; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row->email ; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row->nomor_telepon ; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($row->image): ?>
                                    <img src="<?php echo base_url('./src/image_user/' . $row->image); ?>" alt="Product Image" width="50">
                                <?php else: ?>
                                    <span>Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="">
                                    <a type="button" href="<?php echo base_url('admin/tambah_nomor_telepon/' . $row->id_user); ?>"
                                        class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </a>
                                    <a type="button" onclick="hapus_user(<?php echo $row->id_user; ?>)"
                                        class="text-white bg-red-400 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<!-- hapus user -->
<script>
function hapus_user(id_user) 
{
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Ingin menghapus data user!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo base_url(
                'admin/aksi_hapus_user/'
            ); ?>" + id_user;
        }
    });
}
</script>
</html>