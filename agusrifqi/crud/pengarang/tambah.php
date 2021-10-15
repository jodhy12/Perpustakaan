<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah pengarang</title>
</head>

<body>
    <a href="index.php">Kembali Ke Beranda</a>
    <br /><br />
    <form action="tambah.php" method="POST" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>Kode pengarang</td>
                <td><input type="text" name="id_pengarang"></td>
            </tr>
            <tr>
                <td>Nama pengarang</td>
                <td><input type="text" name="nama_pengarang"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td><input type="text" name="telp"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <td></td>
            <td><input type="submit" name="Submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['Submit'])) {
        $id_pengarang = $_POST['id_pengarang'];
        $nama_pengarang = $_POST['nama_pengarang'];
        $email = $_POST['email'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        include_once("../../koneksi.php");

        $result = mysqli_query($conn, "INSERT INTO pengarang (id_pengarang, nama_pengarang, email, telp,alamat) VALUES ('$id_pengarang', '$nama_pengarang', '$email', '$telp', '$alamat');");

        header("Location:index.php");
    }

    ?>
</body>

</html>