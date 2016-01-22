<?php
	session_start();
	require_once("db_connection.php");
	require_once("functions.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Forgot Password!</title>
<meta http-equiv="content-type" content="text/html" accept-charset="utf-8" />

<link rel="stylesheet" type="text/css" href="style.css" />

</head>
<script>
function def()
{
 window.location.assign("index.php?err_msg=TIMEOUT");
}
function abc(ofe)
{
	var xhr=new XMLHttpRequest();
	setTimeout(def,600000);
	xhr.onreadystatechange=function()
	{
		if(xhr.readyState==4&&xhr.status==200)
		{
			var res=xhr.responseText;
			var  parser, xmlDoc;
			parser = new DOMParser();
			xmlDoc = parser.parseFromString(res,"text/xml");
			var ab=xmlDoc.getElementsByTagName("SMSMessage");
			var xyz=" ";
				Body=xmlDoc.getElementsByTagName("Body")[0].childNodes[0].nodeValue;
				To=xmlDoc.getElementsByTagName("To")[0].childNodes[0].nodeValue;
				if(Body.length==4)
				{
					var xyz="<center><form action='verify.php' method=post>Enter OTP within 10 minutes :<input type=text name=otp><br><input type=hidden name=orig value="+Body+"><input type=hidden name=phoneno value="+To+"><input type=submit value='submit'></form></center>";
				}
				document.getElementById("demo").innerHTML=xyz;
		}
	};
			
					document.getElementById("gen").remove();
  	xhr.open("POST","return.php", true);
  	xhr.send(new FormData(ofe));
	return false;
}
</script>

<body>
	<?php include_once("top_bar.php");
		$to=$_POST["To"];
	
	?>
	<center><form id="gen"  method="post" onclick="return abc(this)">
		<input type="hidden" name="From" value="Admin"/>
		<input type="hidden" name="To" value="<?php echo $to;?>">
		<input type="hidden" name="otp" value=1>
		<input type="Submit" value="Generate OTP">
	</form></center>
	<p id="demo"></p>
		
	
</body>
</html>
