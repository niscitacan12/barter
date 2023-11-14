<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi App</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="p-4 sm:ml-64">
        <div class="p-5 mt-10">
            <h1>ini Dashboard</h1>
        </div>
    </div>
</body>

<?php if($this->session->flashdata('login_success')){ ?>
<script>
Swal.fire({
    title: 'Berhasil Login',
    text: '<?php echo $this->session->flashdata('login_success'); ?>',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
})
</script>
<?php } ?>

</html>