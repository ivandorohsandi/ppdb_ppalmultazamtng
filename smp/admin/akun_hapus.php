<?php
// inisialisasi session
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../errors/error-403.php');
    exit(); 
}
?>

<?php
include '../inc/koneksi.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $query = "DELETE FROM users WHERE username = '$username'"; 

    if ($koneksi->query($query) === TRUE) {
        $pesan = "Data dengan username $username berhasil dihapus.";
    } 
    else {
       $pesan = "Gagal menghapus data dengan username $username.";
    }
    header('location: akun_list.php?pesan=' . urlencode($pesan));
    
    exit();
}
?>