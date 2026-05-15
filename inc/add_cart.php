<?php
	require_once 'connection.php';
	include '../includes/session.php';

	if(!isset($_SESSION['user'])){
			$_SESSION['error']="Signup or Login to continue";
			header('location: ../login.php');
	}else{

		if(isset($_GET['add'])){

			$query=$conn->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=?");
			$query->bind_param("ss", $_SESSION['user'], $_GET['add']);
			$query->execute();
			$result=$query->get_result();
			if($result->num_rows>0){
				$_SESSION['error']="Product already exist";
			}else{
				$proQty=1;
				$query=$conn->prepare("INSERT INTO cart(user_id, product_id, quantity) VALUES(?,?,?) ");
				$query->bind_param("sss", $_SESSION['user'], $_GET['add'], $proQty);
				$query->execute();
				$_SESSION['success']="Item added to cart";
				header('location: ../index.php');
			}
		}
	}

?>