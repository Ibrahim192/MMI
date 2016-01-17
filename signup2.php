<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Signup to MMI Exotel!</title>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

	<?php include 'top_bar.php'; ?>
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="Mmi";
	$conn = mysqli_connect($servername, $username, $password, $db);
	$phoneno=strval($_POST['phoneno']);
	$phoneno=mysqli_real_escape_string($conn,$phoneno);
	$nam = $_POST['nam'];
	$nam=mysqli_real_escape_string($conn,$nam);
	$address = $_POST['address'];
	$address=mysqli_real_escape_string($conn,$address);
	$password = $_POST['password'];
	$password=mysqli_real_escape_string($conn,$password);
	$confirm_password = $_POST['confirm_password'];
	$confirm_password=mysqli_real_escape_string($conn,$confirm_password);
	
	if ($password != $confirm_password)
	{
		echo "<p id='heading'>Entered passwords don't match. Please try again.</p>";
	}
	else
	{
		$query = "Insert into users values ($phoneno, '$address', '$password', '$nam')";
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