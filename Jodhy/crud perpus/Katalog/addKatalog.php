<html>

<head>
    <title>Add Katalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
include_once("../connect.php");
$katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
?>

<body>
    <a class="button" href="katalog.php">Go to katalog</a>
    <br /><br />

    <form action="addKatalog.php" method="post" name="form1">
        <table width="30%" border="0">
            <tr>
                <td>
                    <label>ID Katalog</label>
                    <input type="text" name="id_katalog">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Nama</label>
                    <input type="text" name="nama">
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
        $id_katalog = $_POST['id_katalog'];
        $nama = $_POST['nama'];

        $result = mysqli_query($mysqli, "insert into katalog
                                        (id_katalog, nama)
                                        values
                                        ('$id_katalog', '$nama');");

        header("Location:katalog.php");
    }
    ?>
</body>

</html>