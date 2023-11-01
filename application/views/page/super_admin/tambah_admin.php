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
                    <h5>Tambah Admin</h5>
                </div>
                <div class="card-body">
                <form>
                    <!-- Nama Depan input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="Nama_Depan" id="form3Example3" class="form-control" />
                        <label class="form-label" for="form3Example3">Nama Depan</label>
                    </div>

                    <!-- Nama Belakang input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="Nama_Belakang" id="form3Example3" class="form-control" />
                        <label class="form-label" for="form3Example3">Nama Belakang</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" name="Email" id="form3Example3" class="form-control" />
                        <label class="form-label" for="form3Example3">Email</label>
                    </div>

                    <!-- Username input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="Username" id="form3Example3" class="form-control" />
                        <label class="form-label" for="form3Example3">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form3Example4" class="form-control" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>

                    <!-- Organization select -->
                    <div class="form-outline mb-4">
                        <select class="form-select" id="formControlSelect">
                        <option selected>Organisasi</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        </select>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="custom-btn btn-block mb-4">Sign up</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>