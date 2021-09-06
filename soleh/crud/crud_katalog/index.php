<?php
    // Memanggil file connection php
    include_once("../connect.php");
    // Query untuk memanggil data dari tabel buku lalu di join ke tabel pengarang, peneribit, dan katalog dan Quernya disimpan kedalam variabel buku
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
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
            <a href="../crud_katalog/index.php">Katalog</a>
        </center>
        <a href="add.php">Add New Katalog</a><br/><br/>
        <table class="table" width="80%" border=1>
            <tr align="center">
                <th>ID Katalog</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
            <!-- Untuk memanggil data tersebut kita gunakan lopping while -->
            <!-- Variabel buku d ambil dari query yang sudah kita deklarasinya di atas -->
            <?php
                while($row = mysqli_fetch_array($katalog)) {
                    // lalu data-2 di dlam variabel buku kita panggil, untuk nama kolom disesuaikan sesuai dengan nama kolom d database seperti isbn, judul, tahun, nama_pengarang, nama_penerbit, nama_katalog, qty_stock, harga_pinjam
                    echo "<tr>";
                    echo "<td>".$row['id_katalog']."</td>";
                    echo "<td>".$row['nama']."</td>";     
                    // untuk script edit dan delete setiap berpindah halaman kelamana edit/delete kita harus membawa primary key dalam tabel buku, karena primary key dalam tabel buku ini isbn jadi variabel yang di bawa ke variabel edit dan delete itu adalah kolom isbn
                    // Jika kita lihat di url kalau variabel isbn itu udah ke bawa jadi kalau kita kehalaman edit/delete variabel isbn harus ada
                    echo "
                    <td>
                    <a class='btn btn-primary' href='edit.php?id_katalog=$row[id_katalog]'>Edit</a> | 
                    <a class='btn btn-danger ' href='delete.php?id_katalog=$row[id_katalog]'>Delete</a>
                    </td>
                    </tr>";
                }
            ?>
        </table>
    </body>
</html>