<?php
    include_once("../connect.php");
    // isbn yang kita panggil dari file sebelunya
    $id_katalog = $_GET['id_katalog'];

    $result = mysqli_query($mysqli, "DELETE FROM katalog WHERE id_katalog='$id_katalog'");
    // After Delet redirect to Home, so that latest user list will be displayed
    header("Location:index.php");
?>