<html>

<head>
    <title>Add Penerbit</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
include_once("../connect.php");
$penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
?>

<body>
    <a class="button" href="penerbit.php">Go to Penerbit</a>
    <br /><br />

    <form action="addPenerbit.php" method="post" name="form1">
        <table width="30%" border="0">
            <tr>
                <td>
                    <label>ID Penerbit</label>
                    <input type="text" name="id_penerbit">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Nama</label>
                    <input type="text" name="nama_penerbit">
                </td>
            </tr>
            <tr>
                <td>
                    <label>E-Mail</label>
                    <input type="text" name="email">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Telp</label>
                    <input type="text" name="telp">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Alamat</label>
                    <input type="text" name="alamat">
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

        $result = mysqli_query($mysqli, "insert into penerbit
                                        (id_penerbit, nama_penerbit, email, telp, alamat)
                                        values
                                        ('$id_penerbit', '$nama_penerbit', '$email', '$telp', '$alamat');");

        header("Location:penerbit.php");
    }
    ?>
</body>

</html>