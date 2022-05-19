<?php

include_once('../connect.php');

$id_penerbit = $_GET['id'];

$result = mysqli_query($mysqli, "Delete from penerbit where id_penerbit = '$id_penerbit'");

header('Location: penerbit.php');
