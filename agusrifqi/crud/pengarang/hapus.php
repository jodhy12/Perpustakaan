<?php
include_once("../../koneksi.php");

$id_pengarang = $_GET['id_pengarang'];

$result = $conn->query("DELETE FROM pengarang WHERE id_pengarang ='$id_pengarang'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
