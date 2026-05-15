<?php
	session_start();
	include 'inc/connection.php';
	include 'includes/conn.php';

	if(isset($_SESSION['usermail'])){
		$query=$conn->prepare("SELECT * FROM users WHERE email=?");
		$query->bind_param("s", $_SESSION['usermail']);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows>0){
			$row=$result->fetch_array();
			$_SESSION['user']=$row['id'];
		}
	}
	

	if(isset($_SESSION['usermail'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
			$stmt->execute(['email'=>$_SESSION['usermail']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

		$pdo->close();
	}
	
?>