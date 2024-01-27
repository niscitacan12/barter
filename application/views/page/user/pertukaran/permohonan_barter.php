<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php $this->load->view('components/sidebar_user_barter'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
                <div class="flex justify-between">
                    <h6 class="mb-2 text-xl font-bold text-gray-900 dark:text-white mb-6">Permohonan Pertukaran Barang</h6>
                </div>
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
                                Nama Barang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $no = 0;
                        foreach ($item as $row):
                            $no++; ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $no; ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo nama_user($row->id_user) ; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row->nama_barang ; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo convDate($row->date); ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($row->image): ?>
                                    <img src="<?php echo base_url('./src/image_user/' . $row->image); ?>" alt="Product Image" width="50">
                                <?php else: ?>
                                    <span>Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row->status ;?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    <a type="button" onclick="batal_permohonan_pertukaran(<?php echo $row->id_item; ?>)"
                                        class="text-white bg-red-400 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                        <i class="fa-solid fa-square-xmark"></i>
                                    </a>
                                    <a type="button" href="<?php echo base_url('user/detail_barter/'.$row->id_item); ?>"
                                        class="text-white bg-green-400 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </div>
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
</body>
<!-- batal pertukaran barang -->
<script>
function batal_permohonan_pertukaran(id_item) 
{
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Ingin membatalkan pertukaran barang anda!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?php echo base_url(
                'user/aksi_batal_permohonan_barter/'
            ); ?>" + id_item;
        }
    });
}
</script>
</html>