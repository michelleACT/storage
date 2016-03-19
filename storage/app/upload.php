<?php
	require '../vendor/autoload.php';
	include './config.php';
  	
	if(isset($_FILES['userFile']['type'])){
		$prefix = $_SESSION['email'];

		$key = $prefix."/".$_FILES['userFile']['name'];
		$expiredDate = date("m/d/Y", strtotime(date("m/d/Y")."+ 1 days ")); 

		try{
			$s3->putObject([
				'ACL'=>'public-read',
				'SourceFile'=>$_FILES['userFile']['tmp_name'],
				'Bucket'=>$bucket,
				'Key'=>$key,
				'Expires'=>$expiredDate,
				'Metadata'=>array('resolution'=>'1920*1024','duration'=>'0:0:0')
			]);

			//header('Location: list.php');
			echo "success";
		}catch(S3Exception $e){
			echo "error : ".$e->getMessage();	
		}
	}else{
		echo "error : file not found.";
	}
?>

