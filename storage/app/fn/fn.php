<?php
  function byteConvert($bytes){ 
    $s = array('Bytes', 'KB', 'MB', 'GB');
    $e = floor(log($bytes)/log(1024)); 
    return sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e)))); 
  }

  
  function console_log( $data ){
  	echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
	echo '</script>';
  }

?>
