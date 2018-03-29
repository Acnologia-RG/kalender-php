<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "calendar";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "<p>Connected successfully</p>";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Verjaardagskalender</title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php 
		$sql = "SELECT * FROM `birthdays` WHERE id='".$_GET['id']."'";
		$row = $conn->query($sql)->fetch_assoc();

		if ($_POST==true) {
			$sql = "DELETE FROM `birthdays` WHERE id='".$row["id"]."'";
			if ($conn->query($sql) === TRUE) {
			echo "<p>record deleted successfully</p>";
			} else {
			echo "<p>Error: ".$sql."<br>".$conn->error."</p>";
			}
		} else {
			echo "<h1> do you want to delete ".$row["person"]."? </h1>";
			echo "<form action='delete.php?id=".$row["id"]."' method='post'>";
			echo "<input type='submit' name='yes' value='yes'>";
			echo "</form>";
		} ?>
		<a href="kalender.php">back to the calendar</a>
	</body>
</html>