<?php
  session_start();  

  if(isset($_SESSION['email'])){
    header("location: list.php");
  }
?>
<html>
  <link rel=stylesheet href='./css/main.css' type='text/css'>
  <head><title>Login</title></head>
  <body>
  	<div id="mainDiv">
    	<div id="loginDiv">
      		<h2>Login</h2>
      		<form action="" method="post" id="loginForm">
        		<label>Email :</label>
        		<input type="text" name="login_email" id="login_email" placeholder="test@test.com"  required />
        		<label>Password :</label>
        		<input type="password" name="login_pw" id="login_pw"  placeholder="********" required />
        		<button type="submit" id="login_loginBtn" >Login</button>
      		</form>
    	</div>
	</div>
  <script src="./js/jquery-2.2.1.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#login_loginBtn').click(function() {
            var email=$("#login_email").val();
            var password=$("#login_pw").val();
            var dataString = 'email='+email+'&password='+password;
            if($.trim(email).length>0 && $.trim(password).length>0) {
                $.ajax({
                    type: "POST",
                    url: "https://activeon.com/wp/adm_product/email_api.php",
                    data: dataString,
                    dataType: 'jsonp',
                    cache: false,
                    beforeSend: function(){ $("#login_loginBtn").val('Connecting...');},
                    success: function(data){
                        if(data.resp==="success") {
                       	  	//alert("success! " + email);
							location.href ="./login.php?email=" + email;
						}else{
                          alert("email or Password is invalid");
                        }
                    }

                });
            }
            return false;
        });
    });
</script>
  </body>
</html>
