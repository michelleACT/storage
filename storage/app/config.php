<?php
  require '../vendor/autoload.php';
  use Aws\S3\Exception\S3Exception as S3Exception;

  $credentials = new Aws\Credentials\Credentials('AKIAIUOJ5T7PTYKSJQJQ',
	'XAoYzZ/OzYSO+LW7SAzNFAFhcTWDBrmZTcg0F2iN');

  $s3 = new Aws\S3\S3Client([
		'version' => '2006-03-01',
		'region'  => 'us-west-2',
		'credentials' => $credentials
        ]);

  $bucket = 'activeon-test-bc';

?>

