<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Katalog</title>
</head>

<body>
    <a href="index.php">Kembali Ke Beranda</a>
    <br /><br />
    <form action="tambah.php" method="POST" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>Kode Katalog</td>
                <td><input type="text" name="id_katalog"></td>
            </tr>
            <tr>
                <td>Nama Katalog</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['Submit'])) {
        $id_katalog = $_POST['id_katalog'];
        $nama = $_POST['nama'];

        include_once("../../koneksi.php");

        $result = mysqli_query($conn, "INSERT INTO `katalog` (`id_katalog`, `nama`) VALUES ('$id_katalog', '$nama');");

        header("Location:index.php");
    }

    ?>
</body>

</html>