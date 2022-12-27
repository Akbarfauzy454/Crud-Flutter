<?php

include 'koneksi.php';

$id=$_POST["idnews"];
$title=$_POST["judul"];
$content=$_POST["deskripsi"];
//get file
$namafile = $_FILES['url_image']['name'];
$tmp_name = $_FILES['url_image']['tmp_name'];


try {
	//jika file null, img pada table di database tidak sah diupdate
	if ($_FILES['url_image']['size'] == null) {
		$statement= $database_connection->prepare("UPDATE `news_catalog` SET `title`=?, `desc`=?  WHERE `id`=? ");
		$statement->execute([$title,$content,$id]);
	}else{
		move_uploaded_file($tmp_name, 'archive/'.$namafile); // jika file ada, update dan upload img
		$statement=$database_connection->prepare("UPDATE `news_catalog` SET `title`=?, `desc`=?, `img`=?  WHERE `id`=? ");
		$statement->execute([$title,$content,'archive/'.$namafile,$id]);

	}
	
	$pesan="Data berhasil diedit";
	echo $pesan;
} catch (PDOException $cek_koneksi) {
	die($cek_koneksi->getMessage());
}