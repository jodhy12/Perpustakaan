<html>

<head>
    <title>Edit Penerbit</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
include_once("../connect.php");
$id_penerbit = $_GET["id"];
$penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit where id_penerbit = '$id_penerbit'");
foreach ($penerbit as $value) {
    $nama_penerbit = $value['nama_penerbit'];
    $email = $value['email'];
    $telp = $value['telp'];
    $alamat = $value['alamat'];
}
?>

<body>
    <a class="button" href="penerbit.php">Go to Penerbit</a>
    <br /><br />

    <form action="editPenerbit.php?<?php echo "$id_penerbit" ?>" method="post" name="form1">
        <table width="30%" border="0">
            <tr>
                <td>
                    <label>ID Penerbit</label>
                    <input style="border: none;" type="text" name="id_penerbit" value="<?php echo $id_penerbit; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Nama</label>
                    <input type="text" name="nama_penerbit" value="<?php echo $nama_penerbit; ?>">
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
        $id_penerbit = $_POST['id_penerbit'];
        $nama_penerbit = $_POST['nama_penerbit'];
        $email = $_POST['email'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        $result = mysqli_query($mysqli, "update penerbit 
                                set id_penerbit = '$id_penerbit',
                                    nama_penerbit = '$nama_penerbit',
                                    email = '$email',
                                    telp = '$telp',
                                    alamat = '$alamat'
                                    where id_penerbit = '$id_penerbit';");
        header("Location:penerbit.php");
    }
    ?>
</body>

</html>