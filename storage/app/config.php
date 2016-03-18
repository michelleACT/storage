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

?>

