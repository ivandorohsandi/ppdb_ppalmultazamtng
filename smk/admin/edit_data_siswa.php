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
    <title>DataTable - Mazer Admin Dashboard</title>

    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="../assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/pages/simple-datatables.css">

    <script src="../assets/js/main.js"></script>

    <!--SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include Magnific -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>


</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html"><img src="../assets/images/logo/logo.svg" alt="Logo" srcset=""></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>SMK</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item">
                                    <a href="data_siswa.php">Semua Pendaftar</a>
                                </li>

                                <li class="submenu-item">
                                    <a href="diterima.php">Diterima</a>
                                </li>

                                <li class="submenu-item">
                                    <a href="tidak_diterima.php">Tidak Diterima</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="pengaturan_pendaftaran.php" class='sidebar-link'>
                                <i class="bi bi-gear"></i>
                                <span>Pengaturan Pendaftaran</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>User</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="akun_list.php">Daftar User</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Form Edit Data</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="data_siswa.php">SMK</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Data Pendaftar</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <?php

                    include '../inc/koneksi.php';

                    function encryptFileName($fileName){
                        $hashedName = hash('sha3-256', $fileName . uniqid());
                        return $hashedName;
                    }

                    function encryptSklName($fileName){
                        $hashedName = hash('sha3-256', $fileName . uniqid());
                        return $hashedName;
                    }

                    if (isset($_GET['nomor_pendaftaran'])) {
                        $nomor_pendaftaran = $_GET['nomor_pendaftaran'];

                        // Membersihkan nilai parameter 'id_daftar_smp' menggunakan htmlspecialchars
                        $nomor_pendaftaran = htmlspecialchars($nomor_pendaftaran, ENT_QUOTES, 'UTF-8');

                        if (isset($_POST['submit'])) {
                            // Proses penyimpanan perubahan data siswa
                            $nama_lengkap       = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
                            $nik                = mysqli_real_escape_string($koneksi, $_POST['nik']);
                            $jenis_kelamin      = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
                            $tempat_lahir       = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
                            $tgl_lahir          = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
                            $asal_sekolah       = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
                            $nisn               = mysqli_real_escape_string($koneksi, $_POST['nisn']);
                            $agama              = mysqli_real_escape_string($koneksi, $_POST['agama']);
                            $tinggi_badan       = mysqli_real_escape_string($koneksi, $_POST['tinggi_badan']);
                            $berat_badan        = mysqli_real_escape_string($koneksi, $_POST['berat_badan']);
                            $jml_sdr_kandung    = mysqli_real_escape_string($koneksi, $_POST['jml_sdr_kandung']);

                            $nama_ayah          = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
                            $thn_lahir_ayah     = mysqli_real_escape_string($koneksi, $_POST['thn_lahir_ayah']);
                            $pekerjaan_ayah     = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ayah']);
                            $penghasilan_ayah   = mysqli_real_escape_string($koneksi, $_POST['penghasilan_ayah']);
                            $pendidikan_ayah    = mysqli_real_escape_string($koneksi, $_POST['pendidikan_ayah']);

                            $nama_ibu           = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
                            $thn_lahir_ibu      = mysqli_real_escape_string($koneksi, $_POST['thn_lahir_ibu']);
                            $pekerjaan_ibu      = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ibu']);
                            $penghasilan_ibu    = mysqli_real_escape_string($koneksi, $_POST['penghasilan_ibu']);
                            $pendidikan_ibu     = mysqli_real_escape_string($koneksi, $_POST['pendidikan_ibu']);

                            $alamat_rumah       = mysqli_real_escape_string($koneksi, $_POST['alamat_rumah']);
                            $rt                 = mysqli_real_escape_string($koneksi, $_POST['rt']);
                            $rw                 = mysqli_real_escape_string($koneksi, $_POST['rw']);
                            $kode_pos           = mysqli_real_escape_string($koneksi, $_POST['kode_pos']);
                            $provinsi           = mysqli_real_escape_string($koneksi, $_POST['provinsi']);
                            $kabupaten_kota     = mysqli_real_escape_string($koneksi, $_POST['kabupaten_kota']);
                            $kecamatan          = mysqli_real_escape_string($koneksi, $_POST['kecamatan']);
                            $kelurahan          = mysqli_real_escape_string($koneksi, $_POST['kelurahan']);
                            $no_telp            = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
                            $email              = mysqli_real_escape_string($koneksi, $_POST['email']);

                            $uploadDirFoto      = "../uploads/Pasfoto/"; //directory upload gambar
                            $fotoName           = $_FILES['new_gambar']['name'];
                            $fotoTmp            = $_FILES['new_gambar']['tmp_name'];

                            $uploadDirSKL       = "../uploads/SKL/"; //directory upload gambar
                            $sklName            = $_FILES['skl']['name'];
                            $sklTmp             = $_FILES['skl']['tmp_name'];

                            $status_pendaftaran = mysqli_real_escape_string($koneksi, $_POST['status_pendaftaran']);

                            $queryUpdateSiswa = "UPDATE datappdb_smk_ppalmultazam SET nama_lengkap = '$nama_lengkap', nik = '$nik', jenis_kelamin = '$jenis_kelamin', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', asal_sekolah = '$asal_sekolah', nisn = '$nisn', agama = '$agama', tinggi_badan = '$tinggi_badan', berat_badan = '$berat_badan', jml_sdr_kandung = '$jml_sdr_kandung', nama_ayah = '$nama_ayah', thn_lahir_ayah = '$thn_lahir_ayah', pekerjaan_ayah = '$pekerjaan_ayah', penghasilan_ayah = '$penghasilan_ayah', pendidikan_ayah = '$pendidikan_ayah', nama_ibu = '$nama_ibu', thn_lahir_ibu = '$thn_lahir_ibu', pekerjaan_ibu = '$pekerjaan_ibu', penghasilan_ibu = '$penghasilan_ibu', pendidikan_ibu = '$pendidikan_ibu', alamat_rumah = '$alamat_rumah', rt = '$rt', rw = '$rw', kode_pos = '$kode_pos', provinsi = '$provinsi', kabupaten_kota = '$kabupaten_kota', kecamatan = '$kecamatan', kelurahan = '$kelurahan', no_telp = '$no_telp', email = '$email', status_pendaftaran = '$status_pendaftaran' WHERE nomor_pendaftaran = '$nomor_pendaftaran'";

                            if ($koneksi->query($queryUpdateSiswa)) {
                                echo "
                                <script>
                                    Swal.fire({
                                        title: 'Berhasil',  
                                        text: 'Data Kamu Berhasil Disimpan', 
                                        icon: 'success',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                    });
                                </script>";
                            } 
                            else {
                                echo"
                                <script>
                                    Swal.fire({
                                        title: 'Gagal',   
                                        text: 'Data Kamu Tidak Berhasil Disimpan',
                                        icon: 'error',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                    });
                                </script>" . $queryUpdateSiswa . "<br>" . $koneksi->error;;
                            }

                            if (!empty($fotoName)) {
                                $allowedExtensions = array("jpg", "jpeg", "png", "gif"); //allowed extensions
                                $extension = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION)); //change extension to lowercase

                                if (in_array($extension, $allowedExtensions)) { //hash name filename with sha-3 
    
                                    $newGambarName = encryptFileName($fotoName); //calling function sha-3 and merge with filename
                                    $newGambarPath = $uploadDirFoto . $newGambarName;

                                    if (move_uploaded_file($fotoTmp, $newGambarPath)) {
                                        // Hapus gambar lama
                                        $queryDelete = "SELECT foto FROM datappdb_smk_ppalmultazam WHERE nomor_pendaftaran = '$nomor_pendaftaran'"; //delete image where id = $gambarId
                                        $resultDelete = $koneksi->query($queryDelete);
                                        if ($resultDelete->num_rows == 1) {
                                            $rowDelete = $resultDelete->fetch_assoc();
                                            $oldGambarPath = $uploadDirFoto . $rowDelete['foto'];
                                            if (file_exists($oldGambarPath)) { //delete old file from folder upload directory
                                                unlink($oldGambarPath);
                                            }
                                        }

                                        $queryUpdateSiswa = "UPDATE datappdb_smk_ppalmultazam SET  foto = '$newGambarName' WHERE nomor_pendaftaran = '$nomor_pendaftaran'";
                                        if ($koneksi->query($queryUpdateSiswa)) {
                                            echo "Pas Foto berhasil diperbarui.";
                                        } else {
                                            echo "Terjadi kesalahan dalam penyimpanan Pas Foto.";
                                        }
                                    } else {
                                        echo "Terjadi kesalahan dalam mengunggah Pas Foto.";
                                    }
                                } else {
                                    echo "Ekstensi upload tidak valid. Hanya diperbolehkan JPG, JPEG, PNG, dan GIF.";
                                }
                            } else {
                                // echo "Pilih Pas Foto baru untuk diunggah, Jika tidak abaikan pesan ini.";
                            }

                            if (!empty($sklName)) {
                                $allowedExtensions = array("jpg", "jpeg", "png", "gif"); //allowed extensions
                                $extension = strtolower(pathinfo($sklName, PATHINFO_EXTENSION)); //change extension to lowercase

                                if (in_array($extension, $allowedExtensions)) { //hash name filename with sha-3 

                                    $newSKLName = encryptSklName($sklName); //calling function sha-3 and merge with filename
                                    $newSKLPath = $uploadDirSKL . $newSKLName;

                                    if (move_uploaded_file($sklTmp, $newSKLPath)) {
                                        // Hapus gambar lama
                                        $queryDelete = "SELECT skl FROM datappdb_smk_ppalmultazam WHERE nomor_pendaftaran = '$nomor_pendaftaran'"; //delete image where id = $gambarId
                                        $resultDelete = $koneksi->query($queryDelete);
                                        if ($resultDelete->num_rows == 1) {
                                            $rowDelete = $resultDelete->fetch_assoc();
                                            $oldSKLPath = $uploadDirSKL . $rowDelete['skl'];
                                            if (file_exists($oldSKLPath)) { //delete old file from folder upload directory
                                                unlink($oldSKLPath);
                                            }
                                        }

                                        $queryUpdateSiswa = "UPDATE datappdb_smk_ppalmultazam SET  skl = '$newSKLName' WHERE nomor_pendaftaran = '$nomor_pendaftaran'";
                                        if ($koneksi->query($queryUpdateSiswa)) {
                                            echo "SKL berhasil diperbarui.";
                                        } else {
                                            echo "Terjadi kesalahan dalam penyimpanan SKL.";
                                        }
                                    } else {
                                        echo "Terjadi kesalahan dalam mengunggah SKL.";
                                    }
                                } else {
                                    echo "Ekstensi upload tidak valid. Hanya diperbolehkan JPG, JPEG, PNG, dan GIF.";
                                }
                            } else {
                                // echo "Pilih Pas Foto baru untuk diunggah, Jika tidak abaikan pesan ini.";
                            }
                        }

                        $query = "SELECT * FROM datappdb_smk_ppalmultazam WHERE nomor_pendaftaran = '$nomor_pendaftaran'";
                        $result = $koneksi->query($query);

                        if ($result->num_rows == 1) {
                            $row                = $result->fetch_assoc();
                            $tgl_daftar         = date("d-m-Y", strtotime($row['tgl_daftar']));
                            $nama_gelombang     = $row['nama_gelombang'];
                            $nomor_pendaftaran  = $row['nomor_pendaftaran'];
                            $jenjang            = $row['jenjang'];
                            $nama_lengkap       = $row['nama_lengkap'];
                            $nik                = $row['nik'];
                            $jenis_kelamin      = $row['jenis_kelamin'];
                            $tempat_lahir       = $row['tempat_lahir'];
                            $tgl_lahir          = $row['tgl_lahir'];
                            $asal_sekolah       = $row['asal_sekolah'];
                            $nisn               = $row['nisn'];
                            $agama              = $row['agama'];
                            $tinggi_badan       = $row['tinggi_badan'];
                            $berat_badan        = $row['berat_badan'];
                            $jml_sdr_kandung    = $row['jml_sdr_kandung'];

                            $nama_ayah          = $row['nama_ayah'];
                            $thn_lahir_ayah     = $row['thn_lahir_ayah'];
                            $pekerjaan_ayah     = $row['pekerjaan_ayah'];
                            $penghasilan_ayah   = $row['penghasilan_ayah'];
                            $pendidikan_ayah    = $row['pendidikan_ayah'];

                            $nama_ibu           = $row['nama_ibu'];
                            $thn_lahir_ibu      = $row['thn_lahir_ibu'];
                            $pekerjaan_ibu      = $row['pekerjaan_ibu'];
                            $penghasilan_ibu    = $row['penghasilan_ibu'];
                            $pendidikan_ibu     = $row['pendidikan_ibu'];

                            $alamat_rumah       = $row['alamat_rumah'];
                            $rt                 = $row['rt'];
                            $rw                 = $row['rw'];
                            $kode_pos           = $row['kode_pos'];
                            $provinsi           = $row['provinsi'];
                            $kabupaten_kota     = $row['kabupaten_kota'];
                            $kecamatan          = $row['kecamatan'];
                            $kelurahan          = $row['kelurahan'];
                            $no_telp            = $row['no_telp'];
                            $email              = $row['email'];

                            $fotoName           = $row['foto'];
                            $gambarPath         = "../uploads/Pasfoto/" . $fotoName;

                            $sklName            = $row['skl'];
                            $sklPath            = "../uploads/SKL/" . $sklName;

                            $status_pendaftaran = $row['status_pendaftaran'];
                    ?>
                            <div class="row match-height">
                                <div class="col-15">
                                    <div class="card"> 
                                        <div class="card-header">
                                            <h4 class="card-title">Edit Data Siswa SMK</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="form" data-parsley-validate method="post" enctype="multipart/form-data">
                                                    <div class="row mb-5">
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Verifikasi Pendaftaran</label>
                                                                <select class="form-select" id="basicSelect" name="status_pendaftaran" data-parsley-required="true">
                                                                    <option value="Diterima"            <?php if ($row['status_pendaftaran'] == 'Diterima')           { ?> selected="selected" <?php } ?>>Diterima</option>
                                                                    <option value="Belum Diverifikasi"  <?php if ($row['status_pendaftaran'] == 'Belum Diverifikasi') { ?> selected="selected" <?php } ?>>Belum Diverifikasi</option>
                                                                    <option value="Tidak Diterima"      <?php if ($row['status_pendaftaran'] == 'Tidak Diterima')     { ?> selected="selected" <?php } ?>>Tidak Diterima</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex justify-content-start">
                                                            <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Tanggal Daftar</label>
                                                                <input type="text" id="first-name-column" class="form-control" name="tgl_daftar" value="<?php echo $tgl_daftar; ?>" data-parsley-required="true" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Gelombang</label>
                                                                <input type="text" id="first-name-column" class="form-control" name="nama_gelombang" value="<?php echo $nama_gelombang; ?>" data-parsley-required="true" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Nomor Pendaftaran</label>
                                                                <input type="text" id="first-name-column" class="form-control" name="nomor_pendaftaran" value="<?php echo $nomor_pendaftaran; ?>" data-parsley-required="true" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Jenjang</label>
                                                                <input type="text" id="first-name-column" class="form-control" name="jenjang" value="<?php echo $jenjang; ?>" data-parsley-required="true" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Nama Lengkap</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" oninput="restrictToLetters(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">NIK</label>
                                                                <input type="text" id="first-name-column" class="form-control" maxlength="16" placeholder="Masukkan NIK Sesuai KK" name="nik" value="<?php echo $nik; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class='form-group mandatory'>
                                                                <fieldset>
                                                                    <label class="form-label">
                                                                        Jenis Kelamin
                                                                    </label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" <?php if ($row['jenis_kelamin'] == "Laki-laki") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?> data-parsley-required="true">
                                                                        <label class="form-check-label form-label" for="jenis_kelamin">
                                                                            Laki-laki
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" <?php if ($row['jenis_kelamin'] == "Perempuan") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?> data-parsley-required="true">
                                                                        <label class="form-check-label form-label" for="jenis_kelamin">
                                                                            Perempuan
                                                                        </label>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Tempat Lahir</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>" oninput="restrictToLetters(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Tanggal Lahir</label>
                                                                <input type="date" id="first-name-column" class="form-control" name="tgl_lahir" value="<?php echo $tgl_lahir; ?>" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Asal Sekolah</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Asal Sekolah" name="asal_sekolah" value="<?php echo $asal_sekolah; ?>" data-parsley-required="true">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">NISN</label>
                                                                <input type="text" id="first-name-column" class="form-control" maxlength="10" placeholder="Masukkan NISN" name="nisn" value="<?php echo $nisn; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12 mb-3">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Agama</label>
                                                                <select class="form-select" id="basicSelect" name="agama" data-parsley-required="true">
                                                                    <option value="Islam" <?php if ($row['agama'] == 'Islam') { ?> selected="selected" <?php } ?>>Islam</option>
                                                                    <option value="Kristen" <?php if ($row['agama'] == 'Kristen') { ?> selected="selected" <?php } ?>>Kristen Protestan</option>
                                                                    <option value="Katolik" <?php if ($row['agama'] == 'Katolik') { ?> selected="selected" <?php } ?>>Katolik</option>
                                                                    <option value="Hindu" <?php if ($row['agama'] == 'Hindu') { ?> selected="selected" <?php } ?>>Hindu</option>
                                                                    <option value="Budha" <?php if ($row['agama'] == 'Budha') { ?> selected="selected" <?php } ?>>Budha</option>
                                                                    <option value="Konghucu" <?php if ($row['agama'] == 'Konghucu') { ?> selected="selected" <?php } ?>>Konghucu</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Tinggi Badan</label>
                                                                <input type="text" id="first-name-column" class="form-control" maxlength="3" placeholder="Masukkan Tinggi Badan" name="tinggi_badan" value="<?php echo $tinggi_badan; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Berat Badan</label>
                                                                <input type="text" id="first-name-column" class="form-control" maxlength="3" placeholder="Masukkan Berat Badan" name="berat_badan" value="<?php echo $berat_badan; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Jumlah Saudara Kandung</label>
                                                                <input type="text" id="first-name-column" class="form-control" maxlength="3" placeholder="Masukkan Jumlah Saudara Kandung" name="jml_sdr_kandung" value="<?php echo $jml_sdr_kandung; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>


                                                        <div class="divider">
                                                            <div class="divider-text fw-bold fs-5">Data Ayah</div>
                                                        </div>
                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Nama Ayah</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Nama Ayah" name="nama_ayah" value="<?php echo $nama_ayah; ?>" oninput="restrictToLetters(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Tahun Lahir Ayah</label>
                                                                <input type="text" id="first-name-column" class="form-control" maxlength="4" placeholder="Masukkan Tahun Lahir Ayah" name="thn_lahir_ayah" value="<?php echo $thn_lahir_ayah; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Pekerjaan Ayah</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Pekerjaan Ayah" name="pekerjaan_ayah" value="<?php echo $pekerjaan_ayah; ?>" oninput="restrictToLetters(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Pengasilan / Bulan</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Penghasilan Ayah" name="penghasilan_ayah" value="<?php echo $penghasilan_ayah; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12 mb-3">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Pendidikan Ayah</label>
                                                                <select class="form-select" id="basicSelect" name="pendidikan_ayah" data-parsley-required="true">
                                                                    <option value="Tidak Bersekolah"             <?php if ($row['pendidikan_ayah'] == 'Tidak Bersekolah')           { ?> selected="selected" <?php } ?>>Tidak Bersekolah</option>
                                                                    <option value="SD / MI"                      <?php if ($row['pendidikan_ayah'] == 'SD / MI')                    { ?> selected="selected" <?php } ?>>SD / MI</option>
                                                                    <option value="SMP / MTs"                    <?php if ($row['pendidikan_ayah'] == 'SMP / MTs')                  { ?> selected="selected" <?php } ?>>SMP / MTs</option>
                                                                    <option value="SMA / SMK / MA / SEDERAJAT"   <?php if ($row['pendidikan_ayah'] == 'SMA / SMK / MA / SEDERAJAT') { ?> selected="selected" <?php } ?>>SMA / SMK / MA / SEDERAJAT</option>
                                                                    <option value="Diploma"                      <?php if ($row['pendidikan_ayah'] == 'Diploma')                    { ?> selected="selected" <?php } ?>>Diploma</option>
                                                                    <option value="S1"                           <?php if ($row['pendidikan_ayah'] == 'S1')                         { ?> selected="selected" <?php } ?>>S1</option>
                                                                    <option value="S2"                           <?php if ($row['pendidikan_ayah'] == 'S2')                         { ?> selected="selected" <?php } ?>>S2</option>
                                                                    <option value="S3"                           <?php if ($row['pendidikan_ayah'] == 'S3')                         { ?> selected="selected" <?php } ?>>S3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="divider">
                                                            <div class="divider-text fw-bold fs-5">Data Ibu</div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Nama Ibu</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Nama Ibu" name="nama_ibu" value="<?php echo $nama_ibu; ?>" oninput="restrictToLetters(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Tahun Lahir Ibu</label>
                                                                <input type="text" id="first-name-column" class="form-control" maxlength="4" placeholder="Masukkan Tahun Lahir Ibu" name="thn_lahir_ibu" value="<?php echo $thn_lahir_ibu; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Pekerjaan Ibu</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Pekerjaan Ibu" name="pekerjaan_ibu" value="<?php echo $pekerjaan_ibu; ?>" oninput="restrictToLetters(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Pengasilan / Bulan</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Penghasilan Ibu" name="penghasilan_ibu" value="<?php echo $penghasilan_ibu; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12 mb-3">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Pendidikan Ibu</label>
                                                                <select class="form-select" id="basicSelect" name="pendidikan_ibu" data-parsley-required="true">
                                                                    <option value="Tidak Bersekolah"             <?php if ($row['pendidikan_ibu'] == 'Tidak Bersekolah')           { ?> selected="selected" <?php } ?>>Tidak Bersekolah</option>
                                                                    <option value="SD / MI"                      <?php if ($row['pendidikan_ibu'] == 'SD / MI')                    { ?> selected="selected" <?php } ?>>SD / MI</option>
                                                                    <option value="SMP / MTs"                    <?php if ($row['pendidikan_ibu'] == 'SMP / MTs')                  { ?> selected="selected" <?php } ?>>SMP / MTs</option>
                                                                    <option value="SMA / SMK / MA / SEDERAJAT"   <?php if ($row['pendidikan_ibu'] == 'SMA / SMK / MA / SEDERAJAT') { ?> selected="selected" <?php } ?>>SMA / SMK / MA / SEDERAJAT</option>
                                                                    <option value="Diploma"                      <?php if ($row['pendidikan_ibu'] == 'Diploma')                    { ?> selected="selected" <?php } ?>>Diploma</option>
                                                                    <option value="S1"                           <?php if ($row['pendidikan_ibu'] == 'S1')                         { ?> selected="selected" <?php } ?>>S1</option>
                                                                    <option value="S2"                           <?php if ($row['pendidikan_ibu'] == 'S2')                         { ?> selected="selected" <?php } ?>>S2</option>
                                                                    <option value="S3"                           <?php if ($row['pendidikan_ibu'] == 'S3')                         { ?> selected="selected" <?php } ?>>S3</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="alamat_rumah" class="form-label">Alamat Rumah</label>
                                                                <textarea class="form-control" rows="3" id="alamat_rumah" name="alamat_rumah" data-parsley-required="true"><?php echo htmlspecialchars($alamat_rumah); ?></textarea>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-12">
                                                            <div class="form-group mandatory row">
                                                                <div class="col-sm-1">
                                                                    <label class="form-label">RT</label>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <input type="text" class="form-control" maxlength="3" name="rt" value="<?php echo $rt; ?>" oninput="restrictToNumber(event)" required />
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <label class="form-label">/ RW</label>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <input type="text" class="form-control" maxlength="3" name="rw" value="<?php echo $rw; ?>" oninput="restrictToNumber(event)" required />
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="form-label">Kode Pos</label>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <input type="text" class="form-control" maxlength="5" name="kode_pos" value="<?php echo $kode_pos; ?>" oninput="restrictToNumber(event)" required />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Provinsi</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Provinsi" name="provinsi" value="<?php echo $provinsi; ?>" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Kabupaten</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Kabupaten" name="kabupaten_kota" value="<?php echo $kabupaten_kota; ?>" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Kecamatan</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Kecamatan" name="kecamatan" value="<?php echo $kecamatan; ?>" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Kelurahan</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Kelurahan" name="kelurahan" value="<?php echo $kelurahan; ?>" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">No Telpon</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Kelurahan" name="no_telp" value="<?php echo $no_telp; ?>" oninput="restrictToNumber(event)" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-12">
                                                            <div class="form-group mandatory">
                                                                <label for="first-name-column" class="form-label">Email</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Masukkan Kelurahan" name="email" value="<?php echo $email; ?>" data-parsley-required="true">
                                                            </div>
                                                        </div>

                                                        <div class="flex-column">
                                                            <div class="col-md-10 col-12 mb-5">
                                                                <div class="form-group mandatory">
                                                                    <label for="first-name-column" class="form-label">Pas Foto</label>
                                                                </div>
                                                                <a class="image-popup-vertical-fit" href="<?php echo $gambarPath; ?>" alt="<?php echo $gambarPath; ?>">
                                                                    <img src="<?php echo $gambarPath; ?>" width="150px" height="200px" />
                                                                </a>   
                                                                <label for="new_gambar" class="form-label">Pas Foto Baru : <?php echo $fotoName; ?></label>
                                                                <input type="file" class="form-control mb-3 mt-3" id="new_gambar" name="new_gambar">
                                                            </div>
                                                        </div>

                                                        <div class="flex-column">
                                                            <div class="col-md-10 col-12 mb-5">
                                                                <div class="form-group mandatory">
                                                                    <label for="first-name-column" class="form-label">SKL</label>
                                                                </div>
                                                                <a class="image-popup-vertical-fit" href="<?php echo $sklPath; ?>" alt="<?php echo $sklPath; ?>">
                                                                    <img src="<?php echo $sklPath; ?>" width="150px" height="200px" />
                                                                </a>  
                                                                <label for="skl" class="form-label">SKL Baru : <?php echo $sklName; ?></label>
                                                                <input type="file" class="form-control mb-3 mt-3" id="skl" name="skl">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 d-flex justify-content-start">
                                                            <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        } else {
                            echo "Data siswa tidak ditemukan.";
                        }
                    } else {
                        echo "ID siswa tidak valid.";
                    }
                    $koneksi->close();
                    ?>

                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>


            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <?php
                        $year = date('Y');
                        echo "<p>2023 - $year &copy; Pondok Pesantren Al-Multazam</p>";
                        ?>
                    </div>
                    <div class="float-end">
                        <p><span class="text-primary">Admin Dashboard</i></span></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/extensions/jquery/jquery.min.js"></script>
    <script src="../assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="../assets/js/pages/parsley.js"></script>

    <script>
        $(document).ready(function() {
            $('.image-popup-vertical-fit').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-img-mobile',
                image: {
                    verticalFit: true,
                },
            });

            $('.image-popup-fit-width').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                image: {
                    verticalFit: false,
                },
            });

            $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                    verticalFit: true,
                },
                zoom: {
                    enabled: true,
                    duration: 300, // don't forget to change the duration also in CSS
                },
                callbacks: {
                    open: function() {
                        // Menambahkan tombol close ke dalam konten lightbox saat terbuka
                        this.content += '<button title="Close (Esc)" type="button" class="mfp-close">×</button>';
                    },
                },
            });
        });
    </script>

</body>

</html>