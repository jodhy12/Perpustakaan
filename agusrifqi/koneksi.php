<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "perpustakaan";
//membuat koneksi database
$conn = mysqli_connect($host, $user, $pass, $db);
//cek koneksi database
if (!$conn) {
    die("Koneksi Database Gagal:" . mysqli_connect_error());
}
//echo "Koneksi Database Sukses";
//mysqli_close($conn);

// $sql1 = "SELECT * FROM buku JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang LIMIT 5";
// $result = $conn->query($sql1);
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         echo "Buku : " . $row["judul"] . "<br>" . "Nama Pengarang : " . $row["nama_pengarang"] . "<br>" . "<br>";
//     }
// } else {
//     echo "0 Results";
// }
// $sql2 = "SELECT * FROM anggota WHERE alamat LIKE '%bandung%' LIMIT 5";
// $result2 = $conn->query($sql2);
// if ($result2->num_rows > 0) {
//     while ($row2 = $result2->fetch_assoc()) {
//         echo "Nama Anggota : " . $row2["nama"] . "<br>" . "Alamat : " . $row2["alamat"] . "<br>" . "<br>";
//     }
// } else {
//     echo "0 Results";
// }
// $conn->close();
