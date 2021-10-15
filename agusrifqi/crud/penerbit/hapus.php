<?php
include_once("../../koneksi.php");

$id_penerbit = $_GET['id_penerbit'];

$result = $conn->query("DELETE FROM penerbit WHERE id_penerbit ='$id_penerbit'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
