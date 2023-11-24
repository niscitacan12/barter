<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan cuti</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .logo {
        width: 100px;
        /* Sesuaikan ukuran logo */
        height: auto;
    }

    .address {
        text-align: center;
    }

    .content p {
        margin-top: 20px;
        margin-left: 50px;
    }
    </style>

</head>

<body>
    <div class="header">
        <h1>PERMOHONAN PENGAMBILAN CUTI <br><?php echo organisasi(
            $id_organisasi
        ); ?></h1>

        <hr>
    </div>

    <div class="address">

    </div>

    <div class="content">
        <!-- Isi konten surat disini -->
        <p>Yth. HRD PT. <?php echo organisasi(
            $id_organisasi
        ); ?><br>di tempat</p>
        <p>Dengan hormat,<br>yang bertanda tangan dibawah ini:</p>

        <p>Nama : <?php echo nama_user($id_user); ?></p>

        <p>Jabatan :</p>

        <p>Tanggal Pengambilan Cuti : <?php echo date(
            'd F Y',
            strtotime($cuti->awal_cuti)
        ); ?> Sampai Dengan
            <?php echo date('d F Y', strtotime($cuti->akhir_cuti)); ?></p>

        <p>Tanggal Kembali Kerja : <?php echo date(
            'd F Y',
            strtotime($cuti->masuk_kerja)
        ); ?></p>

        <p>Keperluan : <?php echo $cuti->keperluan_cuti; ?></p>

        <p>Bermaksud mengajukan cuti tahunan dari <b><?php echo date(
            'd F Y',
            strtotime($cuti->awal_cuti)
        ); ?> hingga
                <br>
                <?php echo date(
                    'd F Y',
                    strtotime($cuti->akhir_cuti)
                ); ?></b>, saya akan mulai bekerja kembali pada
            <b><?php echo date(
                'd F Y',
                strtotime($cuti->masuk_kerja)
            ); ?></b>. <br>
        </p>
        <p>Demikian permohonan cuti ini saya ajukan. Terimakasih atas perhatian Bapak/Ibu.</p>

        <p>Tanggal <?php echo date('d F Y', strtotime($cuti->awal_cuti)); ?></p>
    </div>
</body>

</html>