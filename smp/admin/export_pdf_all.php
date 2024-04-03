<?php

// Inisialisasi session
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../errors/error-403.php');
    exit(); 
}

date_default_timezone_set('Asia/Jakarta');

require_once('../export/tcpdf.php');
include '../inc/koneksi.php';

$status = isset($_GET['status']) ? $_GET['status'] : null;

// Membersihkan nilai parameter 'status' menggunakan htmlspecialchars
$status = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');

// Pastikan status yang dipilih adalah yang valid (diterima, ditolak, atau belum_diverifikasi)
$valid_statuses = ['Semua', 'Diterima', 'Tidak Diterima', 'Belum Diverifikasi'];
if (!in_array($status, $valid_statuses)) {
    die("Status tidak valid.");
}

if ($status === "Semua") {
    // Jika "Semua" dipilih, ambil semua data
    $query = "SELECT * FROM datappdb_smp_ppalmultazam";
} else {
    // Jika status tertentu dipilih, ambil data sesuai dengan status
    $query = "SELECT * FROM datappdb_smp_ppalmultazam WHERE status_pendaftaran = '$status'";
}

$sql = $koneksi->query($query);

// Periksa hasil query
if (!$sql) {
    die("Error: " . $koneksi->error);
}

class MYPDF extends TCPDF
{
    // Flag to check if it's the first page
    private $isFirstPage = true;

    public function Header()
    {
        if ($this->isFirstPage) {
            // Header content for the first page
            $img_file = dirname(__FILE__) . '/logo.png';
            $this->Image($img_file, 8, 15, 27, '', 'PNG');

            // Set header text
            $this->SetFont('times', 'B', 11);
            $this->Cell(0, 10, '', 0, 1, 'C'); // Baris kosong
            $this->Cell(0, 10, 'YAYASAN PENDIDIKAN PONDOK PESANTREN AL-MULTAZAM TANAH MERAH', 0, 1, 'C');
            $this->SetFont('helvetica', 'B', 20);
            $this->Cell(0, 10, 'SMP/SMK/SMA AL-MULTAZAM SEPATAN', 0, 1, 'C'); // Reducing cell height

            // Set address and contact information
            $this->SetFont('helvetica', '', 10);
            $this->Cell(0, 8, 'Sekretariat : Jl. Kedaung Barat Kp. Benda Baru  Rt. 04-03 Ds. Pondok Jaya Kec. Sepatan', 0, 1, 'C'); // Adjusting cell height
            // $this->SetY(36); // Adjust this value as needed
            $this->MultiCell(0, 0, 'Kab. Tangerang Prov. Banten 15520 Email : ppalmultazamtng@gmail.com', 0, 'C');

            // Add a line separator
            $this->SetLineWidth(0.5);
            $this->Line(10, 50, 200, 50);

            // Judul di atas formulir penerimaan peserta didik baru
            $this->SetFont('helvetica', 'B', 16);
            $this->Cell(0, 40, 'Formulir Penerimaan Peserta Didik Baru Tahun 2023', 0, 1, 'C');
            $this->Ln(10); // Spasi setelah judul

        }
        $this->isFirstPage = false;
    }

    public function Footer()
    {
        // Footer content
        $this->SetY(-20);
        $this->SetFont('helvetica', '', 8);

        // $footerText = 'Simpanlah lembar pendaftaran ini sebagai bukti pendaftaran Anda. Waktu Unduh : ' . date('m-d-Y');

        // Tampilkan teks dalam satu baris dengan posisi kanan dan kiri
        // $this->MultiCell(0, 10, $footerText, 0, 'LR');

        $this->SetLineWidth(0.2); // Set lebar garis
        $this->Line($this->GetX(), $this->GetY(), $this->GetX() + 190, $this->GetY());

        $cellWidth = 100;
        // Tampilkan "TEST" di sebelah kiri
        $this->Cell($cellWidth, 10, 'Simpanlah lembar pendaftaran ini sebagai bukti pendaftaran Anda.', 0, 0, 'L');

        // Tampilkan "TEST2" di sebelah kanan
        $this->Cell(0, 10, 'Waktu Unduh : ' . date('d F Y'), 0, 0, 'R');
        $this->ln();

        $pageInfo = 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages();
        $this->MultiCell(0, 10, $pageInfo, 0, 'C');
    }

    public function StartPage($orientation = 'P', $format = 'A4', $keepmargins = false, $tocpage = false)
    {
        parent::StartPage($orientation, $format, $keepmargins, $tocpage);

        // Mark the first page as false after the first page is created
        $this->isFirstPage = false;
    }
}

// Buat PDF dari data siswa
$pdf = new MYPDF('P', 'mm', 'A4');
$pdf->SetTitle('Data Siswa');
$pdf->SetMargins(10, 10, 10);  // Left, Top, Right
$pdf->AddPage();

// Periksa apakah data kosong
if ($sql->num_rows === 0) {
    // Tampilkan pesan jika data kosong
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 150, 'Data tidak ditemukan!', 0, 1, 'C');
} else {

    $pdf->SetY($pdf->GetY() + 70);
    while ($row = $sql->fetch_assoc()) {
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(55, 10, 'Nomor Pendaftaran', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['nomor_pendaftaran'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Jenjang Pendidikan', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['jenjang'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Nama Lengkap', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['nama_lengkap'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'NIK', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['nik'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Jenis Kelamin', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['jenis_kelamin'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Tempat Lahir', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['tempat_lahir'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Tanggal Lahir', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['tgl_lahir'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Asal Sekolah', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['asal_sekolah'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'NISN', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['nisn'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Agama', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['agama'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Tinggi Badan', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['tinggi_badan'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Berat Badan', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['berat_badan'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Jumlah Saudara Kandung', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['jml_sdr_kandung'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(55, 10, 'DATA ORANG TUA', 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Nama Ayah', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['nama_ayah'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Tahun Lahir Ayah', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['thn_lahir_ayah'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Pekerjaan Ayah', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['pekerjaan_ayah'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Penghasilan Ayah', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['penghasilan_ayah'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Pendidikan Ayah', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['pendidikan_ayah'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Nama ibu', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['nama_ibu'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Tahun Lahir ibu', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['thn_lahir_ibu'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Pekerjaan ibu', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['pekerjaan_ibu'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Penghasilan ibu', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['penghasilan_ibu'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Pendidikan ibu', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['pendidikan_ibu'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Alamat  Rumah', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['alamat_rumah'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'RT', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['rt'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'RW', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['rw'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Kode Pos', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['kode_pos'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'No Telpon / WA', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['no_telp'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Email', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->Cell(50, 10, $row['email'], 0);
        $pdf->Ln();

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(55, 10, 'Status Pendaftaran', 0);
        $pdf->Cell(10, 10, ':', 0);
        $pdf->SetFont('helvetica', 'I', 12);
        $pdf->Cell(50, 10, $row['status_pendaftaran'], 0);
        $pdf->Ln();
    }
}

// $pdf->Output('Data_Siswa.pdf', 'D');
// $koneksi->close();

$pdf->setY(0);
$pdf->writeHTML($html, true, true, false, false, '', '', false, false, 'T', 'T', 'C');

// Tampilkan atau unduh PDF dengan nama file sesuai nama siswa
$pdfFileName = "Data_Pendaftar($status).pdf";

// Hentikan output apapun yang telah dilakukan sebelum ini
ob_end_clean();

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $pdfFileName . '"');
$pdf->Output($pdfFileName, 'D');
$koneksi->close();
