<?php
session_start();
	require_once("db_connection.php");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Change Password!</title>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

	<?php include 'top_bar.php';
$orig=$_POST["orig"];
$user=$_POST["otp"];
$phone=$_POST["phoneno"];
if(isset($_POST["redirect"]))
{
$password = $_POST['pass1'];
	$confirm_password = $_POST['pass2'];
	
	if ($password != $confirm_password)
	{
		echo "<p id='heading'>Entered passwords don't match. Please try again.</p>";
	}
	else
	{
		$pass = password_hash($password, PASSWORD_BCRYPT);
		$query = "Update Users set Password='$pass' where PhoneNo='$phone'";
		$res = mysqli_query($conn, $query);
		if (empty($res))
		{
			echo "<p id='heading'>Some problem occurred while changing password.<br/> Please try again.</p>";
		}
		else
		{
			echo "<p id='heading'>Congratulations! You have changed your password.<br/>Please click <a href='index.php'>here</a> to login.</p>";
		}
	}
}
else
{
if(strcmp($orig,$user)==0)
{
echo "<center><form action=verify.php method=post>";
echo"Enter Password : <input type=password name=pass1><br>Confirm Password : <input type=password name=pass2>";
echo "<input type=hidden name=redirect value=1>";
echo "<input type=hidden name=phoneno value='$phone'>";
echo "<input type=submit value=Change Password></form></center>";
}
else
echo "Invalid Otp!!";
}
?>
