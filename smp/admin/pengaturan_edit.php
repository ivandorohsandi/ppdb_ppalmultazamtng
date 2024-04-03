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

	if (isset($_POST['update'])) {
		$id_kapasitas = $_POST['id_kapasitas'];
		$kuota = $_POST['kuota'];
		$gelombang = $_POST['gelombang'];
		$tgl_pembukaan = $_POST['tgl_pembukaan'];
		$tgl_penutupan = $_POST['tgl_penutupan'];
		$status = $_POST['status'];


		$queryUpdateSiswa = "UPDATE kapasitas SET kuota = '$kuota', gelombang = '$gelombang', tgl_pembukaan = '$tgl_pembukaan', tgl_penutupan = '$tgl_penutupan', status = '$status' WHERE id_kapasitas = '$id_kapasitas'";
		if ($koneksi->query($queryUpdateSiswa)) {
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
	?>
</body>

</html>