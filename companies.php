<!DOCTYPE html>
<html>
<head>
<title>Send msg to Subscribers!</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
.label-text {
	font-size: 1.3em;
}
select {
	font-size: 1.2em;
}
</style>
<script type="text/javascript">
function abc(str)
{
	var xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function()
	{
		if(xhr.readyState==4&&xhr.status==200)
		{
			var res=xhr.responseText;
			document.getElementById("demo").innerHTML=res;
		}
	}
	xhr.open("GET","fetch.php?cid="+str,true);
	xhr.send();
}
</script>
</head>
<body>
	<?php include 'top_bar.php' ?>
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="Mmi";
	$conn = mysqli_connect($servername, $username,$password,$db);
	$query='select * from Company';
	$res = mysqli_query($conn,$query);
	$num = mysqli_num_rows($res);
	?>
	<center>
	<br/><br/>
	<span class='label-text'>Company Id:</span> 
	<select onChange="abc(this.value)">
		<option value="">Select</option>
		<?php 
		for($i=0; $i<$num; $i++)
		{
			$data = mysqli_fetch_row($res);
		?>
		<option name="<?php echo $data[0]?>" value="<?php  echo $data[0] ?>"> <?php echo $data[0]." : ".$data[1]?> </option>
		<?php } ?>
	</select>
	<p id="demo"></p>
	</center>
</body>
</html>

