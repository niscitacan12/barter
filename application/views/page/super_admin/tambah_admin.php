<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Tambah Admin</h2>
    <form action="<?php echo base_url(
        'superadmin/aksi_tambah_admin'
    ); ?>" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="nama_depan">Nama Depan:</label>
        <input type="text" name="nama_depan" required><br>

        <label for="nama_belakang">Nama Belakang:</label>
        <input type="text" name="nama_belakang" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="image">Image URL:</label>
        <input type="file" name="image"><br>

        <label for="id_organisasi">ID Organisasi:</label>
        <input type="text" name="id_organisasi"><br>

        <label for="id_superadmin">ID Superadmin:</label>
        <input type="text" name="id_superadmin"><br>

        <button type="submit">Tambah Admin</button>
    </form>
</body>

</html>