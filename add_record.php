<?php
session_start();
if($_SESSION['users']!='user'){
 header('Location: login.php');
 die();
}

$name_error=$number_error="";
$name=$number="";
$success=$failure="";

if(isset($_POST['add'])){
	if(empty($_POST['name'])){
		$name_error="Please Enter Name";
	}else{
		$name=test_input($_POST['name']);
	}

	if(empty($_POST['num'])){
		$number_error="Please Enter Number";
	}else{
		$number=test_input($_POST['num']);
	}

	if(empty($name_error)&&empty($number_error)){
		require_once('database_connection_class.php');

		$db=new DB_Connect();
		$name=$_POST['name'];
		$number=$_POST['num'];
		//$set=$_SESSION['uid']="id";
		$uid=$_SESSION['id'];
		

		$result=$db->add($name,$number,$uid);
		if($result==1){
			header('Location:index.php');
		}else{
			
            $failure='Check For Errors!';
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
	<title>Add Record</title>
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
						Add Phone Record
					</span>
					<span style="color:white" class="error"><?php echo $success;?></span>
                    <span class="error"><?php echo $failure;?></span>
				</div>

				<form class="login100-form validate-form" method="post" action="">

					<div >
						
						<input class="input100" type="hidden" name="id">
						
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Name is required">
						<span class="label-input100">Name</span>
						<input class="input100" type="text" name="name" placeholder="Enter Name">
						<span class="focus-input100"></span>
						<span class="error"><?php echo $name_error;?></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Number is required">
						<span class="label-input100">Number</span>
						<input class="input100" type="tel" name="num" placeholder="Enter Number">
						<span class="focus-input100"></span>
						<span class="error"><?php echo $number_error;?></span>
					</div>

				

			

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="add" value="Add">
					
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

