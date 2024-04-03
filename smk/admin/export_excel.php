<?php
// inisialisasi session
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../errors/error-403.php');
    exit(); 
}
?>

<?php

require '../vendor/autoload.php'; // Import the PhpSpreadsheet autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$status = isset($_GET['status']) ? $_GET['status'] : null;

// Membersihkan nilai parameter 'status' menggunakan htmlspecialchars
$status = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');

// Pastikan status yang dipilih adalah yang valid (diterima, ditolak, atau belum_diverifikasi)
$valid_statuses = ['Semua', 'Diterima', 'Tidak Diterima', 'Belum Diverifikasi'];
if (!in_array($status, $valid_statuses)) {
    die("Status tidak valid.");
}

// Function to get student data by status (replace with your data retrieval logic)
function getDataSiswaByStatus($status) {
    // Replace this with your actual data retrieval logic
    include '../inc/koneksi.php';
    if($status === "Semua"){
        $query = "SELECT * FROM datappdb_smk_ppalmultazam";
    }
    else{
        $query = "SELECT * FROM datappdb_smk_ppalmultazam WHERE status_pendaftaran = '$status'";
    }
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
    $koneksi->close();
}


$dataSiswa = getDataSiswaByStatus($status);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Adding data rows to the worksheet using fromArray
$headerRow = array(
    "No",
    "Gelombang",
    "Nomor Pendaftaran",
    "Jenjang", 
    "Jurusan", 
    "Nama Lengkap", 
    "NIK", 
    "Jenis Kelamin", 
    "Tempat Lahir", 
    "Tanggal Lahir", 
    "Asal Sekolah", 
    "NISN", 
    "Agama", 
    "Tinggi Badan", 
    "Jumlah Saudara Kandung", 
    "Nama Ayah", 
    "Tahun Lahir Ayah", 
    "Pekerjaan Ayah", 
    "Penghasilan Ayah", 
    "Pendidikan Ayah", 
    "Nama Ibu", 
    "Tahun Lahir Ibu", 
    "Pekerjaan Ibu", 
    "Penghasilan Ibu", 
    "Pendidikan Ibu", 
    "Alamat Rumah", 
    "RT", 
    "RW", 
    "Kode Pos", 
    "Provinsi", 
    "Kabupaten/Kota", 
    "Kecamatan", 
    "Kelurahan", 
    "No Telpon", 
    "Email", 
    "Status Pendaftaran"
);
$sheet->fromArray([$headerRow], null, 'A1');

$dataRows = array_map(function ($index, $row) {
    // Replace index 0 with the column containing full names in your data
    
    return 
    [
        $index +1,
        $row['nama_gelombang'], 
        $row['nomor_pendaftaran'], 
        $row['jenjang'], 
        $row['jurusan'], 
        $row['nama_lengkap'], 
        $row['nik'], 
        $row['jenis_kelamin'], 
        $row['tempat_lahir'], 
        $row['tgl_lahir'], 
        $row['asal_sekolah'], 
        $row['nisn'], 
        $row['agama'], 
        $row['tinggi_badan'], 
        $row['jml_sdr_kandung'], 
        $row['nama_ayah'], 
        $row['thn_lahir_ayah'], 
        $row['pekerjaan_ayah'], 
        $row['penghasilan_ayah'], 
        $row['pendidikan_ayah'], 
        $row['nama_ibu'], 
        $row['thn_lahir_ibu'], 
        $row['pekerjaan_ibu'], 
        $row['penghasilan_ibu'], 
        $row['pendidikan_ayah'], 
        $row['alamat_rumah'], 
        $row['rt'], 
        $row['rw'], 
        $row['kode_pos'], 
        $row['provinsi'], 
        $row['kabupaten_kota'], 
        $row['kecamatan'], 
        $row['kelurahan'], 
        $row['no_telp'], 
        $row['email'], 
        $row['status_pendaftaran']
    ];
}, array_keys($dataSiswa), $dataSiswa);

$sheet->fromArray($dataRows, null, 'A2');

$writer = new Xlsx($spreadsheet);

$filename = "Data Pendaftar ($status).xlsx"; // Desired Excel file name

ob_clean();

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");

$writer->save('php://output');
?>