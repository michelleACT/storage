<?php
  require '../vendor/autoload.php';

  $key = $_REQUEST['Key'];
  $len = $_REQUEST['len'];  

  /*
  $credentials = new Aws\Credentials\Credentials('AKIAIUPNF6WRZ2C7HRIA', 'hxjzxtjtnKYURVSypSrehDh0Qe8FtLmYlQoho/dS');
  $s3 = new Aws\S3\S3Client([
    'version' => '2006-03-01',
    'region'  => 'us-west-2',
    'credentials' => $credentials
  ]);
  */
  $bucket = 'activeon-test-bc';
  $prefix = 'test1@gmail.com';

  $fileName = str_replace($prefix."/","",$key);
  /*
  $result = $s3->getObject([
    'Bucket'=>$bucket,
    'Key'=>$key    //'SaveAs'=>fopen('sample_saved.txt','w')
  ]);
  */
  $url = "https://s3-us-west-2.amazonaws.com/".$bucket."/".$key;
  
  header("Content-Type: application/octet-stream");
  header("Content-length: ".$len);
  //header("Content-Transfer-Encoding: Binary");
  header("Content-disposition: attachment; filename='".$fileName."'"); 

  header("Location: ".$url);
 
 
  //echo $link;
?>

