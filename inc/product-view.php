<?php  
	session_start();
	require_once 'connection.php';

	if(isset($_GET['view'])){
		#getting full product details based on product ID
		$_SESSION['error']='Select and view product in category';
		header('location: ../index.php');
		
	}
?>