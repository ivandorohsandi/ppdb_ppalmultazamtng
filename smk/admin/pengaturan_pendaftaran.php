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

    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-clipboard2-plus"></i>
                                <span>SMK</span>
                            </a>
                            <ul class="submenu">
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

                        <li class="sidebar-item active">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-gear"></i>
                                <span>Pengaturan Pendaftaran</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="pengaturan_penerimaan_smk.php" class='sidebar-link'>
                                <i class="bi bi-sliders"></i>
                                <span>Pengaturan Penerimaan</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="akun_list.php" class='sidebar-link'>
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
                            <h3>Anda dapat mengatur pendaftaran disini</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pengaturan Pendaftaran</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn icon icon-left btn-success block mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter1"><i class="bi bi-plus-lg"></i>
                                Tambah Baru
                            </button>
                            <div class="modal fade" id="exampleModalCenter1" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <form action="pengaturan_tambah.php" method="POST" class="col-12">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                    Tambah Pendaftaran
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-10 col-12 mb-2">
                                                    <div class="form-group ">
                                                        <label for="first-name-column" class="form-label">Gelombang</label>
                                                        <select class="form-select" id="basicSelect" name="gelombang">
                                                            <option value="Gelombang 1">Gelombang 1</option>
                                                            <option value="Gelombang 2">Gelombang 2</option>
                                                            <option value="Gelombang 3">Gelombang 3</option>
                                                            <option value="Gelombang 4">Gelombang 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-10 col-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="first-name-column" class="form-label">Kuota</label>
                                                        <input type="text" id="first-name-column" class="form-control" name="kuota">
                                                    </div>
                                                </div>
                                                <div class="col-md-10 col-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="first-name-column" class="form-label">Tanggal Pembukaan</label>
                                                        <input type="date" id="first-name-column" class="form-control" value="<?php echo date('Y-m-d') ?>" name="tgl_pembukaan">
                                                    </div>
                                                </div>
                                                <div class="col-md-10 col-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="first-name-column" class="form-label">Tanggal Penutupan</label>
                                                        <input type="date" id="first-name-column" class="form-control" value="<?php echo date('Y-m-d') ?>" name="tgl_penutupan">
                                                    </div>
                                                </div>
                                                <div class="col-md-10 col-12">
                                                    <label for="status">Pilih Status</label>
                                                    <select class="form-select" id="basicSelect" name="status">
                                                        <option value="">--Pilih Status Pendaftaran--</option>
                                                        <option value="open">Dibuka</option>
                                                        <option value="close">Ditutup</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal" name="tambah">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Accept</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-striped" id="table1" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kuota Pendaftaran</th>
                                        <th>Gelombang</th>
                                        <th>Tgl Pembukaan</th>
                                        <th>Tgl Penutupan</th>
                                        <th>Status</th>
                                        <th>Pendaftar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../inc/koneksi.php';

                                    $query =
                                    "SELECT kapasitas.*, COUNT(datappdb_smk_ppalmultazam.nama_gelombang) AS jumlah_pendaftar
                                    FROM kapasitas
                                    LEFT JOIN datappdb_smk_ppalmultazam ON kapasitas.gelombang = datappdb_smk_ppalmultazam.nama_gelombang
                                    GROUP BY kapasitas.id_kapasitas";

                                    $result = $koneksi->query($query);

                                    $nomor = 1;
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $status = $row['status'];
                                            $badgeStatusPendaftaran = ($status == 'open') ? 'badge bg-success' : (($status == 'close') ? 'badge bg-danger' : '');
                                    ?>
                                            <tr>
                                                <td><?php echo $nomor ?></td>
                                                <td><?php echo $row['kuota'] ?></td>
                                                <td><?php echo $row['gelombang'] ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($row['tgl_pembukaan'])); ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($row['tgl_penutupan'])); ?></td>
                                                <td><span class="<?php echo $badgeStatusPendaftaran ?>"><?php echo $status ?></span></td>
                                                <td><span class="badge bg-primary"><?php echo $row['jumlah_pendaftar'] ?></td></span> <!-- Kolom jumlah pendaftar -->
                                                <td>
                                                    <button class="btn btn-sm btn-warning" data-toggle="modal" type="button" data-bs-toggle="modal" data-bs-target="#update_modal_<?php echo $row['id_kapasitas'] ?>"> Edit</button>
                                                    <button class="btn btn-sm btn-danger"  data-id="<?php echo $row['gelombang']?>" onclick="confirmDelete(this)">Hapus</button>
                                                </td>
                                            </tr>
                                    <?php
                                            $nomor++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='12' style='text-align:center';>Tidak ada data.</td></tr>";
                                    }
                                    $koneksi->close();
                                    ?>

                                    <?php
                                    include '../inc/koneksi.php';
                                    $result = $koneksi->query($query);
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <div class="modal fade" id="update_modal_<?php echo $row['id_kapasitas'] ?>" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <form action="pengaturan_edit.php" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">PENGATURAN PENDAFTARAN</h3>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label>ID</label>
                                                                    <input type="text" name="id_kapasitas" value="<?php echo $row['id_kapasitas'] ?>" class="form-control" readonly />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Kuota</label>
                                                                    <input type="text" name="kuota" value="<?php echo $row['kuota'] ?>" class="form-control" required="required" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group ">
                                                                    <label for="first-name-column" class="form-label">Gelombang</label>
                                                                    <select class="form-select" id="basicSelect" name="gelombang">
                                                                        <option value="Gelombang 1" <?php if ($row['gelombang'] == 'Gelombang 1') { ?> selected="selected" <?php } ?>>Gelombang 1</option>
                                                                        <option value="Gelombang 2" <?php if ($row['gelombang'] == 'Gelombang 2') { ?> selected="selected" <?php } ?>>Gelombang 2</option>
                                                                        <option value="Gelombang 3" <?php if ($row['gelombang'] == 'Gelombang 3') { ?> selected="selected" <?php } ?>>Gelombang 3</option>
                                                                        <option value="Gelombang 4" <?php if ($row['gelombang'] == 'Gelombang 4') { ?> selected="selected" <?php } ?>>Gelombang 4</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Tanggal Pembukaan</label>
                                                                    <input type="date" name="tgl_pembukaan" value="<?php echo $row['tgl_pembukaan'] ?>" class="form-control" required="required" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group">
                                                                    <label>Tanggal Penutupan</label>
                                                                    <input type="date" name="tgl_penutupan" value="<?php echo $row['tgl_penutupan'] ?>" class="form-control" required="required" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-group ">
                                                                    <label for="first-name-column" class="form-label">Status</label>
                                                                    <select class="form-select" id="basicSelect" name="status" data-parsley-required="false">
                                                                        <option value="open" <?php if ($row['status'] == 'open') { ?> selected="selected" <?php } ?>>Open</option>
                                                                        <option value="close" <?php if ($row['status'] == 'close') { ?> selected="selected" <?php } ?>>Close</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal" name="update">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Accept</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <script>
                                    $(document).ready(function() {
                                        $('#tabel-data').DataTable();
                                    });
                                </script>
                                <script>
                                    function confirmDelete(button) {
                                        var namaGelombang = button.getAttribute('data-id');

                                        // Gunakan SweetAlert2 untuk menampilkan dialog konfirmasi
                                        Swal.fire({
                                            title: 'Apakah Anda yakin?',
                                            text: 'Anda tidak dapat mengembalikan data yang dihapus!',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Ya, Hapus!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Jika pengguna mengklik "Ya, Hapus!", maka arahkan ke file PHP hapus
                                                window.location.href = 'pengaturan_hapus.php?gelombang=' + namaGelombang;
                                            }
                                        });
                                    }
                               
                                    var pesanKonfirmasi = "<?php echo isset($_GET['pesan']) ? $_GET['pesan'] : ''; ?>";

                                    if(pesanKonfirmasi !== ""){
                                        if(pesanKonfirmasi.indexOf("Gagal") !== -1){
                                            Swal.fire({
                                            title: 'Error!',
                                            text: pesanKonfirmasi,
                                            icon: 'error',
                                            confirmButtonText: 'Ok'
                                        });
                                        }
                                        else{
                                            Swal.fire({
                                            title: 'Sukses!',
                                            text: pesanKonfirmasi,
                                            icon: 'success',
                                            confirmButtonText: 'Ok'
                                        });
                                        }
                                        history.replaceState({}, document.title, 'pengaturan_pendaftaran.php');
                                    }
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

</body>

</html>