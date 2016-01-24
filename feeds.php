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
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Subscribe to a New Service!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
#scat
{
	background-color:#fffaf2;
	border: 2px solid #2196F3;
	width: 8%;
	color: orange;
	text-align:center;
}
#comp
{
	background-color: #ffe5e5;
	border: 2px solid #2196F3;
	color: red;
}
#time
{
	background-color:#ecffe5;
	border: 2px solid #2196F3;
	width: 50%;
	text-align: right;
	color: green;
}
#Message
{

	background-color:#ebf0fa;
	border: 2px solid #2196F3;
	text-align: left;
	color: black;
}
</style>
</head>

<body>
<?php
	include 'top_bar.php';
	?>
	<ul class="top_nav">
		<li><a href="subscribed.php">Home</a></li>
		<li><a href="categories.php">New Services</a></li>
		<li><a class="active" href="feeds.php">Message Feeds</a></li>
		<li><a href="accounts.php">Accounts</a></li>
		<li><a class="last-link" href="logout.php">Logout!</a></li>
	</ul>
<div id="heading">Your Message Feeds:</div>
<?php
	$query = "Select CompId, CatId, Time, Message from List where PhoneNo = $phoneno";
	$res = mysqli_query($conn, $query);
	($res ? $count = mysqli_num_rows($res): $count = 0);
	$i=0;
	for($i=0; $i < $count; $i++)
	{
		$data = mysqli_fetch_row($res);
		$query1 = "Select Name from Company where CompId='$data[0]'";
		$query2 = "Select Name from SubCat where SubCat_id='$data[1]'";
		$fetch1 = mysqli_query($conn, $query1);
		$fetch2 = mysqli_query($conn, $query2);
		$d1 = mysqli_fetch_row($fetch1);
		$d2 = mysqli_fetch_row($fetch2);
		echo "<table border=1 align='center' style='border-collapse:collapse;width:80%;'>";
		echo "<tr><td id='scat'>".$d2[0]."</td><td id='comp'> ".$d1[0]."</td><td id='time'> ".$data[2]."</td></tr><td colspan=3 id='Message'> ".$data[3]."</td></tr></table></br>";
	}
?>
</body>
</html>
