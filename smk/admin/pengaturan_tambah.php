<?php
// inisialisasi session
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../errors/error-403.php');
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!--SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include '../inc/koneksi.php';

    if (isset($_POST['tambah'])) {
        $gelombang = mysqli_real_escape_string($koneksi, $_POST['gelombang']);

        $gelombangCheckExist = "SELECT * FROM kapasitas WHERE gelombang = '$gelombang'";
        $gelombangresultCheckExist = $koneksi->query($gelombangCheckExist);

        if ($gelombangresultCheckExist->num_rows > 0) {
            echo "
            <script>
                Swal.fire({
                    title: 'Gagal Menambah Data!',
                    text : 'Data sudah tersedia',
                    icon : 'error',
                    confirmButtonText : 'Ok',
                }).then(function () {
                    window.location = '../admin/pengaturan_pendaftaran.php';
                });
            </script>";
        } else {
            $gelombang      = $_POST['gelombang'];
            $kuota          = $_POST['kuota'];
            $tgl_pembukaan  =  $_POST['tgl_pembukaan'];
            $tgl_penutupan  =  $_POST['tgl_pembukaan'];
            $status         = $_POST['status'];

            $query = "INSERT INTO kapasitas (gelombang, kuota, tgl_pembukaan, tgl_penutupan, status)
                        VALUES ('$gelombang', '$kuota', '$tgl_pembukaan', '$tgl_penutupan', '$status')";

            if ($koneksi->query($query) === TRUE) {
                echo "
                <script>
                    Swal.fire({
                            title: 'Berhasil',
                            text : 'Data Berhasil Disimpan!',
                            icon : 'success',
                            toast : 'true',
                            position : 'top-end',
                            showConfirmButton : false,
                            timer : 1500,
                        }).then((result) => {
                            window.location.href = '../admin/pengaturan_pendaftaran.php';
                    });
                </script>";
            } else {
                echo "
                <script>
                    Swal.fire({
                            title: 'Gagal',
                            text : 'Data Gagal Disimpan!',
                            icon : 'error',
                            toast : 'true',
                            position : 'top-end',
                            showConfirmButton : false,
                            timer : 1500,
                        }).then((result) => {
                            window.location.href = '../admin/pengaturan_pendaftaran.php';
                    });
                </script>";
            }
        }
    }
    ?>

</body>

</html>