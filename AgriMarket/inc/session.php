<?php
include 'connection.php';
	session_start();

if(isset($_SESSION['usermail'])){
		$query=$conn->prepare("SELECT * FROM users WHERE email=?");
		$query->bind_param("s", $_SESSION['usermail']);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows>0){
			$row=$result->fetch_array();
			$_SESSION['userid']=$row['id'];
		}
	}
?>