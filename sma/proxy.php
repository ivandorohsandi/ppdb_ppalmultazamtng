<?php
// Set header untuk mengatasi masalah CORS
header("Access-Control-Allow-Origin: *");

// Tangkap URL permintaan dari parameter GET
$url = isset($_GET['url']) ? $_GET['url'] : '';

if (empty($url)) {
    echo 'URL tidak valid.';
    exit();
}

// Inisialisasi cURL
$ch = curl_init($url);

// Konfigurasi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi permintaan cURL
$response = curl_exec($ch);

// Periksa apakah permintaan berhasil
if (curl_errno($ch)) {
    echo 'Gagal melakukan permintaan ke server eksternal: ' . curl_error($ch);
    exit();
}

// Tutup koneksi cURL
curl_close($ch);

// Kembalikan respons dari server eksternal
echo $response;
?>
