<html>

<head>
    <title>Edit Katalog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
include_once("../connect.php");
$id_katalog = $_GET["id"];
$katalog = mysqli_query($mysqli, "SELECT * FROM katalog where id_katalog = '$id_katalog'");
foreach ($katalog as $value) {
    $nama = $value['nama'];
}
?>

<body>
    <a class="button" href="katalog.php">Go to Katalog</a>
    <br /><br />

    <form action="editKatalog.php?<?php echo "$id_katalog" ?>" method="post" name="form1">
        <table width="30%" border="0">
            <tr>
                <td>
                    <label>ID Katalog</label>
                    <input style="border: none;" type="text" name="id_katalog" value="<?php echo $id_katalog; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label>ID Katalog</label>
                    <input type="text" name="nama" value=" <?php echo $nama; ?>">
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

        $result = mysqli_query($mysqli, "update katalog 
                                set id_katalog = '$id_katalog',
                                    nama = '$nama'
                                    where id_katalog = '$id_katalog';");
        header("Location:katalog.php");
    }
    ?>
</body>

</html>