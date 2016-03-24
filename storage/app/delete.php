<?php
	require '../vendor/autoload.php';
	include './config.php';

	if(!isset($_SESSION['email'])){
		header("location: ./index.php");
	}

	$key = $_REQUEST['Key'];
	$prefix = $_SESSION['email'];
	
	$msg = "success";
	$param = ['Bucket'=>$bucket,'Key'=>$prefix."/".$key];
	
	try{	
		//find file
		$result = $s3->getObject($param);
		if($result){
			//Delete file 
			try{
				$s3->deleteObject($param);
			}catch(S3Exception $e){
				$msg = "error : [delete] ".$e->getMessage();
			}
		}else{
			$msg = "error : file not found.";
		}
	} catch(Exception $e){
		$msg = $msg."error : [delete:find] ".$e->getMessage();
	}
	
	echo $msg;
?>

