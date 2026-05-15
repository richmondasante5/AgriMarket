<?php  
session_start();
	require_once 'connection.php';
	if (isset($_SESSION['user'])) {
		$query=$conn->prepare("SELECT * FROM admin WHERE id=?");
		$query->bind_param("s", $_SESSION['user']);
		$query->execute();
		$result=$query->get_result();
		if($result->num_row==1){
			$row=$result->fetch_array();
		}
	}
?>