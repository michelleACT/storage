<?php
	require '../vendor/autoload.php';
	include './config.php';
  	
	$key = $_REQUEST['key']."/";
	$callback = $_REQUEST['callback'];
	$bc =  $_REQUEST['bucket'];

	try{
		$s3->putObject([
			'ACL'=>'public-read',
			'Bucket'=>$bc,
			'Key'=>$key
		]);
		//echo "success";
		echo $callback."({'resp' : 'success'})";
	}catch(S3Exception $e){
		//echo "error : ".$e->getMessage();	
		echo $callback."({'resp' : 'error : ".$e->getMessage()."'})";
	}
?>

