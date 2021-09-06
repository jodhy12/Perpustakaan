<html>
<head>
	<title>Add Buku</title>
</head>

<?php
	include_once("connect.php");
    // untuk menambilkan data pada bagian select, karena tdak mungkin kita mengisi secara manual, jadi kita menggunakan select option agar mengurasi keslahan pada saat input pd database
    $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
    $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
    $katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
?>
 
<body>
	<a href="index.php">Go to Home</a>
	<br/><br/>
 
	<form action="add.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>ISBN</td>
				<td><input type="text" name="isbn"></td>
			</tr>
			<tr> 
				<td>Judul</td>
				<td><input type="text" name="judul"></td>
			</tr>
			<tr> 
				<td>Tahun</td>
				<td><input type="text" name="tahun"></td>
			</tr>
			<tr> 
				<td>Penerbit</td>
				<td>
					<select name="id_penerbit">
						<?php 
                        // Memanggil data penerbit sama seperti di index menggunakan looping while, jadi kita memanggil disini untuk select option dan juga set value, value berisi id dari masing_2 tabel
						    while($penerbit_data = mysqli_fetch_array($penerbit)) {         
						    	echo "<option value='".$penerbit_data['id_penerbit']."'>".$penerbit_data['nama_penerbit']."</option>";
						    }
						?>
					</select>
				</td>
			</tr>
			<tr> 
				<td>Pengarang</td>
				<td>
					<select name="id_pengarang">
						<?php 
						    while($pengarang_data = mysqli_fetch_array($pengarang)) {         
						    	echo "<option value='".$pengarang_data['id_pengarang']."'>".$pengarang_data['nama_pengarang']."</option>";
						    }
						?>
					</select>
				</td>
			</tr>
			<tr> 
				<td>Katalog</td>
				<td>
					<select name="id_katalog">
						<?php 
						    while($katalog_data = mysqli_fetch_array($katalog)) {         
						    	echo "<option value='".$katalog_data['id_katalog']."'>".$katalog_data['nama']."</option>";
						    }
						?>
					</select>
				</td>
			</tr>
			<tr> 
				<td>Qty Stok</td>
				<td><input type="text" name="qty_stok"></td>
			</tr>
			<tr> 
				<td>Harga Pinjam</td>
				<td><input type="text" name="harga_pinjam"></td>
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
			$isbn = $_POST['isbn'];
			$judul = $_POST['judul'];
			$tahun = $_POST['tahun'];
			$id_penerbit = $_POST['id_penerbit'];
			$id_pengarang = $_POST['id_pengarang'];
			$id_katalog = $_POST['id_katalog'];
			$qty_stok = $_POST['qty_stok'];
			$harga_pinjam = $_POST['harga_pinjam'];
			
			include_once("connect.php");
            // Script Insert, ketika script insert di jalankan 
			$result = mysqli_query($mysqli, "INSERT INTO `buku` (`isbn`, `judul`, `tahun`, `id_penerbit`, `id_pengarang`, `id_katalog`, `qty_stok`, `harga_pinjam`) VALUES ('$isbn', '$judul', '$tahun', '$id_penerbit', '$id_pengarang', '$id_katalog', '$qty_stok', '$harga_pinjam');");
			// Script yang ini fungsinya untuk auto redarice ke halaman index.php/Halaman Utama
			header("Location:index.php");
		}
	?>
</body>
</html>