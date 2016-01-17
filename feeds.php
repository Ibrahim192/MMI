<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Subscribe to a New Service!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
table
{
table-layout:fixed;
color:red;
border-collapse:collapse;
border: 2px solid blue;
margin-left:40px;
margin-top:20px;
width:1200px;
}
td
{
word-wrap:break-word;
padding:15px;
}
#heading {
	 font-size: 24px;
	 margin-top: 20px;
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
	echo"<table border=2 width=10px>";
	echo "<tr><th>CompanyName</th><th>Category</th><th>Time</th><th>Message</th></tr>";
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
	echo "</table>";
?>
</body>
</html>
