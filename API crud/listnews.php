<?php 

include 'koneksi.php';

function url() {
	if (isset($_SERVER['HTTPS'])) {
		// code...
		$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	}else{
		$protocol = 'http';
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

$keyword=$_GET['key'];

$statement = $database_connection->prepare("SELECT * FROM `news_catalog` WHERE `title` LIKE ? ");
$statement->execute(["%$keyword%"]);
$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
	// code...
	$row["img"] = url()."/".$row["img"];
	$data[] = $row;
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);