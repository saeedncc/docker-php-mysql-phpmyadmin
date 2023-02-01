<?php

$host = 'db';
$user = 'MYSQL_USER';
$pass = 'MYSQL_PASSWORD';
$db = 'MYSQL_DATABASE';

$conn = new mysqli($host, $user, $pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to MySQL server successfully!<br/>";


$sql = 'SELECT * FROM users';


if ($result = $conn->query($sql)) {
	while ($user = $result->fetch_object()) {
		echo "<br>";
		echo $user->username . " " . $user->password;
		echo "<br>";
	}
	
}



?>