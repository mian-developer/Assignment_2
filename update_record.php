<?php
session_start();
if($_SESSION['users']!='user'){
 header('Location: login.php');
 die();
}

require_once('database_connection_class.php');

$db=new DB_Connect();

$view  = $db->showrecord($_GET['id']);

if (mysqli_num_rows($view) > 0) {
	while($row = mysqli_fetch_assoc($view)){
			$id= $row['id'];
  			$names = $row['name'];
			$numbers = $row['numbers'];
			$userid = $row['user_id'];
	}
}else { die('no data'); }

$name_error=$number_error="";
$name=$number="";
$success=$failure="";

if(isset($_POST['update'])){
	if(empty($_POST['name'])){
		$name_error="Please Enter Name";
	}else{
		$name=test_input($_POST['name']);
	}

	if(empty($_POST['num'])){
	}else{
		$number=test_input($_POST['num']);
	}

	if(empty($name_error)&&empty($number_error)){
		
		$id=$_POST['id'];
		$name=$_POST['name'];
		$number=$_POST['num'];
		//$set=$_SESSION['uid']="id";
		

		$result=$db->update($id,$name,$number);
		if($result==1){
			header('Location:phonebook.php');
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
	<title>Udate Record</title>
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
						Update Phone Record
					</span>
					<span style="color:white" class="error"><?php echo $success;?></span>
                    <span class="error"><?php echo $failure;?></span>
				</div>

				<form class="login100-form validate-form" method="post" action="">
					<div >
						
						<input class="input100" type="hidden" name="id"  value="<?php echo $id; ?>">
						
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Name is required">
						<span class="label-input100">Name</span>
						<input class="input100" type="text" name="name"  value="<?php echo $names; ?>">
						<span class="focus-input100"></span>
						<span class="error"><?php echo $name_error;?></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26" data-validate="Number is required">
						<span class="label-input100">Number</span>
						<input class="input100" type="tel" name="num"  value="<?php echo $numbers; ?>">
						<span class="focus-input100"></span>
						<span class="error"><?php echo $number_error;?></span>
					</div>

			

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="update" value="Update">
					
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

