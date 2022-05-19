<?php

include_once('../connect.php');

$id_pengarang = $_GET['id'];

$result = mysqli_query($mysqli, "Delete from pengarang where id_pengarang = '$id_pengarang'");

header('Location: pengarang.php');
