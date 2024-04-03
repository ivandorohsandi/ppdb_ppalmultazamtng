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

$nomor_pendaftaran = isset($_GET['nomor_pendaftaran']) ? $_GET['nomor_pendaftaran'] : null; // ID siswa yang dipilih oleh pengguna

// Membersihkan nilai parameter 'id' menggunakan htmlspecialchars
$nomor_pendaftaran = htmlspecialchars($nomor_pendaftaran, ENT_QUOTES, 'UTF-8');

// Ambil data siswa berdasarkan $id dari database
$query = "SELECT * FROM datappdb_smp_ppalmultazam WHERE nomor_pendaftaran = '$nomor_pendaftaran'";
$no = 1;
$result = $koneksi->query($query);

if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();

    class MYPDF extends TCPDF {
        // Flag to check if it's the first page
        private $isFirstPage = true;
    
        public function Header() {
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
                $this->Cell(0, 40, 'Formulir Pendaftaran Peserta Didik Baru Tahun Ajaran 2023/2024', 0, 1, 'C');
                $this->Ln(10); // Spasi setelah judul
    
            }
            $this->isFirstPage = false;
        }
    
        public function Footer() {
            // Footer content
            $this->SetY(-20);
            $this->SetFont('helvetica', '', 8);
    
            $this->SetLineWidth(0.2); // Set lebar garis
            $this->Line($this->GetX(), $this->GetY(), $this->GetX() + 190, $this->GetY());
            
            $cellWidth = 100;
            // Tampilkan "Simpanlah lembar pendaftaran ini sebagai bukti pendaftaran Anda." di sebelah kiri
            $this->Cell($cellWidth, 10, 'Simpanlah lembar pendaftaran ini sebagai bukti pendaftaran Anda.', 0, 0, 'L');
    
            // Tampilkan "Waktu Unduh : tanggal_sekarang" di sebelah kanan
            $this->Cell(0, 10, 'Waktu Unduh : ' . date('d F Y'), 0, 0, 'R');
            $this->ln();
    
            $pageInfo = 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages();
            $this->MultiCell(0, 10, $pageInfo, 0, 'C');
        }
    
        public function StartPage($orientation = 'P', $format = 'A4', $keepmargins = false, $tocpage = false) {
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
    
    // Tambahkan nomor urut setiap kali Anda menghasilkan formulir PDF
    $pdf->SetY($pdf->GetY() + 70); 
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


    $pdf->setY(0);

    // Tambahkan CSS inline untuk gaya tabel

    $pdf->writeHTML($html, true, true, false, false, '', '', false, false, 'T', 'T', 'C');
    
    // Tampilkan atau unduh PDF dengan nama file sesuai nama siswa
    $pdfFileName = '' . $row['nama_lengkap'] . '.pdf';
    
    // Hentikan output apapun yang telah dilakukan sebelum ini
    ob_end_clean();
    
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $pdfFileName . '"');
    $pdf->Output($pdfFileName, 'I');
    $no++;
} else {
    echo "Siswa dengan ID tersebut tidak ditemukan.";
}

$koneksi->close();
?>
