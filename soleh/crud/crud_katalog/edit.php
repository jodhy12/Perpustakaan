<html>
    <head>
        <title>Edit Katalog</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <?php
        include_once("../connect.php");
        // Untuk menagbi isbn yang ada di url, untuk dapat bisa di tampilkan di 
        $id_katalog = $_GET['id_katalog'];
        // Lalu kita tinggal panggil buku, penerbit, pengarang, dan juga katalog,
        // untuk memanggil data bukunya, jadi kita cukup menanggil 1 row data yang mau di edit.
        $buku = mysqli_query($mysqli, "SELECT * FROM buku"); //menggunakan isbn yang kita panggil saja
        $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
        $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
        $katalog = mysqli_query($mysqli, "SELECT * FROM katalog WHERE id_katalog='$id_katalog'");
        
        while($row = mysqli_fetch_array($katalog))
        {
            $id_katalog = $row['id_katalog'];
            $nama = $row['nama'];
        }
    ?>
    <body>
        <a href="index.php" class="btn btn-primary m-1">Go to Home</a>
        <br><br>
        <form action="edit.php?id_katalog=<?php echo $id_katalog; ?>" method="post">
            <table width="25%" border="0" class="table table-striped table-dark">
                <tr>
                    <td scope="row">ID Katalog</td>
                    <td style="font-size: 11pt;"><?php echo $id_katalog; ?> </td>
                </tr>
                <tr>
                    <td scope="row">Nama</td>
                    <!-- karena setiap kita edit, data yang seblum nya kita input sudah ada, jadi valuenya kita simpan -->
                    <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
                </tr>
                <tr>
                    <td scope="row"></td>
                    <td><input type="submit" name="update" class="btn btn-primary" value="Update"></td>
                </tr>
            </table>
        </form>
        <?php
            // Check if from submitted, insert form data into users table
            if(isset($_POST['update'])) {

                $id_katalog = $_GET['id_katalog'];
                $nama = $_POST['nama'];
            
                include_once("../connect.php");
    
                $result = mysqli_query($mysqli, "UPDATE katalog SET nama = '$nama'
                WHERE id_katalog = '$id_katalog';");
                
                header("Location:index.php");
            }
        ?>
    </body>
</html>