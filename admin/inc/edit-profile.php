<?php  
	require_once 'connection.php';
	if(isset($_POST['save'])){
		
		$phone=$_SESSION['Adminphone'];
		$name=$_SESSION['Adminname'];
		$email=$_SESSION['Adminemail'];

		$newpassword=$conn->real_escape_string($_POST['newpassword']);
		$repassword=$conn->real_escape_string($_POST['repassword']);
		$oldpassword=$conn->real_escape_string($_POST['oldpassword']);

		#checking if the admin exixts
		$query=$conn->prepare("SELECT * FROM admin WHERE email=?");
		$query->bind_param("s", $email);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows==1){
			//validating form
			if(($newpassword!="" || $repassword!=""||$oldpassword!="") && $repassword!=$newpassword){
				$_SESSION['message']="Password do not match";
				$_SESSION['msg_type']="danger";
				header('location: ../index.php');
			}else if(strlen($repassword)<6){
				$_SESSION['message']="Pasword must be more than 5 characters";
				$_SESSION['msg_type']="danger";
				header('location: ../index.php');
			}else{

				$query=$conn->prepare("SELECT * FROM admin WHERE email=?");
				$query->bind_param("s", $email);
				$query->execute();
				$result=$query->get_result();
				if($result->num_rows>0){
					$row=$result->fetch_array();
					if(password_verify($_POST['oldpassword'], $row['password'])){
						#updating the password
						$psd=password_hash($newpassword, PASSWORD_DEFAULT);
						$query=$conn->prepare("UPDATE admin SET password=? WHERE email=?");
						$query->bind_param("ss", $psd, $email);
						$query->execute();
						$_SESSION['message']= "Information updated";
				   		$_SESSION['msg_type']="success"; 
						header('location: ../index.php');
					}else{
						$_SESSION['message']= "Invalid email or password!";
				   		$_SESSION['msg_type']="danger"; 
				   		header("location: ../index.php");
					}
				}
			}
		}else{
			$_SESSION['message']="Admin does not exist";
			$_SESSION['msg_type']="danger";
			header('location: ../index.php');
		}
		
	}





	if(isset($_GET['delete'])){
		$sql=$conn->prepare("DELETE FROM category WHERE id=?");
		$sql->bind_param("s", $_GET['delete']);
		$sql->execute();

		#deleting products under the deletd category
		$sql=$conn->prepare("DELETE FROM products WHERE category_id=?");
		$sql->bind_param("s", $_GET['delete']);
		$sql->execute();

		#all products that fall under this category in the user cart will be deleted

		$_SESSION['message']="Category deleted";
		$_SESSION['msg_type']="danger";
		header('location: ../category.php');

	}


	#deleting user
	 if(isset($_POST['deleteUser'])){
    	$id=$_SESSION['id'];
    	$query = $conn->prepare("DELETE FROM products WHERE id=?");
        $query->bind_param("s",  $id);
        $query->execute();
        $_SESSION['message']="Product deleted";
        $_SESSION['msg_type']="danger";
        header('location: ../products.php');
    }


    #updating transaction details
	if(isset($_POST['update'])){
		#performing checks
		$id=$_SESSION['viewId'];
		$date=$_SESSION['date'];
		$type=$_SESSION['type'];
		$tranid=$_SESSION['tranid'];
		$amount=$_SESSION['amount'];

		$query=$conn->prepare("SELECT * FROM transactions WHERE id=?");
		$query->bind_param("s", $id);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows>0){

			$query=$conn->prepare("UPDATE transactions SET trandate=?, type=?, tranid=?, amount=? WHERE id=?");
			$query->bind_param("sssss", $date, $type, $tranid, $amount, $id);
			$query->execute();
			$_SESSION['message']="Update successful";
			$_SESSION['msg_type']="success";
			header('location: ../index.php');
		}

	}


?>