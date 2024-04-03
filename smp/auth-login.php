<?php
include './inc/koneksi.php';
// inisialisasi session
session_start();

$error = '';
$validate = '';

// mengecek apakah session username tersedia atau tidak jika tersedia maka akan di-redirect ke halaman index

// mengecek apakah form disubmit atau tidak
if (isset($_POST['login'])) {

    // menghilangkan backslashes
    $username = stripslashes($_POST['username']);
    // cara sederhana mengamankan dari SQL injection
    $username = mysqli_real_escape_string($koneksi, $username);
    // menghilangkan backslashes
    $password = stripslashes($_POST['password']);
    // cara sederhana mengamankan dari SQL injection
    $password = mysqli_real_escape_string($koneksi, $password);

    // cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if (!empty(trim($username)) && !empty(trim($password))) {

        // select data berdasarkan username dari database
        $query  = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $hashed_password = $row['password'];
                $level = $row['level'];

                // Verifikasi kata sandi
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = $level;

                    if ($level === 'admin') {
                        header('Location: admin/index.php');
                    } elseif ($level === 'user') {
                        header('Location: index.php');
                    }
                } else {
                    $error = 'Password yang anda masukkan salah!';
                }
            } else {
                $error = 'Username tidak ditemukan!';
            }
        } else {
            $error = 'Terjadi kesalahan dalam mengambil data dari database.';
        }
    } else {
        $error = 'Data tidak boleh kosong!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="row">
                        <div class="col-md-20 text-center">
                            <img src="assets/images/logo/Al-Multazam_Logo.png" alt="" width="100">
                        </div>
                        <div class="col-md-20 text-center">
                            <h1 class="auth-title">Log in.</h1>
                            <p class="auth-subtitle mb-5">Silahkan Login Disini.</p>
                        </div>
                    </div>

                    <?php if ($error != '') { ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>

                    <form action="" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <?php if ($validate != '') { ?>
                                <p class="text-danger"><?= $validate; ?></p>
                            <?php } ?>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-0" name="login">Log in</button>
                    </form>
                    <!-- <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>