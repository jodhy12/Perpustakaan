<html>

<head>
    <title>Edit Pengarang</title>
    <link rel="stylesheet" href="../css//style.css">
</head>

<?php
include_once("../connect.php");
$id_pengarang = $_GET["id"];
$pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang where id_pengarang = '$id_pengarang'");
foreach ($pengarang as $value) {
    $nama_pengarang = $value['nama_pengarang'];
    $email = $value['email'];
    $telp = $value['telp'];
    $alamat = $value['alamat'];
}
?>

<body>
    <a class="button" href="pengarang.php">Go to pengarang</a>
    <br /><br />

    <form action="editpengarang.php?<?php echo "$id_pengarang" ?>" method="post" name="form1">
        <table width="30%" border="0">
            <tr>
                <td>
                    <label>ID Pengarang</label>
                    <input style="border: none;" type="text" name="id_pengarang" value="<?php echo $id_pengarang; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Nama</label>
                    <input type="text" name="nama_pengarang" value="<?php echo $nama_pengarang; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>E-Mail</label>
                    <input type="text" name="email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Telp</label>
                    <input type="text" name="telp" value="<?php echo $telp; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="<?php echo $alamat; ?>">
                </td>
            </tr>
            <tr>
                <td><input class="button" type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php

    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $id_pengarang = $_POST['id_pengarang'];
        $nama_pengarang = $_POST['nama_pengarang'];
        $email = $_POST['email'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        $result = mysqli_query($mysqli, "update pengarang 
                                set id_pengarang = '$id_pengarang',
                                    nama_pengarang = '$nama_pengarang',
                                    email = '$email',
                                    telp = '$telp',
                                    alamat = '$alamat'
                                    where id_pengarang = '$id_pengarang';");
        header("Location:pengarang.php");
    }
    ?>
</body>

</html>