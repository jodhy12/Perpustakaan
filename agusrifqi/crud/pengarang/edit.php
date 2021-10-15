<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengarang</title>
</head>
<?php
include_once('../../koneksi.php');
$id_pengarang = $_GET['id_pengarang'];
$pengarang = $conn->query("SELECT * FROM pengarang WHERE id_pengarang = '$id_pengarang'");

while ($pengarang_data = mysqli_fetch_array($pengarang)) {
    $id_pengarang = $pengarang_data['id_pengarang'];
    $nama_pengarang = $pengarang_data['nama_pengarang'];
    $email = $pengarang_data['email'];
    $telp = $pengarang_data['telp'];
    $alamat = $pengarang_data['alamat'];
}
?>

<body>
    <a href="index.php">Kembali Ke Beranda</a>
    <br /><br />
    <form action="edit.php?id_pengarang= <?php echo $id_pengarang; ?>" method="POST">
        <table width="25%" border="0">
            <tr>
                <td>Kode pengarang</td>
                <td><input type="text" name="id_pengarang" value="<?php echo $id_pengarang; ?>"></td>
            </tr>
            <tr>
                <td>Nama pengarang</td>
                <td><input type="text" name="nama_pengarang" value="<?php echo $nama_pengarang; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td><input type="text" name="telp" value="<?php echo $telp; ?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['update'])) {
        $id_pengarang = $_POST['id_pengarang'];
        $nama_pengarang = $_POST['nama_pengarang'];
        $email = $_POST['email'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        include_once("../../koneksi.php");

        $result = mysqli_query($conn, " UPDATE pengarang SET id_pengarang='$id_pengarang', nama_pengarang = '$nama_pengarang', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_pengarang = '$id_pengarang';");

        header("Location:index.php");
    }

    ?>
</body>

</html>