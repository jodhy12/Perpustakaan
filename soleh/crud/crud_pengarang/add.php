<html>
<head>
	<title>Add Buku</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<?php
	include_once("../connect.php");
    // untuk menambilkan data pada bagian select, karena tdak mungkin kita mengisi secara manual, jadi kita menggunakan select option agar mengurasi keslahan pada saat input pd database
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
?>
 
<body>
	<a href="index.php" class="btn btn-primary m-1">Go to Home</a>
	<br/><br/>
 
	<form action="add.php" method="post" name="form1">
		<table width="30%" border="0" class="table table-striped">
			<tr> 
				<td scope="row">ID Pengarang</td>
				<td><input type="text" name="id_pengarang"></td>
			</tr>
			<tr> 
				<td scope="row">Nama Pengarang</td>
				<td><input type="text" name="nama_pengarang"></td>
			</tr>
			<tr> 
				<td scope="row">Email</td>
				<td><input type="email" name="email"></td>
			</tr>
            <tr> 
				<td scope="row">Telp</td>
				<td><input type="tel" name="telp"></td>
			</tr>
			<tr> 
				<td scope="row">Alamat</td>
				<td><textarea name="alamat" cols="30" rows="10"></textarea></td>
			</tr>
			<tr> 
				<td scope="row"></td>
				<td><input type="submit" name="Submit" class="btn btn-primary" value="Add"></td>
			</tr>
		</table>
	</form>
	
	<?php
    // Ketika kita sudah mengisi semua data dan klik tombol sumbit, lalu akan melakukan proses di bawah ini, ini adlaah proses untuk memasukan data yang di post sebelumnya kedalam database di dlam tabel buku 
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {
            // ini merupakan variabel yang di panggil Post sebelumnya lalu di masukan kedalam values denga menggunakan script insert
			$id_pengarang = $_POST['id_pengarang'];
			$nama_pengarang = $_POST['nama_pengarang'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			$alamat = $_POST['alamat'];
			
			include_once("../connect.php");
            // Script Insert, ketika script insert di jalankan 
			$result = mysqli_query($mysqli, "INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `email`, `telp`, `alamat`) VALUES ('$id_pengarang', '$nama_pengarang', '$email', '$telp', '$alamat');");
			// Script yang ini fungsinya untuk auto redarice ke halaman index.php/Halaman Utama
			header("Location:index.php");
		}
	?>
</body>
</html>