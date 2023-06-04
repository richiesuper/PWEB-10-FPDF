<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Aplikasi CRUD Plus Upload Gambar dengan PHP</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Data Siswa</h1>
	<div class="functions">
		<a href="form-simpan.php" id="tambah-data">Tambah Data</a>
		<a href="proses-gen-pdf.php" id="buat-pdf">Buat PDF</a><br><br>
	</div>
	<table border="1" width="100%">
		<tr>
			<th>Foto</th>
			<th>NIS</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Telepon</th>
			<th>Alamat</th>
			<th colspan="2">Aksi</th>
		</tr>
		<?php
		include "config.php";

		$sql = $pdo->prepare("SELECT * FROM siswa");
		$sql->execute();

		while ($data = $sql->fetch()) {
			echo "<tr>";
			echo "<td><img src='images/" . $data['foto'] . "' width='100' height='100'></td>";
			echo "<td>" . $data['nis'] . "</td>";
			echo "<td>" . $data['nama'] . "</td>";
			echo "<td>" . $data['jenis_kelamin'] . "</td>";
			echo "<td>" . $data['telp'] . "</td>";
			echo "<td>" . $data['alamat'] . "</td>";
			echo "<td><a href='form-ubah.php?id=" . $data['id'] . "'>Ubah</a></td>";
			echo "<td><a href='proses-hapus.php?id=" . $data['id'] . "'>Hapus</a></td>";
			echo "</tr>";
		}
		?>
	</table>
</body>
</html>
