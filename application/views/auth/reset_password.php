<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <link rel="icon" href="<?php echo base_url(
        './src/assets/image/absensi.png'
    ); ?>" type="image/gif">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-indigo-500">
    <div class="flex justify-center items-center h-screen">
        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" method="post" id="form-reset-password" action="<?= base_url(
                'auth/update_password'
            ) ?>">
                <input type="hidden" name="token" value="<?= $token ?>">

                <div class="relative z-0 w-full mb-6 group">
                    <input type="password" name="password_baru" id="password_baru"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " autocomplete="off" required />
                    <label for="password_baru"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password
                        Baru</label>
                </div>

                <div class="relative z-0 w-full mb-6 group">
                    <input type="password" name="konfirmasi_password" id="konfirmasi_password"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " autocomplete="off" required />
                    <label for="konfirmasi_password"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Konfirmasi
                        Password</label>
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset
                    Password</button>
            </form>
        </div>
    </div>
</body>

<script>
function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function setFormAction(action) {
    // Mengatur aksi formulir dengan URL yang diberikan
    document.getElementById('form-login').setAttribute('action', action);
}

const radioButtons = document.getElementsByName('inline-radio-group');
radioButtons.forEach((radio) => {
    // Menetapkan aksi formulir default saat halaman dimuat
    setFormAction("<?php echo base_url('auth/aksi_login_user'); ?>");

    radio.addEventListener('click', (event) => {
        if (event.target.value === "user") {
            setFormAction("<?php echo base_url('auth/aksi_login_user'); ?>");
        } else if (event.target.value === "admin") {
            setFormAction("<?php echo base_url('auth/aksi_login_admin'); ?>");
        } else if (event.target.value === "superadmin") {
            setFormAction("<?php echo base_url(
                'auth/aksi_login_superadmin'
            ); ?>");
        }
    });
});
</script>

<?php if ($this->session->flashdata('register_success')) { ?>
<script>
Swal.fire({
    title: 'Registrasi Berhasil',
    text: '<?php echo $this->session->flashdata('register_success'); ?>',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

<?php if ($this->session->flashdata('login_error')) { ?>
<script>
Swal.fire({
    title: 'Login Error',
    text: '<?php echo $this->session->flashdata('login_error'); ?>',
    icon: 'error',
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php } ?>

</html>