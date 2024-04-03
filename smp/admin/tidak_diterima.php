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

    <!-- Include Magnific -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <style>
        .zoom {
            transition: transform .2s;
            /* Animation */
            width: 200px;
            height: 200px;
            margin: 0 auto;
        }

        .zoom:hover {
            transform: scale(2);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    </style>

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
                                <i class="bi bi-clipboard2-plus"></i>
                                <span>SMP</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item">
                                    <a href="data_siswa.php">Semua Pendaftar</a>
                                </li>

                                <li class="submenu-item">
                                    <a href="diterima.php">Diterima</a>
                                </li>

                                <li class="submenu-item active">
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

                        <li class="sidebar-item">
                            <a href="pengaturan_penerimaan_smp.php" class='sidebar-link'>
                                <i class="bi bi-sliders"></i>
                                <span>Pengaturan Penerimaan</span>
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
                            <h3>Data siswa yang tidak diterima</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="data_siswa.php">SMP</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tidak Diterima</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="badges ">
                                <?php
                               include '../inc/koneksi.php';
                                $query = "SELECT COUNT(*) as jumlah_siswa FROM datappdb_smp_ppalmultazam";
                                $result = $koneksi->query($query);
                                if ($result->num_rows > 0) {
                                    // Mengambil hasil perhitungan
                                    $row = $result->fetch_assoc();
                                    $jumlahSiswa = $row["jumlah_siswa"];
                                    // Menampilkan hasilnya
                                    echo "<span class='badge bg-primary'>Semua Pendaftar : $jumlahSiswa</span>";
                                } else {
                                    echo "Tidak ada data siswa.";
                                }
                                ?>
                                <?php
                                $query2 = "SELECT COUNT(*) as status_pendaftaran FROM datappdb_smp_ppalmultazam WHERE status_pendaftaran = 'Belum Diverifikasi'";
                                $result = $koneksi->query($query2);
                                if ($result->num_rows > 0) {
                                    // Mengambil hasil perhitungan
                                    $row = $result->fetch_assoc();
                                    $status_pendaftaran = $row["status_pendaftaran"];
                                    // Menampilkan hasilnya
                                    echo "<span class='badge bg-warning'>Belum  Diverifikasi : $status_pendaftaran</span>";
                                } else {
                                    echo "Tidak ada data siswa.";
                                }
                                ?>
                                <?php
                                $query3 = "SELECT COUNT(*) as status_pendaftaran FROM datappdb_smp_ppalmultazam WHERE status_pendaftaran = 'Diterima'";
                                $result = $koneksi->query($query3);
                                if ($result->num_rows > 0) {
                                    // Mengambil hasil perhitungan
                                    $row = $result->fetch_assoc();
                                    $status_pendaftaran = $row["status_pendaftaran"];
                                    // Menampilkan hasilnya
                                    echo "<span class='badge bg-success'>Diterima : $status_pendaftaran</span>";
                                } else {
                                    echo "Tidak ada data siswa.";
                                }
                                ?>
                                <?php
                                $query4 = "SELECT COUNT(*) as status_pendaftaran FROM datappdb_smp_ppalmultazam WHERE status_pendaftaran = 'Tidak Diterima'";
                                $result = $koneksi->query($query4);
                                if ($result->num_rows > 0) {
                                    // Mengambil hasil perhitungan
                                    $row = $result->fetch_assoc();
                                    $status_pendaftaran = $row["status_pendaftaran"];
                                    // Menampilkan hasilnya
                                    echo "<span class='badge bg-danger'>Tidak Diterima : $status_pendaftaran</span>";
                                } else {
                                    echo "Tidak ada data siswa.";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>NISN</th>
                                        <th>Agama</th>
                                        <th>Pas Foto</th>
                                        <th>SKL</th>
                                        <th>Status Pendaftaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../inc/koneksi.php';
                                    $query = "SELECT * FROM datappdb_smp_ppalmultazam  WHERE status_pendaftaran ='Tidak Diterima'";
                                    $result = $koneksi->query($query);

                                    $nomor = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $id_daftar_smp = $row['id_daftar_smp'];
                                            $nomor_pendaftaran = $row['nomor_pendaftaran'];
                                            $nama_lengkap = $row['nama_lengkap'];
                                            $jenis_kelamin = $row['jenis_kelamin'];
                                            $tempat_lahir = $row['tempat_lahir'];
                                            $tgl_lahir = date("d-m-y", strtotime($row['tgl_lahir']));
                                            $nisn = $row['nisn'];
                                            $agama = $row['agama'];
                                            $gambarName = $row['foto'];
                                            $gambarPath = "../uploads/Pasfoto/" . $gambarName;

                                            $sklName = $row['skl'];
                                            $sklPath = "../uploads/SKL/" . $sklName;

                                            $status_pendaftaran = $row['status_pendaftaran'];


                                            $badgeStatusPendaftaran = ($status_pendaftaran == 'Diterima') ? 'badge bg-success' : (($status_pendaftaran == 'Belum Diverifikasi') ? 'badge bg-warning' : (($status_pendaftaran == 'Tidak Diterima') ? 'badge bg-danger' : ''));

                                            echo "<tr>
                                                    <td>$nomor</td>
                                                    <td>$nama_lengkap</td>
                                                    <td>$jenis_kelamin</td>
                                                    <td>$tempat_lahir</td>
                                                    <td>$tgl_lahir</td>
                                                    <td>$nisn</td>
                                                    <td>$agama</td>
                                                    <td>
                                                        <a class='image-popup-vertical-fit' href='$gambarPath'>
                                                            <img src='$gambarPath' width='' height='200px' />
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class='image-popup-vertical-fit' href='$sklPath'>
                                                            <img src='$sklPath' width='' height='200px' />
                                                        </a>
                                                    </td>
                                                    <td><span class='$badgeStatusPendaftaran'>$status_pendaftaran</span></td>
                                                    <td>
                                                        <a href='export_pdf_perID.php?nomor_pendaftaran=$nomor_pendaftaran' class='btn btn-sm btn-danger mb-1'>PDF</a>
                                                    </td>
                                                 </tr>";
                                            $nomor++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='12' style='text-align:center';>Tidak ada data.</td></tr>";
                                    }
                                    $koneksi->close();
                                    ?>
                                </tbody>

                                <script>
                                    $(document).ready(function() {
                                        $('#tabel-data').DataTable();
                                    });
                                </script>

                            </table>
                        </div>
                    </div>

                </section>
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

    <script src="../assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="../assets/js/pages/simple-datatables.js"></script>
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