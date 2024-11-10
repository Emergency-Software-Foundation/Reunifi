<?php

	header('Content-Type: application/json');

	include("../db.php");

	$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
	if ($conn->connect_error) {
		$res = array("response" => "500", "msg" => "Failed to connect to DB");
		die(json_encode($res));
	}
	
	if (isset($_GET["a"]) && isset($_GET["b"]) && $_GET["a"] != $_GET["b"]) {
		$avalid = false;
		$bvalid = false;
		$sql = "SELECT * FROM cases WHERE CID = '".$_GET["a"]."';";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$avalid = true;
		}
		$sql = "SELECT * FROM cases WHERE CID = '".$_GET["b"]."';";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$bvalid = true;
		}
		if ($avalid && $bvalid) {
			$sql = "UPDATE cases_names SET caseId = '".$_GET["a"]."' WHERE caseId = '".$_GET["b"]."'";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to merge Case #".$_GET["b"]." into Case #".$_GET["a"]);
				die(json_encode($res));
			}
			$sql = "UPDATE cases_dob SET caseId = '".$_GET["a"]."' WHERE caseId = '".$_GET["b"]."'";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to merge Case #".$_GET["b"]." into Case #".$_GET["a"]);
				die(json_encode($res));
			}
			$sql = "UPDATE cases_lka SET caseId = '".$_GET["a"]."' WHERE caseId = '".$_GET["b"]."'";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to merge Case #".$_GET["b"]." into Case #".$_GET["a"]);
				die(json_encode($res));
			}
			$sql = "UPDATE cases_phones SET caseId = '".$_GET["a"]."' WHERE caseId = '".$_GET["b"]."'";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to merge Case #".$_GET["b"]." into Case #".$_GET["a"]);
				die(json_encode($res));
			}
			$sql = "UPDATE cases_emails SET caseId = '".$_GET["a"]."' WHERE caseId = '".$_GET["b"]."'";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to merge Case #".$_GET["b"]." into Case #".$_GET["a"]);
				die(json_encode($res));
			}
			$sql = "UPDATE cases_found SET caseId = '".$_GET["a"]."' WHERE caseId = '".$_GET["b"]."'";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to merge Case #".$_GET["b"]." into Case #".$_GET["a"]);
				die(json_encode($res));
			}
			$sql = "UPDATE mycases SET caseId = '".$_GET["a"]."' WHERE caseId = '".$_GET["b"]."'";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to merge Case #".$_GET["b"]." into Case #".$_GET["a"]);
				die(json_encode($res));
			}
			$sql = "DELETE FROM cases WHERE CID = '".$_GET["b"]."'";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to merge Case #".$_GET["b"]." into Case #".$_GET["a"]);
				die(json_encode($res));
			}
		} else {
			$res = array("response" => "404", "msg" => "Case not found");
			die(json_encode($res));
		}
		$conn->close();
	
		$res = array("response" => "200", "msg" => "Merged Case #".$_GET["b"]." into Case #".$_GET["a"]);
		echo (json_encode($res));
	} else {
		$data = array("response" => "400", "msg" => "No Case IDs specified in request");
		echo (json_encode($data));
	}
?>