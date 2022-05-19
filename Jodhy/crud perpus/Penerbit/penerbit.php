<?php
include_once("../connect.php");
$penerbit = mysqli_query($mysqli, "select * from penerbit");
?>

<html>

<head>
    <title>Penerbit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<body>

    <center>
        <a href="../index.php">Buku</a> |
        <a href="penerbit.php">Penerbit</a> |
        <a href="../Pengarang/pengarang.php">Pengarang</a> |
        <a href="../Katalog/katalog.php">Katalog</a>
        <hr>
    </center>

    <a href="addPenerbit.php">Add Penerbit</a><br /><br />

    <table class="table" width='80%' border=1>

        <tr>
            <th>Id Penerbit</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telpon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php
        while ($dataPenerbit = mysqli_fetch_array($penerbit)) {
            echo "<tr>";
            echo "<td>" . $dataPenerbit['id_penerbit'] . "</td>";
            echo "<td>" . $dataPenerbit['nama_penerbit'] . "</td>";
            echo "<td>" . $dataPenerbit['email'] . "</td>";
            echo "<td>" . $dataPenerbit['telp'] . "</td>";
            echo "<td>" . $dataPenerbit['alamat'] . "</td>";
            echo "<td><a class='btn btn-primary' href='editPenerbit.php?id=$dataPenerbit[id_penerbit]'>Edit</a> | <a class='btn btn-danger' href='deletePenerbit.php?id=$dataPenerbit[id_penerbit]'>Delete</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>