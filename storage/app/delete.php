<?php
	require '../vendor/autoload.php';
	include './config.php';

	$key = $_REQUEST['Key'];
	$prefix = $_SESSION['email'];

	$msg = "success";
	try {
		$s3->deleteObject([
			'Bucket'=>$bucket,
			'Key'=>$prefix."/".$key 
		]);
	} catch (S3Exception $e) {
	    $msg = 'error : '.$e->getMessage();
	}

	echo $msg;
?>

