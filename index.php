<?php
session_start();
if ($_SESSION['users']!='user') {
  header('Location: login.php');
  die();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
</head>
<body>

<div class="header">
  <a href="index.php" class="logo">Phone Book Directory</a>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
    <a href="#">Welcome : <?php echo $_SESSION['email']; ?></a>
    <a href="logout.php">Logout</a>
  </div>
</div>

<div class="container">
  <h2><marquee>Welcome to Phone Book</marquee></h2>
  <div class="panel panel-default">
    <div class="panel-heading text-center"><h3><b>Phone Book Records</b></h3></div>
    <div class="panel-body">
    	<tr><a href="add_record.php" class="btn btn-success">Add Record</a></tr>
  <table class="table" id="example">
  	
 	<hr>
  <thead style="margin-top:30px">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Number</th>
      <th scope="col">User Id</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		require_once('database_connection_class.php');
  		$db=new DB_Connect(); 
  		$result=$db->show();
  		if (mysqli_num_rows($result)>0) {
  			while ($row = mysqli_fetch_array($result)) {
  			$id= $row['id'];
  			$name = $row['name'];
			$number = $row['numbers'];
			$userid = $row['user_id'];

			   echo '<tr>
     				<td>'.$id.'</td>
     				<td>'.$name.'</td>

     				<td>'.$number.'</td>
     				<td>'.$userid.'</td>
      				<td><a href="update_record.php?id='.$id.'" class="btn btn-info">Edit</a>&nbsp; 
      				<a href="delete_record.php?id='.$id.'" class="btn btn-danger">Delete</a></td>
    </tr>';
			
  			}
  		}
    ?>
  </tbody>
</table>
    </div>
    <div class="panel-footer text-center">
    	<?php
    	date_default_timezone_set("Asia/Karachi");
   		echo date("m/d/y h:i:sa<br>", time());
   		?>
    </div>
  </div>
</div>


<div class="footer text-center">
  <p>&copy; <?php
		$copyYear = 2016; 
		$curYear = date('Y');
		echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
		?> Copyright.</p>
</div>

</body>

</html>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>