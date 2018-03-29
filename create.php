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
	if ($_POST==TRUE) {
	$sql = "INSERT INTO birthdays (person, day, month, year) VALUES 
	('".$_POST["name"]."','".$_POST["day"]."','".$_POST["month"]."','".$_POST["year"]."')";

	if ($conn->query($sql) == TRUE) {
	echo "<p>New record created successfully</p>";
	} else {
	echo "<p>Error: ".$sql."<br>".$conn->error."</p>";
	}
	}
	?>
	<form action="create.php" method="post">
		<p>name</p><input type="text" required="" name="name" min="2"><br>
		<p>day</p><input type="number" required="" name="day" max="31" min="1" value="1"><br>
		<p>month</p><input type="number" required="" name="month" max="12" min="1" value="1"><br>
		<p>year</p><input type="number" required="" name="year" value="1995"><br>
		<input type="submit">
		<br>
		<a href="kalender.php">back to the calendar</a>
	</form>
	</body>
</html>
