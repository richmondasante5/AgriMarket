<?php 
session_start();
require_once 'connection.php';
$data = array('fulldate'=>date('d-m-Y H:i:s'),'date'=>date('d'),'month'=>date('m'),
	'year'=>date('Y'),'hour'=>date('H'),'minute'=>date('i'),'second'=>date('s'));
$sentDate=date('Y')."-".date('m')."-".date('d');
$today=$sentDate;#date for the present time of the reset
$hrToday=date('H');#present hour during reset
$minToday=date('i');#present min during reset

if(isset($_POST['reset'])){
	$email=$_SESSION['resetMail'];
	$resetCode=$conn->real_escape_string($_POST['reset-code']);
	$password=$conn->real_escape_string($_POST['password']);
	$repassword=$conn->real_escape_string($_POST['repassword']);
	$uname=md5($username);
	if(strlen($_POST['password'])<6){
		$_SESSION['error']='Password must be at least 6 characters';
		header('location: ../password-reset.php');
	}elseif($repassword!=$password){
		$_SESSION['error']='Password do not match!';
		header('location: ../password-reset.php');
	}else{
		#getting the username
		$query=$conn->prepare("SELECT * FROM users WHERE email=?");
		$query->bind_param("s", $_SESSION['resetMail']);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows==1){
			$row=$result->fetch_array();
			#check if user has a pending psd change request
			$dbusermail=$row['email'];
			$query=$conn->prepare("SELECT * FROM psdreset WHERE psdResetMail=?");
			$query->bind_param("s", $dbusermail);
			$query->execute();
			$result=$query->get_result();
			if($result->num_rows==1){
				$row=$result->fetch_array();
				if(password_verify($_SESSION['code'], $row['psdResetToken'])){
					#check the time for expiry
					$dateSnt=$row['sentdate'];#db date when the request was received from use
					$hrSnt=$row['senthr'];#db date hour the request was received from use
					$minSnt=$row['sntmin'];#db minute when the request was received from use
					$minElapsed=$minToday-$minSnt;

					#can do the actual execution here
					if(!empty($dbusermail)){
						if($today!=$dateSnt){
							$_SESSION['error']='Reset Code has Expired!';
							header('location: ../password-reset.php');
						}else if($minElapsed<0 || $minElapsed>5){
							$_SESSION['error']='Reset Code has Expired!';
							header('location: ../password-reset.php');
						}else{
							#updating the password
							$psd=password_hash($password, PASSWORD_DEFAULT);
							$query=$conn->prepare("UPDATE users SET password=? WHERE email=?");
							$query->bind_param("ss", $psd, $dbusermail);
							$query->execute();
							
							#deleting request from pdreset tbl
							$query=$conn->prepare("DELETE FROM psdreset WHERE psdResetMail=?");
							$query->bind_param("s", $dbusermail);
							$query->execute();
							$_SESSION['success']='Password Reset Successful';
							header('location: ../login.php');
						}

					}
				}else{
					$_SESSION['error']='Invalid Password Reset Code';
					header('location: ../password-reset.php');
				}
				#do coding here
			}else{
				$_SESSION['error']='You have no pending password-reset request';
				header('location: ../password-reset.php');
			}
		}else{
			$_SESSION['error']='Invalid Email account!';
			header('location: ../password-reset.php');
		}	
	}
}