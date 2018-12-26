<?php
require_once ('database_connection_class.php');
$db = new DB_Connect();
session_start();
if($_SESSION['user']!="user")
{
header("location: login.php");
}
$rid=$_GET['id'];
$del=$db->delete($rid);
if($del==1){
header("location: index.php");
//echo("Deleted");
}


?>