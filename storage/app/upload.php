<?php

  require '../vendor/autoload.php';

  $key = $_REQUEST['Key'];
  $credentials = new Aws\Credentials\Credentials('AKIAIUPNF6WRZ2C7HRIA', 'hxjzxtjtnKYURVSypSrehDh0Qe8FtLmYlQoho/dS');

  $s3 = new Aws\S3\S3Client([
		'version' => '2006-03-01',
		'region'  => 'us-west-2',
		'credentials' => $credentials
        ]);

  $bucket = 'activeon-test-bc';
  $prefix = $_POST['prefix'];
  $key = $prefix."/".$_FILES['userFile']['name'];
  $expiredDate = date("m/d/Y", strtotime(date("m/d/Y")."+ 1 days ")); 

  $s3->putObject([
	'ACL'=>'public-read',
	'SourceFile'=>$_FILES['userFile']['tmp_name'],
	'Bucket'=>$bucket,
	'Key'=>$key,
        'Expires'=>$expiredDate,
	'Metadata'=>array('resolution'=>'1920*1024','duration'=>'0:0:0')
  ]);

  header('Location: list.php');
?>

