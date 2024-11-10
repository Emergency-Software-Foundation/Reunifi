<?php
if (isset($_SESSION["loggedin"])) {
	die("<script>location.href = '.'</script>");
}
if (isset($_GET["error"]) && $_GET["error"] == "login") {
	echo "<strong>Error:</strong> Invalid Username/Password Combo. [ECode: Auth-HT401]";
} elseif (isset($_GET["error"]) && $_GET["error"] == "logout") {
	echo "<strong>Success:</strong> Successfully Logged Out.";
} elseif (isset($_GET["error"]) && $_GET["error"] == "pswrdcng") {
	echo "<strong>Success:</strong> Password Changed Successfully.";
} elseif (isset($_GET["error"]) && $_GET["error"] == "server") {
	echo "<strong>Error:</strong> A Server Error has Occured. [ECode: Auth-HT500]";
} elseif (isset($_GET["error"]) && $_GET["error"] == "notlogged") {
	echo "<strong>Error:</strong> Authentication required to access system. [ECode: Auth-HT403]";
}
?>

<h2>Login</h2>
<form method="post" action="">
	<label for="usrnm">Username:</label>
	<input required type="text" id="usrnm" name="usrnm" placeholder="Enter username">
	<label for="pswrd">Password:</label>
	<input required type="password" id="pswrd" name="pswrd" placeholder="Enter password">
	<button type="submit">Log In</button>
</form>

<?php
include("db.php");
session_start();
if (isset($_POST["usrnm"]) && isset($_POST["pswrd"])) {
	$user = $_POST["usrnm"];
	$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
	if ($conn->connect_error) {
		die("<script>location.href = '?error=server'</script>");
	}
	$sql = "SELECT * FROM auth where usrnm = '$user'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$pswrd = $row["pswrd"];
			$isAdmin = $row["iscaseworker"];
			$id = $row["seeker"];
		}
	} else {
		die("<script>location.href = '?error=login'</script>");
	}
	$conn->close();
	if (password_verify( $_POST["pswrd"] , $pswrd )) {
		$_SESSION["loggedin"] = true;
		$_SESSION["is_admin"] = $isAdmin;
		$_SESSION["uuid"] = $id;
		echo ("<script>location.href = '.'</script>");
	}else {
		die("<script>location.href = '?error=login'</script>");
	}
}
?>