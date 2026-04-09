<?php
require 'connect.php';

$a = new Connect();
$con = $a->db_connect();

$language_id =$_POST['language_id'];

$songs = array();

$sql = "SELECT song_master.id AS song_id,
		song_master.title,
		song_master.language_id,

		(SELECT lng.language_name
			FROM languages AS lng
			WHERE lng.id = song_master.language_id)
			AS language_name

		FROM song_master
		WHERE song_master.language_id = ".$language_id."
		ORDER BY song_master.title";

$result = $con->query($sql);


if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$songs[] = $row;
	}
}

echo "songs length : ".count($songs);
echo "songs data : ";

echo json_encode($songs);

// print_r($songs);

/*if (count($songs) > 0) {
	$a->getStatus("S", "", $songs);
} else {
	$a->getStatus("E", "No Data Available", $songs);
}*/

$con->close();
?>