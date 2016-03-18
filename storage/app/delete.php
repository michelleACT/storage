<?php

  require '../vendor/autoload.php';

  $key = $_REQUEST['Key'];
  $credentials = new Aws\Credentials\Credentials('AKIAIUPNF6WRZ2C7HRIA', 'hxjzxtjtnKYURVSypSrehDh0Qe8FtLmYlQoho/dS');

  $s3 = new Aws\S3\S3Client([
		'version' => '2006-03-01',
		'region'  => 'us-west-2',
		'credentials' => $credentials
        ]);

  $bucket = 'activeon-test-bc';

  $error = "";
  try{
  	$s3->deleteObject([
    	'Bucket'=>$bucket,
    	'Key'=>$key 
  	]);
  }catch(Exception $e){
  	$error = $e->getMessage()."(error : ".$e->getCode().")";
  }

  if($error != ""){
  	echo $error;

  }else{
  	header('Location: list.php');
  }
  
?>

