<?php 

include 'koneksi.php';

// $id=$_POST["idnews"];
$title=$_POST["judul"];
$content=$_POST["deskripsi"];
//get file
$namafile = $_FILES['url_image']['name'];
$tmp_name = $_FILES['url_image']['tmp_name'];


try {
	move_uploaded_file($tmp_name, 'archive/'.$namafile); // jika file ada, update dan upload img
	$statement = $database_connection->prepare("INSERT INTO `news_catalog` (`id`, `title`, `desc`, `img`) VALUES (NULL,?,?,?)");
	$statement->execute([$title, $content, 'archive/'.$namafile]);
	$pesan="Data berhasil ditambah!";
	echo $pesan;
} catch (PDOException $cek_koneksi) {
	die($cek_koneksi->getMessage());
}