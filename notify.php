<!DOCTYPE html>
<html>
<head>
<title>Welcome!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />
<style type="text/css">

body {
//background-color:#9CC3EC;
background-image: url('bg.jpg');
background-size: 1376px 768px;
margin-left:10%;
margin-right:10%;
font-family:sans-serif;
}
#Top
{
	width: 100%;
	height: 100px;
	background-color: #000000;
	color: white;
}

#TopText
{
	padding-top:30px;
}

</style>
</head>

<body onload="fncAutoSubmitForm()">
	<div id="Top">
		<div id="TopText"><span style="font-size: 35px; padding-left:320px; padding-top:200px;"><strong>WELCOME TO MMI EXOTEL!</strong></span></div>
	</div>
<?php
	$cid = $_POST['cid'];
	$catid = $_POST['from'];
	//$pri = $_POST['pri'];
	$msg=$_POST['msg'];
	$username = "root";
	$password = "";
	$servername = "localhost";
	$conn = mysql_connect($servername, $username, $password);
		mysql_select_db('Mmi');

	$res1 = mysql_query("Select s.PhoneNo from Subscribers s where '$catid' = s.CatId and '$cid'= s.CompId");
	
	$count=mysql_num_rows($res1);
	$res2=mysql_query("select * from Company where CompId='$cid'");
	$data2=mysql_fetch_row($res2);
	$cname=$data2[1];
?>
<form name = "myform" action="https://~exotel_sid~:~exotel_token~@twilix.exotel.in/v1/Accounts/~exotel_sid~/Sms/send" method="post">
<input type="hidden" name="From" value="<?php echo $cname?>"></input>
<?php 
for($i=0;$i<$count;$i++)
{
?>

<?php 
$data = mysql_fetch_row($res1);
$num[]=$data[0];
?>
<input type="hidden" name="To[]" value="<?php echo($num[$i])?>"></input


<?php
}?>
<input type="hidden" name="Body" value="<?php echo $msg?>"></input>
<input type="submit" />
</form>

</body>
</html>															
