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
</head>

<body>
	<?php include 'top_bar.php' ?>
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
	<span class='label-text'>Company Id:</span> 
	<select onChange="window.location.href=this.value">
	<option value="">Select</option>
	<?php 
	for($i=0; $i<$num; $i++)
	{
		$data = mysql_fetch_row($res);
		?>
		<option name="<?php echo $data[0]?>" value="<?php  echo "companies.php?cid=".$data[0] ?>"> <?php echo $data[0]." : ".$data[1]?> </option>
	<?php } ?>
		
	</select>
	
<?php
if (isset($_GET['cid']))
{ 
	$cid = $_GET['cid'];
	?>
<form action="notify.php" method="POST">
	<input type="hidden" name = 'cid' value="<?php echo $cid; ?>" />
<br/><br/>
<span class='label-text'>Sub Cat:</span> 	 
<select name="from" required >
<option value="">Select</option>
	<?php
		$res = mysql_query("select s.SubCat_id, s.name from SubCat s, Cat_Comp c where $cid = c.CompId and c.scat_id = s.SubCat_id");
		$count = mysql_num_rows($res);
		for($i=0; $i<$count; $i++)
		{
			$data = mysql_fetch_row($res);
			//echo $data[0];
	?> 
	<option  name="<?php echo $data[0]?>" value = "<?php echo $data[0] ?>" > <?php echo $data[0]." : ".$data[1] ?> </option>
	<?php } ?>
</select>
<br/>
<br/>
<br/>
<span class='label-text'>Please enter your message below: </span> <br/>
<textarea style="margin-top:5px;" name="msg" rows=7 cols=45 maxlength=150 placeholder="Type your message here" required></textarea>
	<br/><br/><br/>
<span class='label-text'>Select Priority:</span> &nbsp;&nbsp;&nbsp;&nbsp;<span class='label-text'>Low </span> <input type="radio" name="priority" value=0 required />
&nbsp;&nbsp;&nbsp;&nbsp; <span class='label-text'>Medium </span> <input type="radio" name="priority" value=1 />
&nbsp;&nbsp;&nbsp;&nbsp;<span class='label-text'>High</span> <input type="radio" name="priority" value=2 />
<br/><br/><br/>
<input style="padding:10px;" type="submit" value = "Send Message!" />
</form>

<?php } ?>


	</center>
	
</body>
</html>															
