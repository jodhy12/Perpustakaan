<?php
include_once("../../koneksi.php");
$sqlkatalog = "SELECT * FROM katalog
ORDER BY id_katalog ASC";
$katalog = $conn->query($sqlkatalog);
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
        <a href="../buku/index.php">Buku</a> |
        <a href="../penerbit/index.php">Penerbit</a> |
        <a href="../pengarang/index.php">Pengarang</a> |
        <a href="index.php">Katalog</a>
        <hr>
    </center>
    <a href="tambah.php">Tambah Katalog</a><br /><br />

    <table class="table table-striped table-bordered" width='80%' border=1>

        <tr>
            <th>Kode Katalog</th>
            <th>Nama Katalog</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($katalog_data = mysqli_fetch_array($katalog)) {
            echo "<tr>";
            echo "<td>" . $katalog_data['id_katalog'] . "</td>";
            echo "<td>" . $katalog_data['nama'] . "</td>";
            echo "<td><a class='btn btn-primary' href='edit.php?id_katalog=$katalog_data[id_katalog]'>Edit</a> | <a class='btn btn-danger' href='hapus.php?id_katalog=$katalog_data[id_katalog]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>