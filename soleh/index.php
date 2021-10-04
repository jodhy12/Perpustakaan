<?php
$servername = "localhost";
$database = "perpustakaan";
$username = "root";
$password = "";

// Create Connestion DB
$conn = mysqli_connect($servername, $username, $password, $database);
// Check Connection
if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
}
// echo "connected successfully";
// mysqli_close($conn);
$sql = "SELECT anggota.id_anggota, anggota.nama FROM anggota LEFT JOIN peminjaman ON peminjaman.id_anggota = anggota.id_anggota WHERE peminjaman.id_anggota IS NULL";
// Query 2
$sql = "SELECT anggota.nama, anggota.id_anggota, anggota.telp FROM anggota RIGHT JOIN peminjaman ON peminjaman.id_anggota = anggota.id_anggota WHERE peminjaman.id_anggota IS NOT NU
LL";
$result = $conn->query($sql);
// Proses untuk menampilkan data
if($result->num_rows > 0){
    // Output daa of each row
    while($row = $result->fetch_assoc()){
        echo "Anggota yang belum pernah melakukan peminjaman : " . $row["id_anggota"]. " " .$row["nama"]. "<br><br>";
    }
}else {
    echo " 0 result";
}

if($result->num_rows > 0){
    // Output daa of each row
    while($row = $result->fetch_assoc()){
        echo "Anggota yang belum pernah melakukan peminjaman : " . $row["nama"]. " " .$row["id_anggota"]. " " .$row["telp"]. "<br><br>";
    }
}else {
    echo " 0 result";
}
$conn->close();
?>