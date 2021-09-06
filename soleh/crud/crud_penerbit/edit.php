<html>
    <head>
        <title>Edit Penerbit</title>
    </head>
    <?php
        include_once("../connect.php");
        // Untuk menagbi isbn yang ada di url, untuk dapat bisa di tampilkan di 
        $id_penerbit = $_GET['id_penerbit'];
        // Lalu kita tinggal panggil buku, penerbit, pengarang, dan juga katalog,
        // untuk memanggil data bukunya, jadi kita cukup menanggil 1 row data yang mau di edit.
        $buku = mysqli_query($mysqli, "SELECT * FROM buku"); //menggunakan isbn yang kita panggil saja
        $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit WHERE id_penerbit='$id_penerbit'");
        $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
        $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
        
        while($row = mysqli_fetch_array($penerbit))
        {
            $id_penerbit = $row['id_penerbit'];
            $nama_penerbit = $row['nama_penerbit'];
            $email = $row['email'];
            $telp = $row['telp'];
            $alamat =$row['alamat'];
        }
    ?>
    <body>
        <a href="index.php">Go to Home</a>
        <br><br>
        <form action="edit.php?id_penerbit=<?php echo $id_penerbit; ?>" method="post">
            <table width="25%" border="0">
                <tr>
                    <td>ID Penerbit</td>
                    <td style="font-size: 11pt;"><?php echo $id_penerbit; ?> </td>
                </tr>
                <tr>
                    <td>Nama Pengarang</td>
                    <!-- karena setiap kita edit, data yang seblum nya kita input sudah ada, jadi valuenya kita simpan -->
                    <td><input type="text" name="nama_penerbit" value="<?php echo $nama_penerbit; ?>"></td>
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

                $id_penerbit = $_GET['id_penerbit'];
                $nama_penerbit = $_POST['nama_penerbit'];
                $email = $_POST['email'];
                $telp = $_POST['telp'];
                $alamat = $_POST['alamat'];
                
                include_once("../connect.php");
    
                $result = mysqli_query($mysqli, "UPDATE penerbit SET nama_penerbit = '$nama_penerbit', 
                email = '$email', 
                telp = '$telp',
                alamat = '$alamat'
                WHERE id_penerbit = '$id_penerbit';");
                
                header("Location:index.php");
            }
        ?>
    </body>
</html>