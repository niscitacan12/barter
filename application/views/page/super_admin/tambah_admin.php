<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('./src/css/responsive.css'); ?>">
</head>

<body>
<?php $this->load->view('components/sidebar_super_admin'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="card border shadow-5 mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Tambah Admin</h3>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url('SuperAdmin/aksi_tambah_admin') ?>" method="post" enctype="multipart/form-data">

                    <!-- Email input -->
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email">
                        </div>
                    </div>
                    
                    <!-- Username input -->
                    <div class="mb-3 row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="username">
                        </div>
                    </div>
                    
                    <!-- Nama Depan input -->
                    <div class="mb-3 row">
                        <label for="nama_depan" class="col-sm-2 col-form-label">Nama Depan</label>
                        <div class="col-sm-10">
                        <input type="text" name="nama_depan" class="form-control" id="nama_depan">
                        </div>
                    </div>

                    <!-- Nama Belakang input -->
                    <div class="mb-3 row">
                        <label for="nama_belakang" class="col-sm-2 col-form-label">Nama Belakang</label>
                        <div class="col-sm-10">
                        <input type="text" name="nama_belakang" class="form-control" id="nama_belakang">
                        </div>
                    </div>
                    
                    <!-- Password input -->
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </div>

                    <!-- Organization select -->
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Organisasi</label>
                        <div class="col-sm-10">
                        <div class="form-outline mb-4">
                            <select name="id_organisasi" class="form-select" id="formControlSelect">
                                <option selected>Pilih Organisasi</option>
                                <?php foreach ($organisasi as $row) : ?>
                                <option value="<?php echo $row->id_organisasi ?>">
                                    <?php echo $row->nama_organisasi ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="d-flex justify-content-between">
                        <a class="red-btn m-4" href="javascript:history.go(-1)">Kembali</a>
                        <button type="submit" class="custom-btn m-4">Tambah</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script>
function togglePassword() {
    const passwordInput = document.getElementById('form3Example4');
    const eyeIcon = document.querySelector('.toggle-password');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }
}
</script>


</body>

</html>