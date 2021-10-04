<?php
    // Memanggil file connection php
    include_once("connect.php");
    // Query untuk memanggil data dari tabel buku lalu di join ke tabel pengarang, peneribit, dan katalog dan Quernya disimpan kedalam variabel buku
    $buku = mysqli_query($mysqli, "SELECT buku.*, nama_pengarang, nama_penerbit, katalog.nama as nama_katalog FROM buku 
    LEFT JOIN  pengarang ON pengarang.id_pengarang = buku.id_pengarang
    LEFT JOIN  penerbit ON penerbit.id_penerbit = buku.id_penerbit
    LEFT JOIN  katalog ON katalog.id_katalog = buku.id_katalog
    ORDER BY judul ASC");

?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Homepage</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar">
            <img src="./assets/eduwork.png" alt="Eduwork">
            <h4 class="navbar__brand">Perpustakaan</h4>
            <ul class="navbar__menu">
                <li><a href="index.php">Buku</a></li>
                <li><a href="crud_pengarang/index.php">Pengarang</a></a></li>
                <li><a href="crud_penerbit/index.php">Penerbit</a></li>
                <li><a href="crud_katalog/index.php">Katalog</a></li>
            </ul>
    </nav>
        <a href="add.php" class="btn btn-primary m-2">Add New Buku</a><br/><br/>
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th scope="col">ISBN</th>
                    <th scope="col">judul</th>
                    <th scope="col">tahun</th>
                    <th scope="col">ID Penerbit</th>
                    <th scope="col">ID Pengarang</th>
                    <th scope="col">ID Katalog</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Harga Pinjam</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <!-- Untuk memanggil data tersebut kita gunakan lopping while -->
            <!-- Variabel buku d ambil dari query yang sudah kita deklarasinya di atas -->
            <?php
                while($row = mysqli_fetch_array($buku)) : ?>
                    <!-- lalu data-2 di dlam variabel buku kita panggil, untuk nama kolom disesuaikan sesuai dengan nama kolom d database seperti isbn, judul, tahun, nama_pengarang, nama_penerbit, nama_katalog, qty_stock, harga_pinjam -->
                <tbody>
                    <tr>
                        <td><?= $row['isbn'];?></td>
                        <td><?= $row['judul'];?></td>
                        <td><?= $row['tahun']; ?></td>    
                        <td><?= $row['id_penerbit']; ?></td>   
                        <td><?= $row['id_pengarang']; ?></td> 
                        <td><?= $row['id_katalog']; ?></td>
                        <td><?= $row['qty_stok'];  ?></td> 
                        <td><?= $row['harga_pinjam']; ?></td>      
                        <!-- untuk script edit dan delete setiap berpindah halaman kelamana edit/delete kita harus membawa primary key dalam tabel buku, karena primary key dalam tabel buku ini isbn jadi variabel yang di bawa ke variabel edit dan delete itu adalah kolom isbn -->
                        <!-- Jika kita lihat di url kalau variabel isbn itu udah ke bawa jadi kalau kita kehalaman edit/delete variabel isbn harus ada -->
                        <td>
                            <a class='btn btn-primary' href="edit.php?isbn=<?= $row['isbn']; ?>">Edit</a> | 
                            <a class='btn btn-danger' href="delete.php?isbn=<?= $row['isbn']; ?>" onclick="return confirm('yakin ingin menghapus data?')">Delete</a>
                        </td>
                    </tr>
                </tbody>
                <?php endwhile; ?>
        </table>
        <footer class="footer">
            <p class="footer__content">&copy; All Rights Reseverd</p>
        </footer>
    </body>
</html>