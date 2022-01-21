<?php

include_once('connection.php');
if (isset($_POST['send'])) {
	$contact =$_POST['contact'];
	$message=$_POST['message'];
     
     $mobileNumbers=implode('', $contact);
     $arr=str_split($mobileNumbers, '10');

     $numbers = implode('', $arr);
     $authKey = "29695a5ba5bec42f57e96f5e1454150b";
     $senderId="AC121e852ca68bee78697d0c075ce858c9";
     $route=4;
     $postData=array(
      'authKey'=>$authKey,
      'mobiles'=>$numbers,
      'sender'=>$senderId,
      'route'=>$route      
     );
$url="http://api.msg91.com/api/sendhttp.php";

$ch=curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POST=>true,
CURLOPT_POSTFIELDS =>$postData

));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
if($response==TRUE){
	echo "<script>alert('sms sended successfully')</script>";
            echo "<script>window.location='sendsms.php'</script>";
}
if(curl_errno($ch)){
echo 'error:' .curl_error($ch);
echo "<script>alert('sms not sended successfully')</script>";
            echo "<script>window.location='sendsms.php'</script>";
}
curl_close($ch);
echo "<script>alert('sms not sended successfully')</script>";
            echo "<script>window.location='sendsms.php'</script>";
}

?>