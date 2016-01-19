<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="mmi";
	$conn = mysqli_connect($servername, $username, $password, $db);

	if (mysqli_connect_errno())
	{
		die("Connection to database failed. ".mysqli_connect_error()."(".mysqli_connect_errno.")");
	}
?>