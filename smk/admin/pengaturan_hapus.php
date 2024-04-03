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

if (isset($_GET['gelombang'])) {
    $gelombang = $_GET['gelombang'];

    $query = "DELETE FROM kapasitas WHERE gelombang = '$gelombang'"; 

    if ($koneksi->query($query) === TRUE) {
        $pesan = "Data dengan nama $gelombang berhasil dihapus.";
    } 
    else {
       $pesan = "Gagal menghapus data dengan nama $gelombang.";
    }
    header('location: pengaturan_pendaftaran.php?pesan=' . urlencode($pesan));
    
    exit();
}
?>