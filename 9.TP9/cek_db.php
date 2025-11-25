<?php
// File: cek_db.php
// Gunakan ini untuk memastikan Database ADA isinya dan KONEKSI berhasil.

$host = 'localhost';
$user = 'root';
$pass = ''; // Sesuaikan jika ada password
$db   = 'mvp_db';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h1>Status Koneksi: BERHASIL ✅</h1>";
    
    // Cek jumlah data di tabel pembalap
    $stmt = $conn->query("SELECT * FROM pembalap");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Jumlah Data di Tabel Pembalap: " . count($data) . "</h3>";
    
    if (count($data) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nama</th></tr>";
        foreach ($data as $row) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nama'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3 style='color:red'>Tabel Kosong! Jalankan Query INSERT dulu.</h3>";
    }

} catch(PDOException $e) {
    echo "<h1 style='color:red'>Koneksi GAGAL ❌</h1>";
    echo "Pesan Error: " . $e->getMessage();
}
?>