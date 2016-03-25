<?php
	header("Content-Type: text/html; charset=utf-8");
    require '../vendor/autoload.php';
    include './config.php';
    include './fn/fn.php';
			    
    if(!isset($_SESSION['email'])){
	    header("location: ./index.php");
	}
 
    $key = $_REQUEST['Key'];
	$prefix = $_SESSION['email'];
	$fullKey = $prefix."/".$key;
	$param = ['Bucket'=>$bucket,'Key'=>$fullKey];
				 
	try{
		$result = $s3->getObject($param);
						    
		$url = "https://s3-us-west-2.amazonaws.com/".$bucket."/".$fullKey;

		header("Content-Type:".$result['ContentType']);
		header("Content-Transfer-Encoding: Binary");
		header("Content-length: ".$result['ContentLength']);
		header("Content-disposition: attachment;filename='".$key."'");

		header("location: ".$url);
	}catch(Exception $e){
		echo "<script>".
		 	    "location.href='list.php'; ".
				"alert('error : Please contact your system administrator.'); ".
			"</script>";
		//console_log("error : [download] ".$e->getMessage());
	}

 ?>


