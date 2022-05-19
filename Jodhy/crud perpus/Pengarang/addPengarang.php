<html>

<head>
    <title>Add Pengarang</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
include_once("../connect.php");
$pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
?>

<body>
    <a class="button" href="pengarang.php">Go to pengarang</a>
    <br /><br />

    <form action="addPengarang.php" method="post" name="form1">
        <table width="30%" border="0">
            <tr>
                <td>
                    <label>ID Pengarang</label>
                    <input type="text" name="id_pengarang">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Nama</label>
                    <input type="text" name="nama_pengarang">
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