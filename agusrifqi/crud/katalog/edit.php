<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Katalog</title>
</head>
<?php
include_once('../../koneksi.php');
$id_katalog = $_GET['id_katalog'];
$katalog = $conn->query("SELECT * FROM katalog WHERE id_katalog = '$id_katalog'");

while ($katalog_data = mysqli_fetch_array($katalog)) {
    $id_katalog = $katalog_data['id_katalog'];
    $nama_katalog = $katalog_data['nama'];
}
?>

<body>
    <a href="index.php">Kembali Ke Beranda</a>
    <br /><br />
    <form action="edit.php?id_katalog= <?php echo $id_katalog; ?>" method="POST">
        <table width="25%" border="0">
            <tr>
                <td>Kode Katalog</td>
                <td><input type="text" name="id_katalog" value="<?php echo $id_katalog; ?>"></td>
            </tr>
            <tr>
                <td>Nama Katalog</td>
                <td><input type="text" name="nama" value="<?php echo $nama_katalog; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_POST['update'])) {
        $id_katalog = $_POST['id_katalog'];
        $nama_katalog = $_POST['nama'];

        include_once("../../koneksi.php");

        $result = mysqli_query($conn, " UPDATE katalog SET id_katalog='$id_katalog', nama = '$nama_katalog' WHERE id_katalog = '$id_katalog';");

        header("Location:index.php");
    }

    ?>
</body>

</html>