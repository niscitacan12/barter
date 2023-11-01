<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('./src/css/responsive.css'); ?>">
</head>

<body>
    <?php $this->load->view('components/sidebar_super_admin'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="card border shadow-5 mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Data Admin</h5>
                    <a type="button" href="<?php echo base_url('superadmin/tambah_admin')?>" class="custom-btn"><i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">email</th>
                                    <th scope="col">username</th>
                                    <th scope="col">nama depan</th>
                                    <th scope="col">nama belakang</th>
                                    <th scope="col">organisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0;foreach($admin as $row): $no++ ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php echo $row->username ?></td>
                                    <td><?php echo $row->nama_depan ?></td>
                                    <td><?php echo $row->nama_belakang ?></td>
                                    <td><?php echo organisasi($row->id_organisasi) ?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>