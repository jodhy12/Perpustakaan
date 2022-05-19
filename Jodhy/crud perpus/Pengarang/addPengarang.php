<html>

<head>
    <title>Add Pengarang</title>
</head>

<?php
include_once("../connect.php");
$pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
?>

<body>
    <a href="pengarang.php">Go to pengarang</a>
    <br /><br />

    <form action="addPengarang.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr>
                <td>Id Pengarang</td>
                <td><input type="text" name="id_pengarang"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama_pengarang"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
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

        $result = mysqli_query($mysqli, "insert into pengarang
                                        (id_pengarang, nama_pengarang, email, telp, alamat)
                                        values
                                        ('$id_pengarang', '$nama_pengarang', '$email', '$telp', '$alamat');");

        header("Location:pengarang.php");
    }
    ?>
</body>

</html>