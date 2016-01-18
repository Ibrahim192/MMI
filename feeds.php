<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Subscribe to a New Service!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
#scat
{
	margin: 8px 0px 16px 16px;
	background-color:#fffaf2;
	border: 2px solid #2196F3;
	padding:2%;
	width: 8%;
	float: left;
	color: orange;
	height:6%;
	text-align:center;
}
#comp
{
	margin: 8px 0px 0px 0px;
	padding:10px;
	background-color: #ffe5e5;
	border: 2px solid #2196F3;
	width: 20%;
	float: left;
	color: red;
	height:2.9%;
}
#time
{
	margin: 8px 0px 0px 0px;
		padding:10px;
	background-color:#ecffe5;
	border: 2px solid #2196F3;
	width: 50%;
	padding-right:2px;
	text-align: right;
	float: left;
	color: green;
	height:2.9%;
}
#Message
{
	margin: 0px 0px 16px 0px;
	background-color:#ebf0fa;
	padding-top:4px;
	padding-left:6px;
	border: 2px solid #2196F3;
	width: 72.3%;
	text-align: left;
	float: left;
	color: black;
	height:6.65%;
}
</style>
</head>

<body>
<?php
	include 'top_bar.php';
?>
<div id="heading">History</div>
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
	while($i<$cnt1)
	{
		$data=mysqli_fetch_row($r);
		$query1="Select Name from Company where CompId='$data[0]'";
		$query2="Select Name from SubCat where SubCat_id='$data[1]'";
		$fetch1=mysqli_query($conn,$query1);
		$fetch2=mysqli_query($conn,$query2);
		$d1=mysqli_fetch_row($fetch1);
		$d2=mysqli_fetch_row($fetch2);
		echo "<div><div id=scat>".$d2[0]."</div><div id=comp>".$d1[0]."</div><div id=time>".$data[2]."</div><div id=Message>".$data[3]."</div></div>";
		$i=$i+1;
		
	}
	echo "</table>";
?>
</body>
</html>
