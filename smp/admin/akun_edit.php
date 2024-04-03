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
		$uuid      = mysqli_real_escape_string($koneksi, $_POST['uuid']);
		$username  = mysqli_real_escape_string($koneksi, $_POST['username']);
		$password  = mysqli_real_escape_string($koneksi, $_POST['password']);
		$level     = mysqli_real_escape_string($koneksi, $_POST['level']);

        $password = password_hash($password, PASSWORD_DEFAULT);

		$query = "UPDATE users SET username = '$username', password = '$password', level = '$level' WHERE uuid = '$uuid'";
		if ($koneksi->query($query)) {
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
                            window.location.href = '../admin/akun_list.php';
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
                            window.location.href = '../admin/akun_list.php';
                    });
                </script>";
		}
	}
	?>
</body>

</html>