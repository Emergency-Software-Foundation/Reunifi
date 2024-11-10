<?php
	header('Content-Type: application/json');

	include("../db.php");

	$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
	if ($conn->connect_error) {
		$data = array("response" => "500", "msg" => "Failed to connect to DB");
		die(json_encode($data));
	}
	if (isset($_GET["cid"])) {
		$sql = "SELECT * FROM cases WHERE CID = '".$_GET["cid"]."';";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			//this is a valid case!
			//let's start proccessing it
			$data = array("response" => "200", "msg" => "", "CID" => $_GET["cid"], "names" => array(), "addresses" => array(), "dob" => array(), "phones" => array(), "emails" => array(), "found" => array());
			$sql = "SELECT * FROM cases_names WHERE caseID = ".$_GET["cid"].";";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$data["names"][] = array("fname" => $row["fname"],"mname" => $row["mname"],"lname" => $row["lname"],"suffix" => $row["suffix"]);
				}
			}
			$sql = "SELECT * FROM cases_dob WHERE caseId = ".$_GET["cid"].";";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$data["dob"][] = array("month" => $row["month"],"day" => $row["day"],"year" => $row["year"]);
				}
			}
			$sql = "SELECT * FROM cases_lka WHERE caseId = ".$_GET["cid"].";";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$data["addresses"][] = array("street1" => $row["street1"],"street2" => $row["street2"],"city" => $row["city"],"state" => $row["state"],"zipcode" => $row["zip"],"notes" => $row["notes"]);
				}
			}
			$sql = "SELECT * FROM cases_emails WHERE caseId = ".$_GET["cid"].";";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$data["emails"][] = array("email" => $row["email"]);
				}
			}
			$sql = "SELECT * FROM cases_phones WHERE caseId = ".$_GET["cid"].";";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$data["phones"][] = array("country" => $row["country"],"area" => $row["area"],"prefix" => $row["prefix"],"line" => $row["line"]);
				}
			}
			$sql = "SELECT * FROM cases_found WHERE caseId = ".$_GET["cid"].";";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$data["found"][] = array("location" => $row["location"],"timefound" => $row["timefound"],"foundby" => $row["foundby"]);
				}
			}
			
			echo (json_encode($data));
		} else {
			$data = array("response" => "404", "msg" => "No case found with ID ".$_GET["cid"]);
			echo (json_encode($data));
		}
	} else {
		$data = array("response" => "400", "msg" => "No Case ID specified in request");
		echo (json_encode($data));
	}
	$conn->close();
?>