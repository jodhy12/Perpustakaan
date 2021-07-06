<?php
include_once("../../koneksi.php");
$sqlbuku = "SELECT buku.*, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog FROM buku 
LEFT JOIN  pengarang ON pengarang.id_pengarang = buku.id_pengarang
LEFT JOIN  penerbit ON penerbit.id_penerbit = buku.id_penerbit
LEFT JOIN  katalog ON katalog.id_katalog = buku.id_katalog
ORDER BY judul ASC";
$buku = $conn->query($sqlbuku);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</head>

<body>
    <center>
        <a href="index.php">Buku</a> |
        <a href="../penerbit/index.php">Penerbit</a> |
        <a href="../pengarang/index.php">Pengarang</a> |
        <a href="../katalog/index.php">Katalog</a>
        <hr>
    </center>
    <a href="tambah.php">Tambah Buku</a><br /><br />

    <table class="table table-striped table-bordered" width='80%' border=1>

        <tr>
            <th>ISBN</th>
            <th>Judul</th>
            <th>Tahun</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Katalog</th>
            <th>Stok</th>
            <th>Harga Pinjam</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($buku_data = mysqli_fetch_array($buku)) {
            echo "<tr>";
            echo "<td>" . $buku_data['isbn'] . "</td>";
            echo "<td>" . $buku_data['judul'] . "</td>";
            echo "<td>" . $buku_data['tahun'] . "</td>";
            echo "<td>" . $buku_data['nama_pengarang'] . "</td>";
            echo "<td>" . $buku_data['nama_penerbit'] . "</td>";
            echo "<td>" . $buku_data['nama_katalog'] . "</td>";
            echo "<td>" . $buku_data['qty_stok'] . "</td>";
            echo "<td>" . $buku_data['harga_pinjam'] . "</td>";
            echo "<td><a class='btn btn-primary' href='edit.php?isbn=$buku_data[isbn]'>Edit</a> | <a class='btn btn-danger' href='hapus.php?isbn=$buku_data[isbn]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>