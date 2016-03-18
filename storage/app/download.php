<?php
  require '../vendor/autoload.php';
  include './config.php';

  $key = $_REQUEST['Key'];
  $prefix = $_SESSION['email'];
  
  try{
	$result = $s3->getObject([
	  'Bucket'=>$bucket,
	  'Key'=>$prefix."/".$key    
	]);

	header("Content-Type: ".$result['ContentType']);
	header("Content-length: ".$result['ContentLength']);
	header("Content-disposition: attachment; filename=".$key); 

	echo $result['Body'];
  }catch(S3Exception $e){
  	echo "error : ".$e->getMessage();
  }

?>

