<?php
	session_start();
	require_once("db_connection.php");
	require_once("functions.php");
	if (isset($_SESSION["phoneno"]))
	{
		$phoneno = $_SESSION["phoneno"];
		$user = $_SESSION["user"];
	}
	else
	{
		redirect("index.php?error_msg=Plese%20Log%20In%20first.");
	}
	if(isset($_POST["Address"]))
	{
		if(($addr=$_POST["Address"])!="")
		{
			$query="Update Users Set Address='$addr' where PhoneNo='$phoneno'";
			if(!mysqli_query($conn,$query))
				$error_msg="Failed to update address";
		}
	}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Subscribe to a New Service!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style>


.Key
{
align:top;
color:red;
font:italic bold 24px  serif;;
}
.value
{
width:1px;
color:green;
font:bold 20px Arial;
}
</style>
</head>

<body>
	<!-- including the top bar -->
	<?php include 'top_bar.php'; ?>
	<ul class="top_nav">
		<li><a href="subscribed.php">Home</a></li>
		<li><a class="active" href="categories.php">New Services</a></li>
		<li><a href="feeds.php">Message Feeds</a></li>
		<li><a href="accounts.php">Accounts</a></li>
		<li><a class="last-link" href="logout.php">Logout!</a></li>
	</ul>
	<?php  
		
		$query="Select * from Users where PhoneNo=$phoneno";
		$res=mysqli_query($conn,$query);
		if(!$res)
		{
			echo "Please Try Again";
			exit;
		}
		$data=mysqli_fetch_row($res);
		if(isset($error_msg))
			echo $error_msg;
	?>
	<a href="forgot.php" id="comp">Change Password</a>
	<center>
	<form  method="post">
	<table border=1>
	<tr>
		<td class="Key">Name</td>
		<td class="value" colspan=3><?php echo $data[3];?></td>
	</tr>
	<tr>
		<td class="Key">PhoneNo</td>
		<td class="value" colspan=3><?php echo $data[0];?></td>
	</tr>
	<tr>
		<td class="Key">Date Of Birth</td>
		<td class="value" colspan=3><?php echo $data[4];?></td>
	</tr>
	<tr>
		<td class="Key">Email Id</td>
		<td class="value" colspan=3><?php echo $data[5];?></td>
	</tr>
	<tr>
		<td class="Key">Address</td>
		<td class="value"><?php echo $data[1];?></td>
		<td><textarea rows=6 cols=20 name="Address" value=""/></textarea></td>
		<td><input type="submit" value="Edit Address"/></td>
	</tr>
	</table>
		<br>
	</form>
	</center>
</body>
</html>
