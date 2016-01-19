<?php
	session_start();
	require_once("db_connection.php");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Signup to MMI Exotel!</title>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

	<?php include 'top_bar.php'; ?>
	<?php
	$phoneno=strval($_POST['phoneno']);
	$phoneno=mysqli_real_escape_string($conn,$phoneno);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	if ($password != $confirm_password)
	{
		echo "<p id='heading'>Entered passwords don't match. Please try again.</p>";
	}
	else
	{
		$pass = password_hash($password, PASSWORD_BCRYPT);
		$query = "Insert into users values ($phoneno, '$address', '$pass', '$name')";
		$res = mysqli_query($conn, $query);
		if (empty($res))
		{
			echo "<p id='heading'>Some problem occurred while registering user.<br/> Please try again.</p>";
		}
		else
		{
			echo "<p id='heading'>Congratulations! Your account has been created.<br/>Please click <a href='index.php'>here</a> to login.</p>";
		}
	}
?>
</body>
</html>