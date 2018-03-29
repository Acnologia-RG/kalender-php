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

<!doctype html>
<html>
	<head>
		<title>Verjaardagskalender</title>
		<link href="main.css" rel="stylesheet" type="text/css">
		<meta charset="utf-8">
	</head>
	<body>
	<?php
	$sql = "SELECT * FROM `birthdays` WHERE id='".$_GET['id']."'";
	$row = $conn->query($sql)->fetch_assoc();
	if ($_POST==TRUE) {
		$sql = "UPDATE `birthdays` SET `person`='".$_POST["name"]."',`day`='".$_POST["day"]."',`month`='".$_POST["month"]."',`year`='".$_POST["year"]."' WHERE id='".$_GET['id']."'";

		if ($conn->query($sql) === TRUE) {
		echo "<p>record updated successfully</p>";
		} else {
		echo "<p>Error: ".$sql."<br>".$conn->error."</p>";
		}
	} else {
		echo "<form action='edit.php?id=".$row["id"]."' method='post'>
		<p>name</p><input type='text' required='' name='name' value='".$row["person"]."' min='3'><br>
		<p>day</p><input type='number' required='' name='day' max='31' min='1' value='".$row["day"]."'><br>
		<p>month</p><input type='number' required='' name='month' max='12' min='1' value='".$row["month"]."'><br>
		<p>year</p><input type='number' required='' name='year' value='".$row["year"]."'><br>
		<input type='submit'>
		<br>";
	} 
	?>
		<a href="kalender.php">back to the calendar</a>
	</form>
	</body>
</html>