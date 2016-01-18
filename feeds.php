<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Subscribe to a New Service!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
table
{
color:red;
border-collapse:collapse;
width:75%;
border: 2px solid blue;
margin-top:20px;
}
td, th
{
padding:15px;
}

#categories {
	clear: both;
	margin-top: 30px;
	border: 2px solid red;
	width: 96%;
	margin-left: 2%;
	height: 98%;
}
.menu
{
	border: 2px solid #2196F3;
	height: 86%;
	width: 15%;
	float: left;
	display: inline;
	margin: 1.5%;
	padding-left: 2%;
	padding-top:2%;
	text-align: left;
	font-size: 1.3em;
	font-weight: bold;
	color: #2196F3;
}
</style>
</head>

<body>
<?php
	include 'top_bar.php';
	?>
	<ul class="top_nav">
		<li><a href="subscribed.php">Home</a></li>
		<li><a href="categories.php">Subscribe to New Service</a></li>
		<li><a class="active" href="feeds.php">Message Feeds</a></li>
		<li><a class="last-link" href="logout.php">Logout!</a></li>
	</ul>
<div id="heading">Your Message Feeds:</div>
<?php
	session_start();
	if(!$_SESSION["user"])
		header("location:index.php");
	$su=$_SESSION["user"];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="Mmi";
	$conn = mysqli_connect($servername, $username,$password,$db);
	$query="Select CompId,CatId,Time,Message from List where PhoneNo='$su'";
	$r=mysqli_query($conn,$query);
	$cnt1=mysqli_num_rows($r);
	$i=0;
	?>
	<div id="categories">
		<div class="menu">
			<a href="categories.php">Subscribe</a><br/>
			<a href="#">Unsubscribe</a><br/>
		</div>
		<table border=2>
		<tr><th>CompanyName</th><th>Category</th><th>Time</th><th>Message</th></tr>
	<?php
	while($i<$cnt1)
	{
		$data=mysqli_fetch_row($r);
		$query1="Select Name from Company where CompId='$data[0]'";
		$query2="Select Name from SubCat where SubCat_id='$data[1]'";
		$fetch1=mysqli_query($conn,$query1);
		$fetch2=mysqli_query($conn,$query2);
		$d1=mysqli_fetch_row($fetch1);
		$d2=mysqli_fetch_row($fetch2);
		echo "<tr><td>".$d1[0]."</td><td>".$d2[0]."</td><td>".$data[2]."</td><td>".$data[3]."</td></tr>";
		$i=$i+1;
		
	}
?>
</body>
</html>
