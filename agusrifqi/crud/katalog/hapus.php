<?php
include_once("../../koneksi.php");

$id_katalog = $_GET['id_katalog'];

$result = $conn->query("DELETE FROM katalog WHERE id_katalog ='$id_katalog'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php");
