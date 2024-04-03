<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location: ../errors/error-403.php');
    exit(); 
}
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <canvas id="pieChart"></canvas>

    <?php
    include '../inc/koneksi.php';

    // Ambil data dari database
    $query = "SELECT status_pendaftaran, COUNT(*) as jumlah FROM datappdb_sma_ppalmultazam GROUP BY status_pendaftaran";
    $result = mysqli_query($koneksi, $query);

    // Inisialisasi array untuk data chart
    $status_pendaftaran = [];
    $jumlah = [];

    // Loop untuk mengisi array data
    while ($row = mysqli_fetch_assoc($result)) {
        $status_pendaftaran[] = $row['status_pendaftaran'];
        $jumlah[] = $row['jumlah'];
    }

    mysqli_close($koneksi);
    ?>

    <script>
        var ctx = document.getElementById("pieChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($status_pendaftaran); ?>,
                datasets: [{
                    labels: 'Jumlah',
                    data: <?php echo json_encode($jumlah); ?>,
                    backgroundColor: [
                        '#F7E987',
                        '#3AA6B9',
                        '#D80032',
                    ],
                    borderColor: [
                        'white',
                        'white',
                        'white',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'left'
                }
            }
        });
    </script>

</body>

</html>