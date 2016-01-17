<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="Mmi";
	$conn = mysqli_connect($servername, $username,$password,$db);
	foreach($_GET['Company'] as $selected){
		$scat=$_GET['scat'];
		if (!isset($_SESSION["user"]))
			session_start();
		$query="Select Name from Company where CompId='$selected'";
		$res1=mysqli_query($conn,$query);
		$data1=mysqli_fetch_row($res1);
		$query="Select Name from SubCat where SubCat_id='$scat'";
		$res2=mysqli_query($conn,$query);
		$data2=mysqli_fetch_row($res2);

		echo "Successfully subscribed to <strong>".$data1[0]."</strong> for <strong>".$data2[0]."</strong>!! :)";
		$pri = $_GET[$selected."priority"];
		$lim = $_GET[$selected."limit"];
		$u= $_SESSION["user"];
		$query="Insert into Subscribers values ('$u','$selected','$scat','$pri', '$lim', '$lim') ";
		$res = mysqli_query($conn,$query);
	}
?>
