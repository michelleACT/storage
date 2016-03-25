<?php
	require '../vendor/autoload.php';
	include './config.php';
	include './fn/fn.php';

	if(!isset($_SESSION['email'])){
		header("location: ./index.php");
	}	
	
	$prefix = "test1@gmail.com"; //$_SESSION['email'];

	if(isset($_FILES['userFile']['type'])){
		$key = $prefix."/".$_FILES['userFile']['name'];
		$expiredDate = date("m/d/Y", strtotime(date("m/d/Y")."+ 1 days ")); 

		try{
			$s3->putObject([
					'ACL'=>'public-read',
					'SourceFile'=>$_FILES['userFile']['tmp_name'],
					'Bucket'=>$bucket,
					'ContentType'=>$_FILES['userFile']['type'],
					'Key'=>$key,
					'Expires'=>$expiredDate,
					'Metadata'=>array('resolution'=>'1920*1024','duration'=>'0:0:0')
			]);
			
			echo "success";
		}catch(Exception $e){
		 	echo "error : Please contact your system administrator";
            //console_log("error : [upload] ".$e->getMessage());
		}
	}else{
	 	echo "error : file not found.";
        //console_log("error : [upload] ".$e->getMessage());
	}

?>
