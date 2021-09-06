<html>
    <head>
        <title>Edit Pengarang</title>
    </head>
    <?php
        include_once("../connect.php");
        // Untuk menagbi isbn yang ada di url, untuk dapat bisa di tampilkan di 
        $id_pengarang = $_GET['id_pengarang'];
        // Lalu kita tinggal panggil buku, penerbit, pengarang, dan juga katalog,
        // untuk memanggil data bukunya, jadi kita cukup menanggil 1 row data yang mau di edit.
        $buku = mysqli_query($mysqli, "SELECT * FROM buku"); //menggunakan isbn yang kita panggil saja
        $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
        $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang WHERE id_pengarang='$id_pengarang'");
        $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
        
        while($row = mysqli_fetch_array($pengarang))
        {
            $id_pengarang = $row['id_pengarang'];
            $nama_pengarang = $row['nama_pengarang'];
            $email = $row['email'];
            $telp = $row['telp'];
            $alamat =$row['alamat'];
        }
    ?>
    <body>
        <a href="index.php">Go to Home</a>
        <br><br>
        <form action="edit.php?id_pengarang=<?php echo $id_pengarang; ?>" method="post">
            <table width="25%" border="0">
                <tr>
                    <td>ID Pengarang</td>
                    <td style="font-size: 11pt;"><?php echo $id_pengarang; ?> </td>
                </tr>
                <tr>
                    <td>Nama Pengarang</td>
                    <!-- karena setiap kita edit, data yang seblum nya kita input sudah ada, jadi valuenya kita simpan -->
                    <td><input type="text" name="nama_pengarang" value="<?php echo $nama_pengarang; ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td>No. Telp</td>
                    <td><input type="tel" name="telp" value="<?php echo $telp; ?>"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
                    <!-- <td><textarea name="alamat" value="<?php echo $alamat; ?>" cols="30" rows="10"></textarea></td> -->
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="update" value="Update"></td>
                </tr>
            </table>
        </form>
        <?php
            // Check if from submitted, insert form data into users table
            if(isset($_POST['update'])) {

                $id_pengarang = $_GET['id_pengarang'];
                $nama_pengarang = $_POST['nama_pengarang'];
                $email = $_POST['email'];
                $telp = $_POST['telp'];
                $alamat = $_POST['alamat'];
                
                include_once("../connect.php");
    
                $result = mysqli_query($mysqli, "UPDATE pengarang SET nama_pengarang = '$nama_pengarang', email = '$email', telp = 
                '$telp', alamat = 
                '$alamat' WHERE id_pengarang = '$id_pengarang';");
                
                header("Location:index.php");
            }
        ?>
    </body>
</html>