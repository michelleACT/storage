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
  $param = ['Bucket'=>$bucket,'Key'=>$prefix."/".$key];
 
  $result = null;
  try{	
    $result = $s3->getObject($param);

	header("Content-Type: ".$result['ContentType']);
	header("Content-length: ".$result['ContentLength']);
	header("Content-disposition: attachment; filename=".$key); 
	
	echo $result['Body'];
  }catch(Exception $e){
	echo "<script>".
		 "location.href='list.php'; ".
		 "alert('error : file not found.please contact administrator.'); ".
		 "</script>";
  }

?>
