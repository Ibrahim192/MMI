<!DOCTYPE html>
<html>
<head>
<title>Sending Msgs to Subscribers!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
</style>

<script type="text/javascript">
document.getElementById("sendMsgbutton").click();
function formAutoSubmit() {
	document.msg_form.submit();
}
</script>

</head>

<body onload="formAutoSubmit()">
	<?php include 'top_bar.php' ?>
<?php
	$cid = $_POST['cid'];
	$catid = $_POST['from'];
	$priority = $_POST['priority'];
	$msg=$_POST['msg'];
	$username = "root";
	$password = "";
	$servername = "localhost";
	$db="Mmi";
	$conn = mysqli_connect($servername, $username, $password,$db);
	$query="insert into Notification(CatId,Message,Priority,CompId,Time) values('$catid','$msg','$priority','$cid',now())";
	$res=mysqli_query($conn,$query);
	$query="Select s.PhoneNo from Subscribers s where '$catid' = s.CatId and '$cid'= s.CompId";
	$res1 = mysqli_query($conn,$query);
	
	$count=mysqli_num_rows($res1);
	$query="select * from Company where CompId='$cid'";
	$res2=mysqli_query($conn,$query);
	$data2=mysqli_fetch_row($res2);
	$cname=$data2[1];
?>
<form id="msg_form" action="https://~exotel_sid~:~exotel_token~@twilix.exotel.in/v1/Accounts/~exotel_sid~/Sms/send" method="post">
<input type="hidden" name="From" value="<?php echo $cname?>"></input><br/>
<?php 
for($i=0;$i<$count;$i++)
{
	$data = mysqli_fetch_row($res1);
	echo $data[0]."<br/>";
?>
<input type="hidden" name="To[]" value="<?php echo($data[0])?>"> </input>

<?php
}?>
<input type="hidden" name="Body" value="<?php echo $msg?>"></input>
<input id="sendMsgbutton" value="Send Message!" type="submit" />
</form>

</body>
</html>
