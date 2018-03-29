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
		for ($Number = 1; $Number <13; $Number++ ){
		$sql = "SELECT  * FROM birthdays WHERE month = ".$Number." ORDER BY `birthdays`.`day`,`year` ASC";
		$result = $conn->query($sql);

		if ($result->num_rows === null) {
		} else {
			if ($result->num_rows > 0) {
			$month = array("januari","febuari","maart","april","mei","juni","juli","augustus","september","otktober","november","december");
			echo "<h1>".$month[$Number-1]."</h1>";

			$day = null;
			while($row = $result->fetch_assoc()) {
				if ($row["day"]!=$day) {
					echo "<h2>".$row["day"]."</h2>";
				}
				$day = $row["day"];
				echo "<p><a href='edit.php?id=".$row["id"]."'>".$row["person"]." (".$row["year"].")"."</a>
				<a href='delete.php?id=".$row["id"]."'>x</a></p>";
			}
		} else {
		}
		}
		}
	?>
	<p><a href='create.php'>+ Toevoegen</a></p>
	</body>
</html>