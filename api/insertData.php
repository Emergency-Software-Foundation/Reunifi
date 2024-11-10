<?php

	$req = json_decode(file_get_contents('php://input'), true);

	$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
	if ($conn->connect_error) {
		$res = array("response" => "500", "msg" => "Failed to connect to DB");
		die(json_encode($res));
	}

	$caseId = "";
	if (!isset($req["caseId"])) {
		$sql = "INSERT INTO cases () VALUES ()";
		if ($conn->query($sql) === TRUE) {
			$caseId = $conn->insert_id;
		} else {
			$res = array("response" => "500", "msg" => "Failed to create new case");
			die(json_encode($res));
		}
	} else {
		$caseId = $req["caseId"];
	}
	
	if (!isset($req["names"])) {
		foreach ($req["names"] as $x) {
			$sql = "INSERT INTO cases.names (caseId,fname,mname,lname,suffix) VALUES (".$caseId.",".$x["fname"].",".$x["mname"].",".$x["lname"].",".$x["suffix"].")";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to insert case data: ".json_encode($req["names"]));
				die(json_encode($res));
			}
		}
	}
	
	if (!isset($req["dob"])) {
		foreach ($req["dob"] as $x) {
			$sql = "INSERT INTO cases.dob (caseId,month,day,year) VALUES (".$caseId.",".$x["month"].",".$x["day"].",".$x["year"].")";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to insert case data: ".json_encode($req["dob"]));
				die(json_encode($res));
			}
		}
	}
	
	if (!isset($req["addresses"])) {
		foreach ($req["addresses"] as $x) {
			$sql = "INSERT INTO cases.lka (caseId,street1,street2,city,state,zip,notes) VALUES (".$caseId.",".$x["street1"].",".$x["street2"].",".$x["city"].",".$x["state"].",".$x["zipcode"].",".$x["notes"].")";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to insert case data: ".json_encode($req["addresses"]));
				die(json_encode($res));
			}
		}
	}
	
	if (!isset($req["emails"])) {
		foreach ($req["emails"] as $x) {
			$sql = "INSERT INTO cases.emails (caseId,email) VALUES (".$caseId.",".$x["email"].")";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to insert case data: ".json_encode($req["emails"]));
				die(json_encode($res));
			}
		}
	}
	
	if (!isset($req["phones"])) {
		foreach ($req["phones"] as $x) {
			$sql = "INSERT INTO cases.phones (caseId,country,area,prefix,line) VALUES (".$caseId.",".$x["country"].",".$x["area"].",".$x["prefix"].",".$x["line"].")";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to insert case data: ".json_encode($req["phones"]));
				die(json_encode($res));
			}
		}
	}
	
	if (!isset($req["found"])) {
		foreach ($req["found"] as $x) {
			$sql = "INSERT INTO cases.found (caseId,location,timefound,foundby) VALUES (".$caseId.",".$x["location"].",NOW(),".$x["foundby"].")";
			if (!($conn->query($sql) === TRUE)) {
				$res = array("response" => "500", "msg" => "Failed to insert case data: ".json_encode($req["phones"]));
				die(json_encode($res));
			}
		}
	}

	$conn->close();
	
	$res = array("response" => "200", "msg" => "Modified Case #".$caseId);
	echo (json_encode($res));
?>