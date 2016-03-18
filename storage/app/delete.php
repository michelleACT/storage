<?php
	require '../vendor/autoload.php';
	include './config.php';
	
	$key = $_REQUEST['Key'];
	
	$msg = "success";
	try {
		$s3->deleteObject([
			'Bucket'=>$bucket,
			'Key'=>$key 
		]);
	} catch (Exception $e) {
	    $msg = 'error : '. $e->getMessage();
	}

	echo $msg;
?>

