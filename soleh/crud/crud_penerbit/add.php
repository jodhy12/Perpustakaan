<html>
<head>
	<title>Add Penerbit</title>
</head>

<?php
	include_once("../connect.php");
    // untuk menambilkan data pada bagian select, karena tdak mungkin kita mengisi secara manual, jadi kita menggunakan select option agar mengurasi keslahan pada saat input pd database
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
?>
 
<body>
	<a href="index.php">Go to Home</a>
	<br/><br/>
 
	<form action="add.php" method="post" name="form1">
		<table width="30%" border="0">
			<tr> 
				<td>ID Penerbit</td>
				<td><input type="text" name="id_penerbit"></td>
			</tr>
			<tr> 
				<td>Nama Penerbit</td>
				<td><input type="text" name="nama_penerbit"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="email" name="email"></td>
			</tr>
            <tr> 
				<td>Telp</td>
				<td><input type="tel" name="telp"></td>
			</tr>
			<tr> 
				<td>Alamat</td>
				<td><textarea name="alamat" cols="30" rows="10"></textarea></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>
	
	<?php
    // Ketika kita sudah mengisi semua data dan klik tombol sumbit, lalu akan melakukan proses di bawah ini, ini adlaah proses untuk memasukan data yang di post sebelumnya kedalam database di dlam tabel buku 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {
            // ini merupakan variabel yang di panggil Post sebelumnya lalu di masukan kedalam values denga menggunakan script insert
			$id_penerbit = $_POST['id_penerbit'];
			$nama_penerbit = $_POST['nama_penerbit'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("../connect.php");
            // Script Insert, ketika script insert di jalankan 
			$result = mysqli_query($mysqli, "INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `email`, `telp`, `alamat`) VALUES ('$id_penerbit', '$nama_penerbit', '$email', '$telp', '$alamat');");
			// Script yang ini fungsinya untuk auto redarice ke halaman index.php/Halaman Utama
			header("Location:index.php");
		}
	?>
</body>
</html>