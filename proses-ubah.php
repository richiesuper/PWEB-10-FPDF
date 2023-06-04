<?php
include "config.php";

$id = $_GET['id'];

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

if (empty($foto)) {
	$sql = $pdo->prepare("UPDATE siswa SET nis = :nis, nama = :nama, jenis_kelamin = :jk, telp = :telp,
		alamat = :alamat WHERE id = :id");
	$sql->bindParam(":nis", $nis);
	$sql->bindParam(":nama", $nama);
	$sql->bindParam(":jk", $jenis_kelamin);
	$sql->bindParam(":telp", $telp);
	$sql->bindParam(":alamat", $alamat);
	$sql->bindParam(":id", $id);
	$sql->execute();

	if ($sql) {
		header("Location: index.php");
	} else {
		echo "Maaf, terjadi kesalahan saat mencoba untuk menyimpan data ke database";
		echo "<br><a href='form-ubah.php'>Kembali ke form</a>";
	}
} else {
	$fotobaru = date('dmYHis') . $foto;

	$path = "images/" . $fotobaru;

	if (move_uploaded_file($tmp, $path)) {
		$sql = $pdo->prepare("SELECT foto FROM siswa WHERE id = :id");
		$sql->bindParam(":id", $id);
		$sql->execute();
		$data = $sql->fetch();

		if (is_file("images/" . $data['foto'])) {
			unlink("images/" . $data['foto']);
		}

		$sql = $pdo->prepare("UPDATE siswa SET nis = :nis, nama = :nama, jenis_kelamin = :jk, telp = :telp, alamat = :alamat, foto = :foto
			WHERE id = :id");
		$sql->bindParam(":nis", $nis);
		$sql->bindParam(":nama", $nama);
		$sql->bindParam(":jk", $jenis_kelamin);
		$sql->bindParam(":telp", $telp);
		$sql->bindParam(":alamat", $alamat);
		$sql->bindParam(":foto", $fotobaru);
		$sql->bindParam(":id", $id);
		$sql->execute();

		if ($sql) {
			header("Location: index.php");
		} else {
			echo "Maaf, terjadi kesalahan saat mencoba untuk menyimpan data ke database";
			echo "<br><a href='form-ubah.php'>Kembali ke form</a>";
		}
	} else {
		echo "Maaf, gambar gagal untuk di-upload";
		echo "<br><a href='form-ubah.php'>Kembali ke form</a>";
	}
}