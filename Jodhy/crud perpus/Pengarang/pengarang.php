<?php
include_once("../connect.php");
$pengarang = mysqli_query($mysqli, "select * from pengarang");
?>

<html>

<head>
    <title>Pengarang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<body>

    <center>
        <a href="../index.php">Buku</a> |
        <a href="../Penerbit/penerbit.php">Penerbit</a> |
        <a href="pengarang.php">Pengarang</a> |
        <a href="../Katalog/katalog.php">Katalog</a>
        <hr>
    </center>

    <a href="addPengarang.php">Add Pengarang</a><br /><br />

    <table class="table" width='80%' border=1>

        <tr>
            <th>Id Pengarang</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telpon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($dataPengarang = $pengarang->fetch_array()) {
            echo "<tr>";
            echo "<td>" . $dataPengarang['id_pengarang'] . "</td>";
            echo "<td>" . $dataPengarang['nama_pengarang'] . "</td>";
            echo "<td>" . $dataPengarang['email'] . "</td>";
            echo "<td>" . $dataPengarang['telp'] . "</td>";
            echo "<td>" . $dataPengarang['alamat'] . "</td>";
            echo "<td><a class='btn btn-primary' href='editPengarang.php?id=$dataPengarang[id_pengarang]'>Edit</a> | <a class='btn btn-danger' href='deletePengarang.php?id=$dataPengarang[id_pengarang]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>