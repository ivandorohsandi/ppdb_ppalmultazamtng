<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PPDB | Al-Multazam</title>
  <link rel="shortcut icon" href="assets/images/logo/Al-Multazam_Logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <!--SweetAlert-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="assets/js/main.js"></script>

  <style>
    .footer-about {
      text-align: justify;
    }

    @media (max-width: 576px) {
      img {
        width: 260px;
      }
    }
  </style>

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #ffffff !important">
      <div class="container-fluid">
        <a class="navbar-brand" href="./">
          <img class="mx-2 brand" src="./assets/images/logo/BRAND-AL_MULTAZAM.png" alt="Logo ppalmultazam" height="" width="250" />
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
              <a class="nav-link active" aria-current="page" href="registrasi.php">Registrasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="form_penerimaan.php">Form Penerimaan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="https://api.whatsapp.com/send?phone=62887771611393&text=Assalamualaikum Bpk/Ibu mohon maaf saya mengalami kendala dalam proses pendaftaran smk mohon bantuannya 🙏">Mengalami Kendala?</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <?php
  require_once './inc/koneksi.php';

  // Fungsi untuk membuat nomor pendaftaran secara acak
  function generateRegistrationNumber($length = 8)
  {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $registrationNumber = '';
    for ($i = 0; $i < $length; $i++) {
      $registrationNumber .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $registrationNumber;
  }

  // Panggil fungsi untuk membuat nomor pendaftaran
  $randomNO = generateRegistrationNumber(5); // Ganti 6 dengan panjang nomor yang Anda inginkan


  $query = "SELECT gelombang, status FROM kapasitas WHERE status = 'open'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row && isset($row['status'])) {
      $status = $row['status'];
    } else {
      $status = "close";
    }
  } else {
    $status = "close";
  }

  mysqli_close($koneksi);
  ?>

  <?php
  if ($status == "close") {
    echo "
      <div class='px-4 py-5 my-5 text-center'>
    <img class='d-block mx-auto mb-4' src='./assets/images/logo/Al-Multazam_Logo.png' alt='logo ppalmultazam' width='100' height='100'>
    <h1 class='display-5 fw-bold'>PPDB SUDAH DITUTUP</h1>
    <div class='col-lg-6 mx-auto'>
      <p class='lead mb-4'>Mohon maaf untuk saat ini pendaftaran smk pondok pesantren al-multazam sudah ditutup</p>
    </div>
  </div>
      ";
  } else {

  ?>

    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
      <div class="container">
        <div class="row py-5">
          <h5 class="display-5 fw-bold lh-1 mb-4 text-capitalize fs-5">
            registrasi siswa baru <span class="badge bg-secondary">SMK</span>
          </h5>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label"> Gelombang</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <?php
              $gelombang = $row["gelombang"];
              ?>
              <input type="text" class="form-control" value="<?php echo $gelombang; ?>" name="nama_gelombang" required readonly />
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label"> ID Daftar</label>
            </div>
            <div class="col-xxl-10 col-lg-12">

              <input type="text" class="form-control" value="<?php echo $randomNO; ?>" name="nomor_pendaftaran" required readonly />
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label"> Jenjang Pendidikan</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Jenjang Pendidikan" value="SMK" name="jenjang" required readonly />
            </div>
          </div>
          
          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Jurusan Yang Dipilih</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <select class="form-select" id="prepend-text-single-field" name="jurusan" required>
                <option value="">--Pilih Salah Satu--</option>
                <option value="TKJ">TKJ</option>
                <option value="Administrasi Perkantoran">Administrasi Perkantoran</option>
              </select>
              <div class="invalid-feedback ml-2">Jurusan harus dipilih!!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label"> Nama Calon Siswa/Siswi</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" oninput="restrictToLetters(event)" required />
              <div class="invalid-feedback">Nama lengkap harus diisi!</div>
              <div class="valid-feedback">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label"> NIK</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="text" class="form-control" maxlength="16" placeholder="Masukkan NIK Sesuai KK" name="nik" oninput="restrictToNumber(event)" required />
              <div class="invalid-feedback">Nama lengkap harus diisi!</div>
              <div class="valid-feedback">Ok!</div>
            </div>
          </div>

          <div class="form-group row mb-2">
            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10 mt-2">
              <div class="custom-control custom-radio custom-control-inline">
                <input class="form-check-input" type="radio" id="Laki-laki" value="Laki-laki" name="jenis_kelamin" required />
                <label class="form-check-label" for="Laki-laki">Laki - Laki</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input class="form-check-input" type="radio" id="Perempuan" value="Perempuan" name="jenis_kelamin" required />
                <label class="form-check-label" for="Perempuan">Perempuan</label>
                <div class="invalid-feedback ml-2">Jenis kelamin harus pilih!</div>
                <div class="valid-feedback ml-2">Ok!</div>
              </div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Tempat Lahir</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="text" class="form-control" maxlength="30" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" oninput="restrictToLetters(event)" required />
              <div class="invalid-feedback">Tempat Lahir harus diisi!</div>
              <div class="valid-feedback">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Tanggal Lahir</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="date" class="form-control" name="tgl_lahir" required />
              <div class="invalid-feedback ml-2">Tanggal lahir harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Asal Sekolah</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Asal Sekolah" name="asal_sekolah" oninput="combine(event)" required />
              <div class="invalid-feedback ml-2">Asal Sekolah harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">NISN</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="text" class="form-control" maxlength="10" placeholder="Masukkan NISN" name="nisn" oninput="restrictToNumber(event)" required />
              <div class="invalid-feedback ml-2">NISN harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Agama</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <select class="form-select" id="prepend-text-single-field" name="agama" required>
                <option value="">--Pilih Salah Satu--</option>
                <option value="1">Islam</option>
                <option value="2">Kristen Protestan</option>
                <option value="3">Katolik</option>
                <option value="4">Hindu</option>
                <option value="5">Budha</option>
                <option value="6">Konghucu</option>
                <option value="0">Atheis</option>
              </select>
              <div class="invalid-feedback ml-2">Agama harus dipilih!!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Tinggi Badan (cm)</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <div class="row">
                <div class="col-sm-3">
                  <input type="text" class="form-control" placeholder="Tinggi Badan" maxlength="3" name="tinggi_badan" oninput="restrictToNumber(event)" required />
                  <div class="invalid-feedback ml-2">Tinggi badan harus diisi!</div>
                  <div class="valid-feedback ml-2">Ok!</div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Berat Badan (kg)</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <div class="row">
                <div class="col-sm-3">
                  <input type="text" class="form-control" placeholder="Berat Badan" maxlength="3" name="berat_badan" oninput="restrictToNumber(event)" required />
                  <div class="invalid-feedback ml-2">Berat badan harus diisi!</div>
                  <div class="valid-feedback ml-2">Ok!</div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Jumlah Saudara Kandung</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <div class="row">
                <div class="col-sm-3">
                  <input type="text" class="form-control" placeholder="Jumlah Saudara Kandung" maxlength="3" name="jml_sdr_kandung" oninput="restrictToNumber(event)" required />
                  <div class="invalid-feedback ml-2">Jumlah saudara kandung harus diisi!</div>
                  <div class="valid-feedback ml-2">Ok!</div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Nama Ayah</label>
            </div>
            <div class="col-xxl-6 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Nama Ayah" name="nama_ayah" oninput="restrictToLetters(event)" required />
              <div class="invalid-feedback ml-2">Nama ayah harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
            <div class="col-sm-1">
              <label class="col-form-label">Tahun Lahir</label>
            </div>
            <div class="col-xxl-3 col-lg-12">
              <input type="text" class="form-control" maxlength="4" placeholder="Masukkan Tahun Lahir Ayah" name="thn_lahir_ayah" oninput="restrictToNumber(event)" required />
              <div class="invalid-feedback ml-2">Tahun lahir ayah harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Pekerjaan Ayah</label>
            </div>
            <div class="col-xxl-6 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Pekerjaan Ayah" name="pekerjaan_ayah" oninput="restrictToLetters(event)" required />
              <div class="invalid-feedback ml-2">Pekerjaan ayah harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
            <div class="col-sm-1">
              <label class="col-form-label">Penghasilan / Bulan</label>
            </div>
            <div class="col-xxl-3 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Penghasilan Ayah" name="penghasilan_ayah" oninput="restrictToNumber(event)" required />
              <div class="invalid-feedback ml-2">Penghasilan ayah harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Pendidikan Ayah</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <select class="form-select" id="prepend-text-single-field" name="pendidikan_ayah" required>
                <option value="">--Pilih Salah Satu--</option>
                <option value="Tidak Bersekolah">Tidak Bersekolah</option>
                <option value="SD / MI">SD / MI</option>
                <option value="SMP / MTs">SMP / MTs</option>
                <option value="SMA / SMK / MA / SEDERAJAT">SMA / SMK / MA / SEDERAJAT </option>
                <option value="DIPLOMA">Diploma</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
              </select>
              <div class="invalid-feedback ml-2">Pendidikan ayah harus dipilih!!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Nama Ibu</label>
            </div>
            <div class="col-xxl-6 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Nama Ibu" name="nama_ibu" oninput="restrictToLetters(event)" required />
              <div class="invalid-feedback ml-2">Nama ibu harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
            <div class="col-sm-1">
              <label class="col-form-label">Tahun Lahir</label>
            </div>
            <div class="col-xxl-3 col-lg-12">
              <input type="text" class="form-control" maxlength="4" placeholder="Masukkan Tahun Lahir Ibu" name="thn_lahir_ibu" oninput="restrictToNumber(event)" required />
              <div class="invalid-feedback ml-2">Tahun lahir ibu harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Pekerjaan Ibu</label>
            </div>
            <div class="col-xxl-6 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Pekerjaan Ibu" name="pekerjaan_ibu" oninput="restrictToLetters(event)" required />
              <div class="invalid-feedback ml-2">Pekerjaan ibu harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
            <div class="col-sm-1">
              <label class="col-form-label">Penghasilan / Bulan</label>
            </div>
            <div class="col-xxl-3 col-lg-12">
              <input type="text" class="form-control" placeholder="Masukkan Penghasilan Ibu" name="penghasilan_ibu" oninput="restrictToNumber(event)" required />
              <div class="invalid-feedback ml-2">Penghasilan ibu harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Pendidikan Ibu</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <select class="form-select" id="prepend-text-single-field" name="pendidikan_ibu" required>
                <option value="">--Pilih Salah Satu--</option>
                <option value="Tidak Bersekolah">Tidak Bersekolah</option>
                <option value="SD / MI">SD / MI</option>
                <option value="SMP / MTs">SMP / MTs</option>
                <option value="SMA / SMK / MA / SEDERAJAT">SMA / SMK / MA / SEDERAJAT </option>
                <option value="DIPLOMA">Diploma</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
              </select>
              <div class="invalid-feedback ml-2">Pendidikan ibu harus dipilih!!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Alamat Lengkap</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <textarea class="form-control" aria-label="With textarea" maxlength="50" placeholder="Masukkan Alamat Lengkap" name="alamat_rumah" required></textarea>
              <div class="invalid-feedback ml-2">Alamat lengkap harus diisi!!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label"></label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <div class="row">
                <div class="col-sm-1">
                  <label class="col-form-label">RT</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control" maxlength="3" name="rt" oninput="restrictToNumber(event)" required />
                  <div class="invalid-feedback ml-2">RT harus diisi!</div>
                  <div class="valid-feedback ml-2">Ok!</div>
                </div>
                <div class="col-sm-1">
                  <label class="col-form-label">/ RW</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control" maxlength="3" name="rw" oninput="restrictToNumber(event)" required />
                  <div class="invalid-feedback ml-2">RW harus diisi!</div>
                  <div class="valid-feedback ml-2">Ok!</div>
                </div>
                <div class="col-sm-1">
                  <label class="col-form-label">Kode Pos</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control" maxlength="5" name="kode_pos" oninput="restrictToNumber(event)" required />
                  <div class="invalid-feedback ml-2">Kode Pos harus diisi!</div>
                  <div class="valid-feedback ml-2">Ok!</div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Provinsi</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <select class="form-select" id="provinsi" name="provinsi" required>
                <option>--Pilih Provinsi--</option>
              </select>
              <div class="invalid-feedback ml-2">Provinsi harus dipilih!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Kabupaten/kota</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <select class="form-select" id="kabupaten_kota" name="kabupaten_kota" required>
                <option value="">--Pilih Kabupaten/Kota--</option>
              </select>
              <div class="invalid-feedback ml-2">Kabupaten/Kota harus dipilih!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Kecamatan</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <select class="form-select" id="kecamatan" name="kecamatan" required>
                <option value="">--Pilih Kecamatan--</option>
              </select>
              <div class="invalid-feedback ml-2">Kecamatan harus dipilih!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Kelurahan</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <select class="form-select" id="kelurahan" name="kelurahan" required>
                <option value="">--Pilih Kelurahan--</option>
              </select>
              <div class="invalid-feedback ml-2">Kelurahan harus dipilih!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">No Telpon / WA</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="text" class="form-control" maxlength="13" placeholder="Misal : 081988776655" name="no_telp" id="noTelpInput" oninput="restrictToNumber(event)" required />
              <div class="invalid-feedback ml-2">No Telpon harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Email</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <input type="email" class="form-control" maxlength="50" placeholder="Misal : almultazam@gmail.com" name="email" required />
              <div class="invalid-feedback ml-2">Email harus diisi!</div>
              <div class="valid-feedback ml-2">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label"> Upload Foto</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <span>Max(2Mb), Tipe File : PNG, JPG, JPEG.</span>
              <input type="file" class="form-control" id="foto" name="foto" required />
              <div id="foto-feedback" class="text-danger"></div>
              <div class="invalid-feedback">Silahkan Upload Foto!</div>
              <div class="valid-feedback">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
              <label class="col-form-label">Upload SKL/SKHUN</label>
            </div>
            <div class="col-xxl-10 col-lg-12">
              <span>Max(2Mb), Tipe File : PNG, JPG, JPEG.</span>
              <input type="file" class="form-control" id="skl" name="skl" required />
              <div id="skl-feedback" class="text-danger"></div>
              <div class="invalid-feedback">Silahkan Upload SKL/SKHUN!</div>
              <div class="valid-feedback">Ok!</div>
            </div>
          </div>

          <div class="form-group row mt-2 mb-2">
            <div class="col-sm-2">
            </div>
            <div class="col-xxl-10 col-lg-12">
              <button class="btn btn-primary" type="submit" name="submit">Registrasi</button>
            </div>
          </div>
        </div>
      </div>
    </form>
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
              <a href="../smp/index.php" class="text-decoration-none"><p class="text-white">SMP Al-Multazam</p></a>
              <a href="../sma/index.php" class="text-decoration-none"><p class="text-white">SMA Al-Multazam</p></a>
              <a href="../smk/index.php" class="text-decoration-none"><p class="text-white">SMK Al-Multazam</p></a>
            </div>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4 mt-5">
          <h6 class="text-capitalize fw-bold fs-4">contact us</h6>
          <div class="footer-text mt-4">
            <div class="section-information d-flex m-0-auto mb-3 align-items-center">
              <div><i class="fas fa-envelope mr-3"></i> ponpesalmultazamtng@gmail.com</div>
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

  <!-- wilayah indonesia start -->
  <script>
    const apiUrl = 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
    const proxyUrl = 'proxy.php?url=' + encodeURIComponent(apiUrl);

    const selectProvinsi = document.getElementById("provinsi");
    const selectkabupaten_kota = document.getElementById("kabupaten_kota");
    const selectKecamatan = document.getElementById("kecamatan");
    const selectKelurahan = document.getElementById("kelurahan");

    // Mengambil data provinsi menggunakan fetch
    fetch(proxyUrl)
      .then((response) => response.json())
      .then((provinces) => {
        var data = provinces;
        var tampung = '<option value="">--Pilih Provinsi--</option>';
        data.forEach((element) => {
          tampung += `<option value="${element.name}" data-id="${element.id}">${element.name}</option>`;
        });
        selectProvinsi.innerHTML = tampung;
      });

    // Menggunakan event listener untuk mengambil data kabupaten/kota, kecamatan, dan kelurahan
    selectProvinsi.addEventListener("change", () => {
      const selectedOption = selectProvinsi.options[selectProvinsi.selectedIndex];
      const selectedProvinsiName = selectedOption.value;
      const selectedProvinsiId = selectedOption.getAttribute("data-id");

      if (selectedProvinsiId !== "") {
        const kabupatenUrl = `http://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`;
        fetch(proxyUrl + '&url=' + encodeURIComponent(kabupatenUrl))
          .then((response) => response.json())
          .then((regencies) => {
            var data = regencies;
            var tampung = '<option value="">--Pilih Kabupaten/Kota--</option>';
            data.forEach((element) => {
              tampung += `<option value="${element.name}" data-id="${element.id}">${element.name}</option>`;
            });
            selectkabupaten_kota.innerHTML = tampung;
          });
      } else {
        selectkabupaten_kota.innerHTML = '<option value="">--Pilih Kabupaten/Kota--</option>';
        selectKecamatan.innerHTML = '<option value="">--Pilih Kecamatan--</option>';
        selectKelurahan.innerHTML = '<option value="">--Pilih Kelurahan--</option>';
      }
    });

    selectkabupaten_kota.addEventListener("change", () => {
      const selectedOption = selectkabupaten_kota.options[selectkabupaten_kota.selectedIndex];
      const selectedKabupatenName = selectedOption.value;
      const selectedKabupatenId = selectedOption.getAttribute("data-id");

      if (selectedKabupatenId !== "") {
        const kecamatanUrl = `http://www.emsifa.com/api-wilayah-indonesia/api/districts/${selectedKabupatenId}.json`;
        fetch(proxyUrl + '&url=' + encodeURIComponent(kecamatanUrl))
          .then((response) => response.json())
          .then((districts) => {
            var data = districts;
            var tampung = '<option value="">--Pilih Kecamatan--</option>';
            data.forEach((element) => {
              tampung += `<option value="${element.name}" data-id="${element.id}">${element.name}</option>`;
            });
            selectKecamatan.innerHTML = tampung;
          });
      } else {
        selectKecamatan.innerHTML = '<option value="">--Pilih Kecamatan--</option>';
        selectKelurahan.innerHTML = '<option value="">--Pilih Kelurahan--</option>';
      }
    });

    selectKecamatan.addEventListener("change", () => {
      const selectedOption = selectKecamatan.options[selectKecamatan.selectedIndex];
      const selectedKecamatanName = selectedOption.value;
      const selectedKecamatanId = selectedOption.getAttribute("data-id");

      if (selectedKecamatanId !== "") {
        const kelurahanUrl = `http://www.emsifa.com/api-wilayah-indonesia/api/villages/${selectedKecamatanId}.json`;
        fetch(proxyUrl + '&url=' + encodeURIComponent(kelurahanUrl))
          .then((response) => response.json())
          .then((villages) => {
            var data = villages;
            var tampung = '<option value="">--Pilih Kelurahan--</option>';
            data.forEach((element) => {
              tampung += `<option value="${element.name}" data-id="${element.id}">${element.name}</option>`;
            });
            selectKelurahan.innerHTML = tampung;
          });
      } else {
        selectKelurahan.innerHTML = '<option value="">--Pilih Kelurahan--</option>';
      }
    });
  </script>
  <!-- wilayah indonesia end -->

  <!-- validation start -->
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>
  <!-- validation end -->

  <?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  require '../mail/vendor/autoload.php';

  include './inc/koneksi.php';

  function encryptFileName($fileName)
  {
    $hashedName = hash('sha3-256', $fileName . uniqid());
    return $hashedName;
  }

  function encryptFileSKL($fileName)
  {
    $hashedName = hash('sha3-256', $fileName . uniqid());
    return $hashedName;
  }

  if (isset($_POST['submit'])) {
    $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $CheckExist = "SELECT * FROM datappdb_smk_ppalmultazam WHERE nisn = '$nisn'";
    $resultCheckExist = $koneksi->query($CheckExist);

    if ($resultCheckExist->num_rows > 0) {
      echo "
        <script>
          Swal.fire({
            title: 'Pendaftaran Gagal',
            text : 'Maaf, Anda sudah terdaftar dalam database.',
            icon : 'error',
            confirmButtonText : 'Ok',
          });
        </script>";
    } else {
      $queryKapasitas = "SELECT kuota FROM kapasitas WHERE status = 'open'";
      $resultKapasitas = $koneksi->query($queryKapasitas);
      $rowKapasitas = mysqli_fetch_assoc($resultKapasitas);
      $kuota = $rowKapasitas['kuota'];

      // Hitung jumlah pendaftar yang sudah terdaftar
      $queryJumlahPendaftar = "SELECT COUNT(*) as jumlah_pendaftar FROM datappdb_smk_ppalmultazam";
      $resultJumlahPendaftar = $koneksi->query($queryJumlahPendaftar);
      $rowJumlahPendaftar = $resultJumlahPendaftar->fetch_assoc();
      $jumlahPendaftar = $rowJumlahPendaftar['jumlah_pendaftar'];

      if ($jumlahPendaftar >= $kuota) {
        // Tampilkan pesan bahwa pendaftaran sudah penuh
        echo "
        <script>
          Swal.fire({
            title: 'Pendaftaran Penuh',
            text: 'Maaf, pendaftaran sudah penuh.',
            icon: 'warning',
            confirmButtonText: 'Ok',
          });
        </script>";
      } else {
        $nama_gelombang     = mysqli_real_escape_string($koneksi, $_POST['nama_gelombang']);
        $nomor_pendaftaran  = mysqli_real_escape_string($koneksi, $_POST['nomor_pendaftaran']);
        $jenjang            = mysqli_real_escape_string($koneksi, $_POST['jenjang']);
        $jurusan            = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
        $nama_lengkap       = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
        $nik                = mysqli_real_escape_string($koneksi, $_POST['nik']);
        $long_nik           = strlen($nik);
        $long_middle        = $long_nik - 8; // Mengambil 4 karakter pertama dan 4 karakter terakhir
        $nik_middle         = substr_replace($nik, '***', 4, $long_middle);

        $jenis_kelamin      = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $tempat_lahir       = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
        $tgl_lahir          = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
        $sort_date          = date("d-m-Y", strtotime($tgl_lahir));
        $asal_sekolah       = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
        $asal_sekolah       = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);

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

        $fotoName       = $_FILES['foto']['name'];
        $fotoTmp        = $_FILES['foto']['tmp_name'];
        $fotoType       = $_FILES['foto']['type'];
        $fotoSize       = $_FILES['foto']['size'];

        $sklName        = $_FILES['skl']['name'];
        $sklTmp         = $_FILES['skl']['tmp_name'];
        $sklType        = $_FILES['skl']['type'];
        $sklSize        = $_FILES['skl']['size'];

        $allowedTypes = array('image/png', 'image/jpeg', 'image/jpg');
        $maxFileSize = 2097152; // 2MB dalam bytes

        if (in_array($fotoType, $allowedTypes) && $fotoSize <= $maxFileSize && in_array($sklType, $allowedTypes) && $sklSize <= $maxFileSize) {

          $newfotoName = encryptFileName($fotoName); //encrypt namefile with sha-3
          $newSKLName  = encryptFileSKL($sklName); //encrypt namefile with sha-3

          $tgl_daftar = date('Y-m-d');
          $status_pendaftaran = "Belum Diverifikasi";
         $query = "INSERT INTO datappdb_smk_ppalmultazam (tgl_daftar,    nama_gelombang,    nomor_pendaftaran,    jenjang,     jurusan,  nama_lengkap,    nik,    jenis_kelamin,    tempat_lahir,    tgl_lahir,    asal_sekolah,    nisn,    agama,     tinggi_badan,   berat_badan,   jml_sdr_kandung,    nama_ayah,    thn_lahir_ayah,    pekerjaan_ayah,    penghasilan_ayah,    pendidikan_ayah,   nama_ibu,     thn_lahir_ibu,    pekerjaan_ibu,    penghasilan_ibu,    pendidikan_ibu,  alamat_rumah,    rt,    rw,      kode_pos,    provinsi,    kabupaten_kota,    kecamatan,    kelurahan,    no_telp,    email,    foto,           skl,           status_pendaftaran)
                                                  VALUES ('$tgl_daftar', '$nama_gelombang', '$nomor_pendaftaran', '$jenjang', '$jurusan', '$nama_lengkap', '$nik', '$jenis_kelamin', '$tempat_lahir', '$tgl_lahir', '$asal_sekolah', '$nisn', '$agama', '$tinggi_badan', $berat_badan, '$jml_sdr_kandung', '$nama_ayah', '$thn_lahir_ayah', '$pekerjaan_ayah', '$penghasilan_ayah', '$pendidikan_ayah', '$nama_ibu', '$thn_lahir_ibu', '$pekerjaan_ibu', '$penghasilan_ibu', '$pendidikan_ibu', '$alamat_rumah', '$rt', '$rw', '$kode_pos', '$provinsi', '$kabupaten_kota', '$kecamatan', '$kelurahan', '$no_telp', '$email', '$newfotoName', '$newSKLName', '$status_pendaftaran')";

          if ($koneksi->query($query) === TRUE) {
            $uploadPath = "./uploads/Pasfoto/" . $newfotoName;
            move_uploaded_file($fotoTmp, $uploadPath);

            $uploadPath = "./uploads/SKL/" . $newSKLName;
            move_uploaded_file($sklTmp, $uploadPath);

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
            }).then(function(){
              window.location = 'form_penerimaan.php';
            });
          </script>";


          $status_url = "https://ivando.my.id/smk/form_penerimaan";

        $mail = new PHPMailer(true);

        try {
          $mail->SMTPDebug = 0;
          // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
          $mail->isSMTP(); //Send using SMTP
    
          $mail->Host = 'smtp.gmail.com';
          $mail->Port = '587'; //Set the SMTP server to send through
          $mail->SMTPAuth   = true; //Enable SMTP authentication
          $mail->Username   = 'registerppalmultazamsepatan@gmail.com'; //SMTP username
          $mail->Password   = 'elhawwfnlipsbjsq '; //SMTP password
          $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
   
          //Recipients
          $mail->setFrom('registerppalmultazamsepatan@gmail.com', 'Registrasi PPDB Pondok Pesantren Al-Multalzam');
          $mail->addAddress($email, $nama_lengkap); //Add a recipient
          $mail->addAddress($email); //Name is optional
    
          //Content
          $mail->isHTML(true); //Set email format to HTML
          $mail->Subject = 'Registrasi Anda Berhasil!';
          $mail->Body = 
              '
                <table style="width: 100%; background-color: #1c2331; padding: 20px; border-radius: 10px;">
                    <tr>
                        <td>
                            <img src="https://ivando.my.id/assets/images/logo/Al-Multazam_Logo.png" alt="Logo Perusahaan" width="80">
                        </td>
                        <td>
                            <h1>Al-Multazam</h1>
                        </td>
                        <tr>
                            <td colspan="3">
                                <hr style="border: 1px solid #ffffff;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h1>Selamat, Registrasi Anda Berhasil!</h1>
                                <p>Yth Sdr <strong>'.$nama_lengkap.'</strong></p>
                                <p>Kami ucapkan  terima kasih atas kepercayaan Sdr '.$nama_lengkap.' untuk mendaftarkan diri pada Pondok Pesantren Al-Multazam Sepatan</p>
                                <p>Sehubungan dengan hal tersebut dan sebagai bukti pendaftaran yang sudah Sdr '.$nama_lengkap.' isi sebelumnya : </p>
                                <p>ID Daftar               : '.$nomor_pendaftaran.'</p>
                                <p>Jenjang Pendidikan      : '.$jenjang.'</p>
                                <p>Nama Calon Siswa/Siswi  : '.$nama_lengkap.'</p>
                                <p>NIK                     : '.$nik_middle.'</p>
                                <p>Jenis Kelamin           : '.$jenis_kelamin.'</p>
                                <p>Tempat Lahir            : '.$tempat_lahir.'</p>
                                <p>Tanggal Lahir           : '.$sort_date.'</p>
                                <p>Asal Sekolah            : '.$asal_sekolah.'</p>
                                <p>Nisn                    : '.$nisn.'</p>
                                <p>No Telpon/WA            : '.$no_telp.'</p>
                                <p>Email                   : '.$email.'</p>
                                <p></p>
                                <p>Registrasi Anda Telah Tersimpan Dalam Database Kami.</p>
                                <p>*Bagi Sdr '.$nama_lengkap.' yang sudah mendaftar dan harap segera melakukan pembayaran secara langsung ke Pondok Pesantren Al-Multazam Sepatan sebagai salah satu syarat untuk pendaftaran dan Penerimaan, terimakasih.</p>
                                <p>Anda dapat melihat status pendaftaran Anda <a href="'.$status_url.'">di sini</a>.</p>
                            </td>
                        </tr>
                    </tr>
                </table>
              ';
          $mail->send();
            echo 'Message has been sent';
        } 
        catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


          } else {
            echo "
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
          </script>" . $query . "<br>" . $koneksi->error;
          }
        } else {
          echo "
      <script>
        Swal.fire({
            title: 'Gagal',   
            text: 'File terlalu besar atau jenis file tidak valid. Harap upload gambar PNG, JPEG, atau JPG dengan ukuran maksimal 2MB.',
            icon: 'error',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
        });
      </script>";
        }
      }
    }
  }
  ?>
  <script>
    history.replaceState({}, document.title, 'registrasi.php');
  </script>

</body>

</html>