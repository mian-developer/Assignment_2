<?php

/**
 * 
 */
class DB_Connect
{
	private $hostName="localhost";
	private $userName="root";
	private $db_password="";
	private $dbName="phone";
	private $db;

	function __construct()
	{
		$error="Error Connecting to Database!";
		$this->db=mysqli_connect($this->hostName,$this->userName,$this->db_password,$this->dbName)
        or die($error);
	}

	public function register($name,$email,$pass)
	{
		$query="INSERT INTO user(`name`,`email`,`password`) values('$name','$email','$pass')";

		$result=$this->db->query($query)

		or die("Error".mysqli_error($this->db));

		return $result;
	}

	public function login($email,$password)
	{
		$query="SELECT `email`,`password` FROM user WHERE email='$email' AND password='$password'";

		$result=$this->db->query($query)

		or die("Error".mysqli_error($this->db));

		return $result;
	}

	public function add($name,$number,$uid)
	{
		$query="INSERT INTO contacts(`name`,`numbers`,`user_id`) values('$name','$number','$uid')";

		$result=$this->db->query($query)

		or die("Error".mysqli_error($this->db));

		return $result;
	}

	public function show(){
		$query = "select * from contacts";
		$result = $this->db->query($query) 

		or die("Error ".mysqli_error($this->db));
		return $result;
	}

	public function delete($id){
		$query = "Delete from contacts where id='$id'";
		$result = $this->db->query($query) 

		or die("Error ".mysqli_error($this->db));
		return $result;
		
	}

	public function showrecord($id){
		$query = "select * from contacts where id= '" . $id . "'";
		$result = $this->db->query($query) or die("Error ".mysqli_error($this->db));
		return $result;
		}

	public function update($id,$name,$number)
	{
		 $query = "UPDATE contacts SET name = '$name' , numbers ='$number' WHERE id = '$id'";
		// echo $updateQuery;
		$result = $this->db->query($query) 

		or die("Error ".mysqli_error($this->db));
		return $result;
	}
}

?>