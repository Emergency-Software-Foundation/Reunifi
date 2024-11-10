<?php
require('header.php');
topbar('Manage Clubs','./');
echo "<table>
	<tr>
		<th>UCID</th>
		<th>Name</th>
		<th>Type</th>
		<th>Category</th>
		<th>Status</th>
		<th>Options</th>
	</tr>";
$conn = new mysqli($db_server, $db_user, $db_password, $db_db);
if ($conn->connect_error) {
	die("DB ERROR!");
}
$sql = "SELECT * FROM clubs;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr>
			<td>".$row["UCID"]."</td>
			<td>".$row["Name"]."</td>
			<td>".$row["type"]."</td>
			<td>".$row["category"]."</td>
			<td>".$row["status"]."</td>
			<td></td>
		</tr>";
	}
} else {
	echo "No Clubs Found??";
}
$conn->close();
echo "</table>";
footer();
?>