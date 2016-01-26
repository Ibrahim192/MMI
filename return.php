<?php
function random_str($length)
	{

		$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$str = '';
    		$max = mb_strlen($keyspace, '8bit') - 1;

    		for ($i = 0; $i < $length; ++$i)
		 {
        		$str .= $keyspace[mt_rand(0, $max)];

    		 }
    		return $str;
	}
if(isset($_GET["From"]))
	$From=$_GET["From"];
else
	$From=$_POST["From"];
if(isset($_GET["To"]))
	$To=$_GET["To"];
else
	$To=$_POST["To"];
if(isset($_GET["otp"]))
{
	$Body=random_str(4);
}
else
{ $catname=$_POST["scat"];$Body=$From." ".$catname." ".$_POST["Body"];}
    //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
$post_data=array('From'=>$From,'To'=>$To,'Body'=>$Body);
$exotel_sid = "xxx"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
$exotel_token = "xxx"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
 
$url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";
 
$ch=curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
 
$http_result = curl_exec($ch);
echo($http_result);
$error = curl_error($ch);
$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);

curl_close($ch);

?>
