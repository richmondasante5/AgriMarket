<?php  
	require_once 'connection.php';

	if(isset($_POST['login'])){
		$email=$conn->real_escape_string($_POST['email']);
		$password=$conn->real_escape_string($_POST['password']);
		$query=$conn->prepare("SELECT * FROM admin WHERE email=?");
		$query->bind_param("s", $email);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows>0){
			$row=$result->fetch_array();

			
			
			if(password_verify($_POST['password'], $row['password'])){
				$_SESSION['admin']=$row['email'];
				$_SESSION['user']=$row['id'];
				$_SESSION['name']=$row['name'];
				$_SESSION['email']=$row['email'];
				$_SESSION['phone']=$row['phone'];

				header('location: ../index.php');

			}else{
				$_SESSION['message']= "Invalid email or password!";
		   		$_SESSION['msg_type']="danger"; 
		   		header("location: ../login.php");
			}
		}else{
			$_SESSION['message']= "Invalid email or password!";
	   		$_SESSION['msg_type']="danger"; 
	   		header("location: ../login.php");
		}
	}
?>
