<?php
  include './fn/fn.php';
  require '../vendor/autoload.php';
  include './config.php';
  
  session_start();

  if(!isset($_SESSION['email'])){
  	header("location: ./index.php");
  }

  $prefix = $_SESSION['email'];

  $list = $s3->listObjects(Array('Bucket'=>$bucket, 'Prefix'=>$prefix));
  $listArray = $list->toArray(); 

?>
<html>
  <link rel=stylesheet href='./css/main.css' type='text/css'> 
  <head><title>activeon</title></head>
  <body>
    <div id="list_mainDiv">
    <h1>ACTIVEON Cloud</h1>
	<div class="topDiv">
	  <a href="./logout.php">LogOut</a>
	</div>
    <div class="buttonDiv">
      <form action="./upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="userFile" >
        <input type="hidden" name="prefix" value="<?=$prefix?>">
        <input type="submit" value="Upload" name="submit">
      </form>
    </div>
    <div clase="contentDiv">
    <ul class="titleUl">
      <li>file Name</li>
      <!-- <li>Resolution</li> -->
      <li>Updated Date</li>
      <li class="alignCenter wid130">Size</li>
      <li class="alignCenter wid130">Delete</li>
      <li class="alignCenter wid130">Download</li>
    </ul>
    <?php
    foreach($listArray['Contents'] as $item){
      $result= $s3->getObject(Array('Bucket'=>$bucket, 'Key'=>$item['Key']));
      if($result["ContentLength"] > 0){
    ?>
    <ul class="contentsUl">
      <li class="wid180"><?php echo str_replace($prefix."/","",$item['Key']); ?></li>
      <!-- <li><?php /* echo $result["Metadata"]["a"]; */ ?></li> -->
      <li class="alignRight"><?php echo date_format($result["LastModified"], 'm-d-Y'); ?></li>
      <li class="alignRight"><?php echo byteConvert( $result["ContentLength"]); ?></li>
      <li class="alignCenter"><button onclick="deleteByKey('<?php echo $item["Key"]?>')">Delete</button></li>
      <li class="alignCenter"><button onclick="downloadByKey('<?php echo $item["Key"];?>','<?php echo $result["ContentLength"]; ?>')">Download</button></li>
    </ul>
    <?php 
      }
    } ?>
    </div>
	</div>
  <script src="./js/jquery-2.2.1.min.js"></script>
  <script>
  function deleteByKey(key){
    var dataStr = "Key="+key;
	
	var answer = confirm('Are you sure you want to delete this?');
	if(answer){
		$.ajax({
			type: "POST",
			url: "delete.php",
			data: dataStr,
			success : function(data){
				if(data.indexOf("success")){
					alert("Delete Success.");
					location.reload();
				}else{
					alert(data);
				}
			},
			error : function(json){
				alert("Delete error : " + json);
			}
		});
	}
	
  }

  function downloadByKey(key,len){
    var url = "download.php?Key=" + key + "&len=" + len;
    location.href= url;
  }
  </script>
  </body>
</html>

