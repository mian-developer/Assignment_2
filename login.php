<?php
session_start();
if (isset($_SESSION['users'])) {
  header('Location: index.php');
  die();
}

$email_error=$password_error="";
$email=$password="";

if(isset($_POST['login'])){

	if(empty($_POST['email'])){
		$name_error="Please Enter Email";
	}else{
		$name=test_input($_POST['email']);
	}

	if(empty($_POST['pass'])){
		$name_error="Please Enter Password";
	}else{
		$name=test_input($_POST['pass']);
	}

	if(empty($name_error)&&empty($email_error)&&empty($password_error)){
		require_once('database_connection_class.php');

		$db=new DB_Connect();
		//$id=$_POST['id'];
		$email=$_POST['email'];
		$pass=md5($_POST['pass']);

		$result=$db->login($email,$pass);
		if(mysqli_num_rows($result)>0){
			while ($data = mysqli_fetch_assoc($result)) {
				$id= $data['id'];
				//$name= $data['name'];
                $_SESSION['email']= $email;
                $_SESSION['id']=$id;
    			$_SESSION['users']= "user";
    			header("Location: index.php");
  			}
		}else{
			header('Location:login_error.php');
			
		}

	}
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Login
					</span>
				</div>

				<form class="login100-form validate-form" method="post" action="">

					<div >
						
						<input class="input100" type="hidden" name="id" value="<?php echo $id ?>">
					
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Enter Email">
						<span class="focus-input100"></span>
						<span class="error"><?php echo $email_error;?></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
						<span class="error"><?php echo $password_error;?></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							
						</div>

						
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="login" value="Login">
							 &nbsp; &nbsp; &nbsp; <span>OR</span> &nbsp; &nbsp; &nbsp;
 
						<a class="login100-form-btn" href="register.php">Register</a> 
					
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>