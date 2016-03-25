<?php
	require '../vendor/autoload.php';
	include './config.php';
	include './fn/fn.php';
	
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
				$msg = "error : Please contact your system administ";
				//console_log("error : [delete] ".$e->getMessage());
			}
		}else{
			$msg = "error : file not found.";
			//console_log("error : [delete] file not found.");
		}
	} catch(Exception $e){
		$msg = "error : Please contact your system administ";
		//console_log("error : [delete] ".$e->getMessage());
	}
	
	echo $msg;
?>

