<html>
<head>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<title>Subscribe to a New Service!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
#heading {
	 font-size: 24px;
	 margin-top: 40px;
	 text-align: center;
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
	$conn = mysql_connect($servername, $username,$password);
	mysql_set_charset('utf8',$conn);
	mysql_select_db('Mmi');
	$r=mysql_query("Select CompId,CatId from Subscribers where PhoneNo='$su' order by CompId");
	$count=mysql_num_rows($r);
	$i=0;
	while($i<$count)
	{
		$data=mysql_fetch_row($r);
		$i=$i+1;
		$res=mysql_query("Select Time,Message from Notification where  CompId='$data[0]' and CatId='$data[1]'");
		$d2=mysql_fetch_row($res);
		if(!empty($d2))
		{
			$comp=mysql_query("Select Name from Company where CompId='$data[0]'");
			$d0=mysql_fetch_row($comp);
			$cat=mysql_query("Select Name from SubCat where SubCat_id='$data[1]'");
			$d1=mysql_fetch_array($cat);
			echo $d0[0]." ".$d1[0]." ".$d2[0]." ".$d2[1]."<br/>";
		}
	}
?>
</body>
</html>
