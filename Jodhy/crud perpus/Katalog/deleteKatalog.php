<?php

include_once('../connect.php');

$id_katalog = $_GET['id'];

$result = mysqli_query($mysqli, "Delete from katalog where id_katalog = '$id_katalog'");

header('Location: katalog.php');
