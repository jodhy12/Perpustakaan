<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penerbit</title>
</head>
<?php
include_once('../../koneksi.php');
$id_penerbit = $_GET['id_penerbit'];
$penerbit = $conn->query("SELECT * FROM penerbit WHERE id_penerbit = '$id_penerbit'");

while ($penerbit_data = mysqli_fetch_array($penerbit)) {
    $id_penerbit = $penerbit_data['id_penerbit'];
    $nama_penerbit = $penerbit_data['nama_penerbit'];
    $email = $penerbit_data['email'];
    $telp = $penerbit_data['telp'];
    $alamat = $penerbit_data['alamat'];
}
?>

<body>
    <a href="index.php">Kembali Ke Beranda</a>
    <br /><br />
    <form action="edit.php?id_penerbit= <?php echo $id_penerbit; ?>" method="POST">
        <table width="25%" border="0">
            <tr>
                <td>Kode penerbit</td>
                <td><input type="text" name="id_penerbit" value="<?php echo $id_penerbit; ?>"></td>
            </tr>
            <tr>
                <td>Nama penerbit</td>
                <td><input type="text" name="nama_penerbit" value="<?php echo $nama_penerbit; ?>"></td>
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
        $id_penerbit = $_POST['id_penerbit'];
        $nama_penerbit = $_POST['nama_penerbit'];
        $email = $_POST['email'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        include_once("../../koneksi.php");

        $result = mysqli_query($conn, " UPDATE penerbit SET id_penerbit='$id_penerbit', nama_penerbit = '$nama_penerbit', email = '$email', telp = '$telp', alamat = '$alamat' WHERE id_penerbit = '$id_penerbit';");

        header("Location:index.php");
    }

    ?>
</body>

</html>