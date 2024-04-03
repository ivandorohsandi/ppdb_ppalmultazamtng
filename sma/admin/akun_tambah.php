<?php
// inisialisasi session
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../errors/error-403.php');
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

    if (isset($_POST['tambah_account'])) {
        $uuid       = mysqli_real_escape_string($koneksi, $_POST['uuid']);
        $username   = mysqli_real_escape_string($koneksi, $_POST['username']);
        $email_adm  = mysqli_real_escape_string($koneksi, $_POST['email_adm']);
        $password   = mysqli_real_escape_string($koneksi, $_POST['password']);
        $repassword = mysqli_real_escape_string($koneksi, $_POST['repassword']);
        $level      = mysqli_real_escape_string($koneksi, $_POST['level']);

        // Periksa apakah nama pengguna sudah ada
        $checkExistQuery = "SELECT * FROM users WHERE username = '$username'";
        $resultCheckExist = $koneksi->query($checkExistQuery);

        if ($resultCheckExist->num_rows > 0) {
            echo '
        <script>
            Swal.fire({
                title : "Gagal Menambah Akun",
                text  : "Maaf, ' . $username . ' sudah terdaftar!",
                icon  : "error",
                confirmButtonText : "Ok",
            }).then(function () {
                window.location = "../admin/akun_list.php";
            });
        </script>';
        } else {
            if (!empty(trim($username)) && !empty(trim($email_adm)) && !empty(trim($password)) && !empty(trim($repassword))) {
                if ($password == $repassword) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $insertQuery = "INSERT INTO users (uuid, username, email_adm, password, level) VALUES ('$uuid', '$username', '$email_adm', '$hashedPassword', '$level')";
                    if ($koneksi->query($insertQuery)) {
                        // Akun berhasil ditambahkan
                        echo '
                    <script>
                        Swal.fire({
                            title : "Sukses Menambah Akun",
                            text : "Akun ' . $username . ' berhasil ditambahkan!",
                            icon : "success",
                            toast: true,
                            position : "top-end",
                            showConfirmButton : false,
                            timer : 3000,
                        }).then(function (){
                            window.location = "../admin/akun_list.php";
                        });
                    </script>';
                    } else {
                        // Tangani error database
                        echo 'Gagal: ' . $koneksi->error;
                    }
                } else {
                    echo '
                    <script>
                        Swal.fire({
                            title : "Gagal Menambah Akun",
                            text  : "Maaf, kata sandi tidak sama!,
                            icon  : "error",
                            confirmButtonText : "Ok",
                        }).then(function () {
                            window.location = "../admin/akun_list.php";
                        });
                    </script>';
                }
            } else {
                echo '
                    <script>
                        Swal.fire({
                                title : "Gagal Menambah Akun",
                                text  : "Maaf, Username, Email dan Password tidak boleh kosong!",
                                icon  : "error",
                                confirmButtonText : "Ok",
                        }).then(function () {
                            window.location = "../admin/akun_list.php";
                        });
                    </script>';
            }
        }
    }
    ?>
</body>

</html>