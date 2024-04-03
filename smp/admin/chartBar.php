<?php
// inisialisasi session

if (!isset($_SESSION['username'])) {
    header('Location: ../errors/error-403.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
    <div id="chart"></div>

    <?php
    include '../inc/koneksi.php';

    // Periksa koneksi
    if (!$koneksi) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }

    // Ambil data dari database untuk chart optionsProfileVisit
    $query = "SELECT tgl_daftar, COUNT(*) as jumlah_pendaftar FROM datappdb_smp_ppalmultazam GROUP BY tgl_daftar"; // Gantilah 'data_profile_visit' dengan nama tabel Anda
    $result = mysqli_query($koneksi, $query);

    // Inisialisasi array untuk data chart
    $tglDaftar = [];
    $jumlahPendaftar = [];

    // Loop untuk mengisi array data
    while ($row = mysqli_fetch_assoc($result)) {
        $tglDaftar[] = date("d-m-Y", strtotime($row['tgl_daftar']));
        $jumlahPendaftar[] = $row['jumlah_pendaftar'];
    }

    mysqli_close($koneksi);
    ?>

    <script>
        var optionsProfileVisit = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled: false
            },
            chart: {
                type: 'bar',
                height: 300
            },
            fill: {
                opacity: 1
            },
            plotOptions: {},
            series: [{
                name: 'pendaftar',
                data: <?php echo json_encode($jumlahPendaftar); ?>,
            }],
            colors: '#435ebe',
            xaxis: {
                categories: <?php echo json_encode($tglDaftar); ?>, // Label pada sumbu X
            }
        };

        var chartProfileVisit = new ApexCharts(document.querySelector("#chart"), optionsProfileVisit);
        chartProfileVisit.render();
    </script>
</body>

</html>