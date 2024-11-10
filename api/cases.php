<?php
	header('Content-Type: application/json');

	include("db.php");

	$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
	if ($conn->connect_error) {
		$data = array("response" => "500", "msg" => "Failed to connect to DB");
		die(json_encode($data));
	}
	$data = array("response" => "200", "msg" => "", "CIDs" => array());
	if (isset($_GET["seeker"])) {
		$sql = "SELECT * FROM mycases WHERE seekerId = '".$_GET["seeker"]."';";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {		
			while($row = $result->fetch_assoc()) {
				$data["CIDs"][] = $row["caseId"];
			}
		}
	} else {
		$sql = "SELECT * FROM cases;";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {		
			while($row = $result->fetch_assoc()) {
				$data["CIDs"][] = $row["CID"];
			}		
		}
	}
	echo (json_encode($data));
	$conn->close();
?>