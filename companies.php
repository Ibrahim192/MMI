<!DOCTYPE html>
<html>
<head>
<title>Welcome!</title>
<style type="text/css">

body {
//background-color:#9CC3EC;
background-image: url('bg.jpg');
background-size: 1376px 768px;
font-family:sans-serif;
}



#Top
{
	width: 120%;
	height: 100px;
	margin: -10px;
	background-color: #000000;
	color: white;
}

#TopText
{
	padding-top:30px;
}

</style>
</head>

	<div id="Top">
		<div id="TopText"><span style="font-size: 35px; padding-left:430px; padding-top:200px;"><strong>WELCOME TO Mmi EXOTEL!</strong></span></div>
	</div>
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$conn = mysql_connect($servername, $username,$password);
	mysql_set_charset('utf8',$conn);
	mysql_select_db('Mmi');
	
	$res = mysql_query('select * from Company');
	$num = mysql_num_rows($res);
	?>
	<center>
	<br/><br/>
	Company Id: 
	<select onChange="window.location.href=this.value">
	<option value="">Select...</option>	
	<?php 
	for($i=0; $i<$num; $i++)
	{
		$data = mysql_fetch_row($res);
		?>
		<option style="width:40px;" name="<?php echo $data[0]?>" value="<?php  echo" companies.php?cid=".$data[0] ?>"> <?php echo $data[0]." : ".$data[1]?> </option>
	<?php } ?>
		
	</select>
	

<?php
if (isset($_GET['cid']))
{ 
	$cid = $_GET['cid'];
	?>
<form action="notify.php" method="POST">
	<input type="hidden" name = 'cid' value="<?php echo $cid; ?>" />
Sub cat:	 
<select name="from">
	<?php
		$res = mysql_query("select s.SubCat_id from SubCat s, Cat_Comp c where $cid = c.CompId and c.scat_id = s.SubCat_id");
		$count = mysql_num_rows($res);
		for($i=0; $i<$count; $i++)
		{
			$data = mysql_fetch_row($res);
			echo $data[0];
	?> 
	<option  name="<?php echo $data[0]?>" value = "<?php echo $data[0] ?>" > <?php echo $data[0] ?> </option>
	<?php } ?>
</select>
<br/>
<br/>
<textarea name="msg" maxlength=150></textarea>
	<br/>
Priority&nbsp;&nbsp;&nbsp;&nbsp;low <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=0 />&nbsp;&nbsp;&nbsp;&nbsp;medium <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=1 />&nbsp;&nbsp;&nbsp;&nbsp;high <input type="radio" name="<?php echo $rowd[1]."priority" ?>" value=2 />
<br/>
<input type="submit" value = "Send Message!" />
</form>

<?php } ?>


	</center>
	
</body>
</html>															
