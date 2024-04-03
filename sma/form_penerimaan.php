<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penerimaan SMA</title>
    <link rel="shortcut icon" href="assets/images/logo/Al-Multazam_Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <style>
        .footer-about {
            text-align: justify;

        }

        @media (max-width: 576px) {
            .brand {

                width: 220px;

            }
            img {

                width: 260px;
            }
            .logo{
                height: 100px;
                width: 100px;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #ffffff !important">
            <div class="container-fluid">
                <a class="navbar-brand" href="./">
                    <img class="mx-2 brand" src="assets/images/logo/BRAND-AL_MULTAZAM.png" alt="Logo ppalmultazam" height="" width="250" />
                    <span class="text-uppercase font-weight-bold fs-4"></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="registrasi.php">Registrasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Form Penerimaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="https://api.whatsapp.com/send?phone=62887771611393&text=Assalamualaikum Bpk/Ibu mohon maaf saya mengalami kendala dalam proses pendaftaran sma mohon bantuannya 🙏">Mengalami Kendala?</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <?php
    include 'inc/koneksi.php';
    $query = "SELECT status_penerimaan FROM setting_penerimaan WHERE status_penerimaan = 'Open'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        // Memeriksa apakah ada baris yang dikembalikan
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Mengambil nilai status_penerimaan
            $status_penerimaan = $row['status_penerimaan'];
        } else {
            // Jika tidak ada baris yang dikembalikan, set status_penerimaan ke "close"
            $status_penerimaan = "Close";
        }
    } else {
        // Jika terjadi kesalahan saat query, set status_penerimaan ke "close"
        $status_penerimaan = "Close";
    }
    // Menutup koneksi database
    mysqli_close($koneksi);
    ?>

    <?php

    // Menampilkan status_penerimaan

    if ($status_penerimaan == "Close") {
        echo "
        <div class='px-4 py-5 my-5 text-center'>
            <img class='d-block mx-auto mb-4 logo' src='assets/images/logo/Al-Multazam_Logo.png' alt='logo ppalmultazam' width='100' height='100'>
            <h1 class='display-5 fw-bold'>FORM PENERIMAAN</h1>
            <div class='col-lg-6 mx-auto'>
                <p class='lead mb-4'>Mohon maaf form penerimaan hanya dapat diakses oleh calon santri/siswa yang telah melakukan registrasi pendaftaran</p>
            </div>
        </div>
      ";
    } else {
    ?>
        <div class="container mt-4 mb-5">
            <h4 class="fw-bold mt-3">FORM PENERIMAAN SISWA / SISWI BARU TAHUN <?php echo date('Y') ?></h4>
            <div class="mb-4">*Bagi siswa / siswi yang sudah mendaftar dan harap segera melakukan pembayaran secara langsung sebagai salah satu syarat untuk pendaftaran.</div>
            <div class="scroll list-group list-group-horizontal position-relative overflow-auto w-auto">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>NISN</th>
                            <th>No Telpon</th>
                            <th>Email</th>
                            <th>Status Pendaftaran</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include 'inc/koneksi.php';
                        $query = "SELECT * FROM datappdb_sma_ppalmultazam ";
                        $result = $koneksi->query($query);

                        $nomor = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $status_pendaftaran = $row['status_pendaftaran'];
                                $badgeStatusPendaftaran = ($status_pendaftaran == 'Diterima') ? 'badge bg-success' : (($status_pendaftaran == 'Belum Diverifikasi') ? 'badge bg-warning' : (($status_pendaftaran == 'Tidak Diterima') ? 'badge bg-danger' : ''));
                        ?>
                                <tr>
                                    <td><?php echo $nomor ?></td>
                                    <td><?php echo $row['nomor_pendaftaran'] ?></td>
                                    <td><?php echo $row['nama_lengkap'] ?></td>
                                    <td><?php echo $row['jenis_kelamin'] ?></td>
                                    <td><?php echo $row['tempat_lahir'] ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($row['tgl_lahir'])) ?></td>
                                    <td><?php echo $row['nisn'] ?></td>
                                    <td><?php echo $row['no_telp'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><span class="<?php echo $badgeStatusPendaftaran ?>"><?php echo $status_pendaftaran ?></span></td>
                                </tr>
                        <?php

                                $nomor++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php } ?>

    <footer class="footer text-center text-lg-start text-white" style="background-color: #1c2331">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-xl-5 mx-auto mb-4 mt-5">
                    <h6 class="text-capitalize fw-bold fs-4">ponpes al-multazam</h6>
                    <div class="footer-text mt-4">
                        <p class="footer-about">
                            Pondok Pesantren Al-Multazam Tanah Merah program terpadu pendidikan agama dan umum dengan sistem Boarding School didirikan pada tanggal 17 Oktober 1996 terdiri dari pendidikan formal yaitu : SMP, SMA, SMK. Pondok Pesantren Al-Multazam Tanah Merah ikut serta berkiprah untuk masyarakat dalam rangka mencerdaskan anak bangsa dan mengentaskan kebodohan di bidang ilmu pengetahuan agama dan umum, pembangunan pesantren salah satu kriteria dasar dalam membangun suatu sistem pendidikan dengan mewujudkan keselarasan, keseimbangan, dan keserasian antara pembangunan kuantitatif serta antar aspek lahiriyah dan rohaniyah.
                        </p>
                    </div>
                    <div class="social-media d-inline-flex">
                        <div class="row">
                            <div class="col-3">
                                <div class="whatsapp">
                                    <a href="https://api.whatsapp.com/send?phone=6282312234466">
                                        <i class="fab fa-whatsapp fa-2x" style="color: #25d366"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="instagram">
                                    <a href="https://www.instagram.com/pp_almultazam.tng">
                                        <i class="fab fa-instagram fa-2x" style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285aeb 90%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="youtube">
                                    <a href="https://www.youtube.com/c/ppalmultazamtng">
                                        <i class="fab fa-youtube fa-2x" style="color: #ed302f"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 mt-5">
                    <h6 class="text-capitalize fw-bold fs-4">PPDB</h6>
                    <div class="footer-text mt-4">
                        <a href="../smp/index.php" class="text-decoration-none">
                            <p class="text-white">SMP Al-Multazam</p>
                        </a>
                        <a href="../sma/index.php" class="text-decoration-none">
                            <p class="text-white">SMA Al-Multazam</p>
                        </a>
                        <a href="../smk/index.php" class="text-decoration-none">
                            <p class="text-white">SMK Al-Multazam</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4 mt-5">
                    <h6 class="text-capitalize fw-bold fs-4">contact us</h6>
                    <div class="footer-text mt-4">
                        <div class="section-information d-flex m-0-auto mb-3 align-items-center">
                            <div><i class="fas fa-envelope mr-3"></i> ppalmultazamtng@gmail.com</div>
                        </div>
                        <div class="section-information d-flex m-0-auto mb-3 align-items-center">
                            <div><i class="fas fa-phone mr-3"></i> 087771611393</div>
                        </div>
                        <div class="section-information d-flex m-0-auto mb-3 align-items-center">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.0752615910897!2d106.58898937478199!3d-6.120572160017272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a01b7a91f3187%3A0x52673d0ac71a2e04!2sPondok%20Pesantren%20Al%20Multazam%20Sepatan%20Tangerang!5e0!3m2!1sid!2sid!4v1692097422234!5m2!1sid!2sid" width="600" height="350" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright text-center p-3 fw-normal" style="background-color: rgba(0, 0, 0, 0.2)">
            &copy; 2023 - <?php echo date('Y') ?> Copyright Pondok Pesantren Al-Multazam Sepatan
        </div>
    </footer>
    <script>
        new DataTable('#example');
    </script>
</body>
</html>