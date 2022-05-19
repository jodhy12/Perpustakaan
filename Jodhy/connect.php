<?php

$conn = mysqli_connect("localhost", "root", "admin", "perpus");

if (!$conn) {
    die("Conn Failed :  " . mysqli_connect_error());
}

$query = mysqli_query($conn, 'Select * from buku');
$rows = mysqli_query($conn, 'select * from anggota');

while ($row = $query->fetch_assoc()) {
    echo "Buku : {$row['isbn']}, {$row['judul']} <br>";
}

echo "<br>";

foreach ($rows as $row) {
    echo "Anggota: {$row['nama']}, {$row['sex']}, {$row['alamat']}, {$row['telp']} <br>";
}
