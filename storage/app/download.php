<?php
  require '../vendor/autoload.php';
  include './config.php';

  $key = $_REQUEST['Key'];
  $prefix = $_SESSION['email'];

  $fileName = str_replace($prefix."/","",$key);
  $result = $s3->getObject([
    'Bucket'=>$bucket,
    'Key'=>$key    
  ]);

  header("Content-Type: ".$result['ContentType']);
  header("Content-length: ".$result['ContentLength']);
  header("Content-disposition: attachment; filename='".$fileName."'"); 

  echo $result['Body'];
?>

