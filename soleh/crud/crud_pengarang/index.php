<?php
    // Memanggil file connection php
    include_once("../connect.php");
    // Query untuk memanggil data dari tabel buku lalu di join ke tabel pengarang, peneribit, dan katalog dan Quernya disimpan kedalam variabel buku
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
?>
<html>
    <head>
        <title>Homepage</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <center>
            <a href="index.php">Buku</a>
            <a href="../crud_pengarang/index.php">Pengarang</a>
            <a href="../crud_penerbit/index.php">Penerbit</a>
            <a href="#">Katalog</a>
        </center>
        <a href="add.php">Add New Buku</a><br/><br/>
        <table class="table" width="25%" border=1>
            <tr>
                <th>ID Pengarang</th>
                <th>Nama Pengarang</th>
                <th>Email</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <!-- Untuk memanggil data tersebut kita gunakan lopping while -->
            <!-- Variabel buku d ambil dari query yang sudah kita deklarasinya di atas -->
            <?php
                while($row = mysqli_fetch_array($pengarang)) {
                    // lalu data-2 di dlam variabel buku kita panggil, untuk nama kolom disesuaikan sesuai dengan nama kolom d database seperti isbn, judul, tahun, nama_pengarang, nama_penerbit, nama_katalog, qty_stock, harga_pinjam
                    echo "<tr>";
                    echo "<td>".$row['id_pengarang']."</td>";
                    echo "<td>".$row['nama_pengarang']."</td>";  
                    echo "<td>".$row['email']."</td>";    
                    echo "<td>".$row['telp']."</td>";    
                    echo "<td>".$row['alamat']."</td>";    
                    // untuk script edit dan delete setiap berpindah halaman kelamana edit/delete kita harus membawa primary key dalam tabel buku, karena primary key dalam tabel buku ini isbn jadi variabel yang di bawa ke variabel edit dan delete itu adalah kolom isbn
                    // Jika kita lihat di url kalau variabel isbn itu udah ke bawa jadi kalau kita kehalaman edit/delete variabel isbn harus ada
                    echo "<td><a class='btn btn-primary' href='edit.php?id_pengarang=$row[id_pengarang]'>Edit</a> | <a class='btn btn-danger' href='delete.php?id_pengarang=$row[id_pengarang]'>Delete</a></td></tr>";
                }
            ?>
        </table>
    </body>
</html>