<?php

use PhpParser\Node\Stmt\Echo_;

$host="localhost" ; $user="root" ; $pass="" ; $db="perpustakaan" ;
//membuat koneksi database
$conn=mysqli_connect( $host , $user , $pass, $db);
//cek koneksi database
if (!$conn) {
    die("Koneksi Database Gagal:".mysqli_connect_error());
} else {
    Echo "Koneksi Database Sukses";
}
?>