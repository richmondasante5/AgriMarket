<?php 
session_start();
    require_once 'connection.php';
    if(isset($_GET['delete-user'])){}
        $query = $conn->prepare("DELETE FROM users WHERE id=?");
        $query->bind_param("s",  $_GET['delete-user']);
        $query->execute();
        $_SESSION['message']="User deleted";
        $_SESSION['msg_type']="danger";
        header('location: users.php');


  #working user delete
        if(isset($_POST['delete'])){
        	$email=$_SESSION['useremail'];
        	$query = $conn->prepare("DELETE FROM users WHERE email=?");
	        $query->bind_param("s",  $email);
	        $query->execute();
	        $_SESSION['message']="User deleted";
	        $_SESSION['msg_type']="danger";
	        header('location: users.php');
        }
       

    ?>