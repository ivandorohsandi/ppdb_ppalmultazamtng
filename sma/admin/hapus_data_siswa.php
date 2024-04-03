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
if (isset($_GET['nomor_pendaftaran'])) {
    $nomor_pendaftaran = $_GET['nomor_pendaftaran'];

    // Query untuk mengambil nama file foto dan SKL yang akan dihapus
    $queryGetFiles = "SELECT foto, skl FROM datappdb_sma_ppalmultazam WHERE nomor_pendaftaran = '$nomor_pendaftaran'";
    $resultGetFiles = $koneksi->query($queryGetFiles);

    if ($resultGetFiles->num_rows == 1) {
        $rowGetFiles = $resultGetFiles->fetch_assoc();
        $fotoName = $rowGetFiles['foto'];
        $sklName = $rowGetFiles['skl'];

        // Hapus file foto dari sistem file
        $uploadDirFoto = "../uploads/Pasfoto/";
        $fotoPath = $uploadDirFoto . $fotoName;
        if (file_exists($fotoPath)) {
            unlink($fotoPath);
        }

        // Hapus file SKL dari sistem file
        $uploadDirSKL = "../uploads/SKL/";
        $sklPath = $uploadDirSKL . $sklName;
        if (file_exists($sklPath)) {
            unlink($sklPath);
        }

        // Hapus data siswa dari database
        $queryDeleteSiswa = "DELETE FROM datappdb_sma_ppalmultazam WHERE nomor_pendaftaran = '$nomor_pendaftaran'";

        if ($koneksi->query($queryDeleteSiswa) === TRUE) {
            $pesan = "Data dengan nomor pendaftaran $nomor_pendaftaran berhasil dihapus.";
        } 
        else {
           $pesan = "Gagal menghapus data dengan nomor pendaftaran $nomor_pendaftaran.";
        }
        header('location: data_siswa.php?pesan=' . urlencode($pesan));
        
        exit();

    } else {
        echo "
            <script>
                Swal.fire({
                    title: 'Peringatan',  
                    text: 'Nomor pendaftaran data siswa tidak ditemukan.', 
                    icon: 'warning',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                });
          </script>";
    }
}
?>
