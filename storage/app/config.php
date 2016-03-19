<?php
  require '../vendor/autoload.php';
 
  use Aws\S3\Exception\S3Exception as S3Exception;

  session_start();

  $s3 = new Aws\S3\S3Client([
  			'version' => '2006-03-01',
			'region'  => 'us-west-2',
  ]);

  $bucket = 'activeon-test-bc';

?>

