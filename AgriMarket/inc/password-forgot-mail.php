<?php 
session_start();
require_once 'connection.php';
if(isset($_POST['sendmail'])){
	$usermail=$conn->real_escape_string($_POST['email']);
	$query=$conn->prepare("SELECT * FROM users WHERE email=?");
	$query->bind_param("s", $usermail);
	$query->execute();
	$result=$query->get_result();
	if($result->num_rows==1){
		sndToken();
		//mailalert();
		$_SESSION['success']='Login your email to continue ...';
		header('location: ../password_forgot.php');
	}else{
		$_SESSION['error']='Invalid email';
		header('location: ../password_forgot.php');
	}
}
?>


<?php 
function sndToken(){
	include 'connection.php';
	$data = array('fulldate'=>date('d-m-Y H:i:s'),'date'=>date('d'),'month'=>date('m'),
	'year'=>date('Y'),'hour'=>date('H'),'minute'=>date('i'),'second'=>date('s'));

	$mailUser=$conn->real_escape_string($_POST['email']);
	$token	=(random_int(10000, 99999));//
	$_SESSION['code']=$token;
	$expires=date('U')+1800;
	$sentHr=date('H');
	$sentMin=date('i');
	$sentDate=date('Y')."-".date('m')."-".date('d');
	$query=$conn->prepare("SELECT * FROM psdreset WHERE psdResetMail=?");
	$query->bind_param("s", $mailUser);
	$query->execute();
	$result=$query->get_result();
	if($result->num_rows==1){
		$query=$conn->prepare("DELETE FROM psdreset WHERE psdResetMail=?");
		$query->bind_param("s", $mailUser);
		$query->execute();
		$hashedToken=password_hash($token, PASSWORD_DEFAULT);
		$query=$conn->prepare("INSERT INTO psdreset(psdResetMail, psdResetToken, psdExpires, senthr, sntmin, sentdate) VALUES(?,?,?,?,?,?)");
		$query->bind_param("ssssss", $mailUser, $hashedToken, $expires, $sentHr, $sentMin, $sentDate);
		$query->execute();
	}else{
		$hashedToken=password_hash($token, PASSWORD_DEFAULT);
		$query=$conn->prepare("INSERT INTO psdreset(psdResetMail, psdResetToken, psdExpires, senthr, sntmin, sentdate) VALUES(?,?,?,?,?,?)");
		$query->bind_param("ssssss", $mailUser, $hashedToken, $expires, $sentHr, $sentMin, $sentDate);
		$query->execute();
	}

	#sending mail to the user
	include "connection.php";
	$mailUser=$conn->real_escape_string($_POST['email']);
	$actual_link = "http://$_SERVER[HTTP_HOST]"."/try/password-reset.php";
	$sub="PROJECT PASSWORD RESET";
	$msg="\n\r"."We have received a password reset-request from you.\n\rClick this link to continue password reset at.".$actual_link." Discard the message if you are have not requested a password change. \n\r Your Reset Code is: ".$token ;
	$msg = wordwrap($msg,70);
	$rec=$mailUser;
	mail($mailUser, $sub, $msg);
	$_SESSION['resetMail']=$mailUser;
	//$_SESSION['code']=$token;
	$conn->close();
}
?>