<?php 
$servername = "localhost";
	$username = "root";
	$password = "";
	$conn = mysql_connect($servername, $username,$password);
	mysql_set_charset('utf8',$conn);
	mysql_select_db('Mmi');
foreach($_GET['Company'] as $selected){
	//echo $selected."</br>";
	
	
	$scat=$_GET['scat'];
	if (!isset($_SESSION["user"]))
		session_start();
	$res1=mysql_query("Select Name from Company where CompId='$selected'");
	$data1=mysql_fetch_row($res1);
	$res2=mysql_query("Select Name from SubCat where SubCat_id='$scat'");
	$data2=mysql_fetch_row($res2);

	echo "Successfully subscribed to ".$data1[0]." for ".$data2[0]."!! :)";
	$pri = $_GET[$selected."priority"];
	$lim = $_GET[$selected."limit"];
	$u= $_SESSION["user"];
	$res = mysql_query("Insert into Subscribers values ('$u','$selected','$scat','$pri', '$lim', '$lim') ");
}
?>
