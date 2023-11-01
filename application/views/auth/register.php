<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    <form method="post" action="<?php echo base_url('auth/register_superadmin'); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="nama_depan">First Name:</label>
        <input type="text" name="nama_depan" id="nama_depan" required><br>

        <label for="nama_belakang">Last Name:</label>
        <input type="text" name="nama_belakang" id="nama_belakang" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Register</button>
    </form>
</body>

</html>