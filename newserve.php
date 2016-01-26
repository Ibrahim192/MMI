<?php
        session_start();

	require_once("db_connection.php");
	require_once("functions.php");
	//Just to add services to companies/organizations
        if(isset($_SESSION["cid"]))
        {
                $cid=$_SESSION["cid"];
                $to=$_GET["serve"];
                foreach($to as $i)
                {

                        $query="Insert into Cat_Comp values('$cid','$i')";
                        $res=mysqli_query($conn,$query);
                
                }
		if($res)
                	redirect("companies.php?success=Added Services Successfully");
		else
			redirect("companies.php?success=Failed to add!");
        
        }
?>
