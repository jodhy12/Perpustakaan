<?php
    include_once("../connect.php");
    // isbn yang kita panggil dari file sebelunya
    $id_penerbit = $_GET['id_penerbit'];

    $result = mysqli_query($mysqli, "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'");
    // After Delet redirect to Home, so that latest user list will be displayed
    header("Location:index.php");
?>