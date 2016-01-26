<?php
	session_start();
	require_once("db_connection.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Sending Msgs to Subscribers!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
#Msg
{
color:red;
padding:5px;
font-size:24px;
display:table-cell;
border:2;
}
</style>
</head>
<body>
	<?php include 'top_bar.php' ?>
		<center><a href="companies.php" id='comp'>Home</a>
		<a href="logout.php" id='comp'>LogOut</a></center>
	<?php
		$cid = $_POST['cid'];
		$catid = $_POST['catid'];
		$priority = $_POST['priority'];
		$msg=$_POST['msg'];
		//Select the receivers/end users
		$query="Select s.PhoneNo from Subscribers s where '$catid' = s.CatId and '$cid'= s.CompId and $priority>=s.Priority and currlim>0";
		$res1 = mysqli_query($conn,$query);
		$count=mysqli_num_rows($res1);
		if($count>0)
		{
			$query="select * from Company where CompId='$cid'";
			$res2=mysqli_query($conn,$query);
			$data2=mysqli_fetch_row($res2);
			$cname=$data2[1];
			$query="Select Name from SubCat where SubCat_id='$catid'";
			$res3=mysqli_query($conn,$query);
			$data3=mysqli_fetch_row($res3);
	?>
	<p id="demo"></p>
	<center>
	<div id="rem" style="font-size:20px">
		From :<span id="Msg"> <?php echo $cname;?></span><br/>
		Message :<span id="Msg"> <?php echo $msg;?></span><br/>
		Priority :<span id="Msg"><?php  if($priority=='0') echo "Low"; else if($priority=='1') echo "Moderate"; else echo"High";?></span>
		Receiver :<span id="Msg"> 
		<form id="msg_form"  method="post" onsubmit="return pushmsg(this)">
			<input type="hidden" name="From" id="From" value="<?php echo $cname;?>"></input><br/>
			<input type="hidden" name="scat" id="scat" value="<?php echo $data3[0]?>"></input><br/>
			<?php 
			//display the list of receivers
			for($i=0;$i<$count;$i++)
			{
				$data = mysqli_fetch_row($res1);
				echo $data[0]."<br/>";
			?>
			<input type="hidden" name="To[]" id="To[]" value="<?php echo($data[0])?>"> </input>
			<?php
			}?>
			<br>
			<input type="hidden" name="Body" id="Body" value="<?php echo($msg)?>"></input>
			<input id="sendMsgbutton" value="Send Message!" type="submit" />
		</form>
		</span>
	</div>
	</center>
	<?php } 
		echo "<center><span id='main_message'>No Subscribers!! :(</span></center>";
	?>
<script>
function pushmsg(ofe)
{
	//ajax code to send the data to return.php which sends to ends users through exotel api
	var xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function()
	{
		//response after submission of message
		if(xhr.readyState==4&&xhr.status==200)
		{
			var res=xhr.responseText;
			var  parser, xmlDoc;
			parser = new DOMParser();
			xmlDoc = parser.parseFromString(res,"text/xml");
			var abc=xmlDoc.getElementsByTagName("SMSMessage");
			var To,Status,Body,DC,n='';
			var disp="<style>table{border-color:red;color:blue;border-collapse:collapse;margin-left:10px;}th,td{padding:15px;}</style>";
			//If messages were sent!
			if(abc.length>0)
			{
				<?php
		$query="insert into Notification(CatId,Message,Priority,CompId,Time) values('$catid','$msg','$priority','$cid',now())";
		$res=mysqli_query($conn,$query);
	 $query="Update Subscribers set currlim=currlim-1 where '$catid' = CatId and '$cid'= CompId and $priority>=Priority and currlim>0"; mysqli_query($conn,$query);?> 
				disp+="<center><table border=1 ><tr><th>To</th><th>Date Created</th><th>Message</th><th>Status</th></tr>";
				//fetch the receivers and data from response 
				for(i=0;i<abc.length;i++)
				{
					To=xmlDoc.getElementsByTagName("To")[i].childNodes[0].nodeValue;
         				Body=xmlDoc.getElementsByTagName("Body")[i].childNodes[0].nodeValue;
	 				DC=xmlDoc.getElementsByTagName("DateCreated")[i].childNodes[0].nodeValue;
					Status=xmlDoc.getElementsByTagName("Status")[i].childNodes[0].nodeValue;
					disp+="<tr><td>"+To+"</td><td>"+DC+"</td><td>"+Body+"</td><td>"+Status+"</td></tr>";
				}
			}
			else
			{
				//Failure to send message
				disp+="<center><table border=1 ><tr><th>Message</th><th>Status</th></tr>";
				var abc=xmlDoc.getElementsByTagName("RestException");
				for(i=0;i<abc.length;i++)
				{
					Message=xmlDoc.getElementsByTagName("Message")[i].childNodes[0].nodeValue;
					Status=xmlDoc.getElementsByTagName("Status")[i].childNodes[0].nodeValue;
					disp+="<tr><td>"+Message+"</td><td>"+Status+"</td></tr>";
				}
			}
			disp+="</table></center>";
			document.getElementById("rem").remove();//remove the send message button form
			document.getElementById("demo").innerHTML=disp;
		}
	};
  	xhr.open("POST","return.php", true);
  	xhr.send(new FormData(ofe));
	return false;
}
</script>
</body>
</html>
