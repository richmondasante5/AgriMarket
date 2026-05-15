<?php  
	require_once 'connection.php';
	if(isset($_POST['signup'])){
		$name= $conn->real_escape_string($_POST['name']);
		$phone= $conn->real_escape_string($_POST['phone']);
		$email= $conn->real_escape_string($_POST['email']);
		$password= $conn->real_escape_string($_POST['password']);
		$repassword= $conn->real_escape_string($_POST['repassword']);

		if(preg_match('~[0-9]+~', $_POST['name'])){
			$_SESSION['danger']= "Invalid name";
		    header("location: ../signup.php");
			// validating phone number
		}elseif ($repassword!=$password) {
			$_SESSION['message']="Check phone No!";
			$_SESSION['msg_type']="danger"; 
			 header("location: ../signup.php");
		}elseif (strlen($phone)<10 || strlen($phone)>10){
			$_SESSION['message']="Check phone No!";
			$_SESSION['msg_type']="danger"; 
			header("location: ../signup.php");
		}elseif(!preg_match("/^[02-9]\d{9}$/", $phone)){
			$_SESSION['message']="Invalid phone No!";
			$_SESSION['msg_type']="danger"; 
			header("location: ../signup.php");
		}else{
			$query=$conn->prepare("SELECT COUNT(id) FROM admin");
			$query->execute();
			$result=$query->get_result();
			$row=$result->fetch_array();
			$total=$row['COUNT(id)'];

			if($total>=2){
				$_SESSION['message']= "Admin cannot be added";
				$_SESSION['msg_type']= "danger";
				header('location: ../signup.php');
			}else{

				//check if the email already exists
				$query=$conn->prepare("SELECT * FROM admin WHERE email=?");
				$query->bind_param("s", $email);
				$query->execute();
				$result=$query->get_result();
				if($result->num_rows>0){
					$_SESSION['message']="Email already exist";
					$_SESSION['msg_type']="danger"; 
					header("location: ../signup.php");
				}else{
					$name=ucwords(strtolower($name)); 
					$email=strtolower($email);
					$password=password_hash($_POST['password'], PASSWORD_DEFAULT);

					$query=$conn->prepare("INSERT INTO admin(name, email, phone, password) VALUES(?,?,?,?) ");
					$query->bind_param("ssss", $name, $email, $phone, $password);
					$query->execute();

					$_SESSION['message']="Registration Successful";
					$_SESSION['msg_type']="success"; 
					header("location: ../login.php");
				}
			}
			
		}
	}
?>