<?php  
require_once 'connection.php';
	
	if(isset($_POST['login'])){

		$email=$conn->real_escape_string($_POST['email']);
		$password=$conn->real_escape_string($_POST['password']);

		$_SESSION['email']=strtolower($email);

		$query=$conn->prepare("SELECT * FROM users WHERE email=?");
		$query->bind_param("s", $_POST['email']);
		$query->execute();
		$result=$query->get_result();

		if($result->num_rows==1){
			$row=$result->fetch_array();
			if(password_verify($_POST['password'], $row['password'])){
				$_SESSION['usermail']=$conn->real_escape_string($_POST['email']);

			}else{
				$_SESSION['message']= "Invalid username or password!";
		   		$_SESSION['msg_type']="danger"; 
		   		header("location: ../signin.php");
			}
		}

	}