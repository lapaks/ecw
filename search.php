<?php
define('DB_USER', 'lapaks');
define('DB_PASSWORD', 'pattake');
define('DB_SERVER', 'localhost');
define('DB_NAME', 'lapaks');


if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
	die($db->connect_errno.' - '.$db->connect_error);
}

$arr = array();

if (!empty($_POST['keywords'])) {
	$keywords = $db->real_escape_string($_POST['keywords']);
	$sql = "SELECT ID, fname, address FROM phone_book WHERE fname LIKE '%".$keywords."%'";
	$result = $db->query($sql) or die($mysqli->error);
	if ($result->num_rows > 0) {
		while ($obj = $result->fetch_object()) {
			$arr[] = array('id' => $obj->ID,'fname' => $obj->fname, 'address' => $obj->address);
		}
	}
}
echo json_encode($arr);
?>