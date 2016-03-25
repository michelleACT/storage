<?php
  //header("Content-Type: text/html; charset=utf-8");
  include './fn/fn.php';
  require '../vendor/autoload.php';
  include './config.php';

  if(!isset($_SESSION['email'])){
  	header("location: ./index.php");
  }

  $prefix = $_SESSION['email'];

  $list = $s3->listObjects(Array('Bucket'=>$bucket, 'Prefix'=>$prefix));
  $listArray = $list->toArray(); 

?>
<html>
  <link rel=stylesheet href='./css/main.css' type='text/css'> 
  <head>
  	 <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  	<title>activeon</title>
  </head>
  <body>
    <div id="list_mainDiv">
	<div id="logoDiv">
		<img src =
		"http://www.activeon.com/wp/wp-content/uploads/2015/09/logo1.gif"/>
	</div>
    <!--<h1>ACTIVEON Cloud</h1> -->
	<div class="topDiv">
	  <a href="./logout.php">LogOut</a>
	</div>
	<div id="progressbar" style="display:none"></div>
	<div class="uploadDiv">
      <form id="uploadForm"  action="" method="post" enctype="multipart/form-data">
        <input type="file" name="userFile" >
        <input type="submit" value="Upload" name="submit">
      </form>
    </div>
	<div id="processDiv"><label id="processLab"></label></div>
    <div class="contentDiv">
    <ul class="titleUl">
      <li>file Name</li>
      <!-- <li>Resolution</li> -->
      <li>Updated Date</li>
	  <li class="wid150">Expiration Date</li>
      <li class="alignCenter wid130">Size</li>
      <li class="alignCenter wid130">Delete</li>
      <li class="alignCenter wid130">Download</li>
    </ul>
    <?php
    foreach($listArray['Contents'] as $item){
      $result= $s3->getObject(Array('Bucket'=>$bucket, 'Key'=>$item['Key']));
      if($result["ContentLength"] > 0){
	  	$fileName = str_replace($prefix."/","",$item['Key']);   
	?>
    <ul class="contentsUl">
      <li class="wid180"><?php echo $fileName; ?></li>
      <!-- <li><?php /* echo $result["Metadata"]["a"]; */ ?></li> -->
	  <li><?php echo date_format($result["LastModified"],'m/d/Y'); ?></li>
      <li class="wid150"><?php echo date_format($result["Expires"],'m/d/Y'); ?></li>	 
      <li class="alignRight"><?php echo byteConvert( $result["ContentLength"]); ?></li>
      <li class="alignCenter"><button class="btn" onclick="deleteByKey('<?php echo
	  $fileName?>')">Delete</button></li>
      <li class="alignCenter"><button class="btn" onclick="downloadByKey('<?php echo
	  $fileName;?>')">Download</button></li>
    </ul>
    <?php 
      }
    } ?>
    </div>
	</div>
  <script src="./js/jquery-2.2.1.min.js"></script>
  <script>
  var progressbar = $( "#progressbar" ), progressLabel = $( ".progress-label" );
  
  function deleteByKey(key){
    var dataStr = "Key="+key;
	
	var answer = confirm('Are you sure you want to delete this?');
	if(answer){
		$.ajax({
			type: "POST",
			url: "delete.php",
			data: dataStr,
			success : function(data){
				if(data.indexOf("success") >  -1){
					alert("Delete Success.");
					//location.reload();
				}else{
					alert(data);
				}
			},
			error : function(data){
				//alert("Delete error : [" + data.status + "] " + data.statusText);
				alert("error : Please contact your system administrator.");
			},
			beforeSend : function(e){
				$("#processLab").text( "Loading..");
			},
			complete : function(e){
				$("#processLab").text("");
				location.reload();
			}
		});
	}
  }

  function downloadByKey(key){
    var url = "download.php?Key=" + key;
    location.href= url;
  }

  $("#uploadForm").on('submit',(function(e){
	 $.ajax({
		  type: "POST",
		  url: "upload.php",
		  cache: false,
		  processData:false,
		  contentType: false,
		  data: new FormData(this),
		  success : function(data){
			  if(data.indexOf("success") > -1){
				  alert("Upload Success.");
				  //location.reload();
			  }else{
				  alert(data);
			  }
		  },
		  error : function(data){
			  //alert("Upload  error : [" + data.status + "] " + data.statusText);
		  	alert("error : Please contact your system administrator");
		  },
		  beforeSend : function(e){
			  $("#processLab").text( "Loading..");
		  },
		  complete : function(e){
			  $("#processLab").text("");
			  location.reload();
		  }
	  });
  }));

  </script>
  </body>
</html>

