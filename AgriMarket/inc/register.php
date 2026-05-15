<?php 
	session_start();
	require_once 'connection.php';

	if(isset($_POST['signup'])){
		$firstname=$conn->real_escape_string($_POST['firstname']);
		$lastname=$conn->real_escape_string($_POST['lastname']);
		$email=$conn->real_escape_string($_POST['email']);
		$password=$conn->real_escape_string($_POST['password']);
		$repassword=$conn->real_escape_string($_POST['repassword']);

		if(preg_match('~[0-9]+~', $_POST['firstname'])){
			$_SESSION['error']= "Invalid first name";
		    header("location: ../registration.php");
			// validating phone number
		}elseif(preg_match('~[0-9]+~', $_POST['lastname'])){
			$_SESSION['error']= "Invalid last name";
		    header("location: ../registration.php");
			// validating phone number
		}elseif ($repassword!=$password) {
			$_SESSION['error']= "Password do not match";
		    header("location: ../registration.php");
		}else{
			//check if the email already exists
			$query=$conn->prepare("SELECT * FROM users WHERE email=?");
			$query->bind_param("s", $email);
			$query->execute();
			$result=$query->get_result();
			if($result->num_rows>0){
				$_SESSION['error']= "Email already taken";
			    header("location: ../signup.php");
			}else{
				$firstname=ucwords(strtolower($firstname)); 
				$lastname=ucwords(strtolower($lastname)); 
				$email=strtolower($email);
				$hasdPassword=password_hash($_POST['password'], PASSWORD_DEFAULT);

				$query=$conn->prepare("INSERT INTO users(firstname, lastname, email, password) VALUES(?,?,?,?) ");
				$query->bind_param("ssss", $firstname, $lastname, $email, $hasdPassword);
				$query->execute();

				#send email before value insertion
				$verify_link = "http://$_SERVER[HTTP_HOST]"."/try/profile.php";
				$sub="PROJECT WORK REGISTRATION";
				$msg="We wish to inform you that you have succesfully requested to join Agric marketing site where you can purchase all agricltural products at affordavle prices.Login your account, click on your email at the upper right corner to complete signup. \n\r".$verify_link;
				$_SESSION['verify']=$email;
				$rec=$mailUser;
				mail($email, $sub, $msg);
				$_SESSION['success']="Registration Successful".'<br>'."Login your email to continue";
				header('location: ../login.php');
			}
		}
	}

?>