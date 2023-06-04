<?php
include "config.php";

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT foto FROM siswa WHERE id = :id");
$sql->bindParam(":id", $id);
$sql->execute();

$data = $sql->fetch();

if (is_file("images/" . $data['foto'])) {
	echo "Fuck you<br>";
	unlink("images/" . $data['foto']);
}

$sql = $pdo->prepare("DELETE FROM siswa WHERE id = :id");
$sql->bindParam(":id", $id);
$res = $sql->execute();

if ($res) {
	header("Location: index.php");
} else {
	echo "Data gagal untuk dihapus. <a href='index.php'>Kembali</a>";
}