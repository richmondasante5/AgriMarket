<?php  
	require_once 'connection.php';
	require_once 'verify.php';

	#if the button is clicked
	if(isset($_POST['save'])){
		#performing checks
		$admin=$_SESSION['Adminemail'];
		$trantype=$conn->real_escape_string($_POST['trantype']);
		$tranid=$conn->real_escape_string($_POST['tranid']);
		$amount=$conn->real_escape_string($_POST['amount']);
		$date=$conn->real_escape_string($_POST['date']);
		$tran_type=strtolower($trantype);
		#performing checks
		if($trantype=="Select transaction"){
			$_SESSION['message']="Select transaction type";
			$_SESSION['msg_type']="danger";
			header('location: ../index.php');
		}elseif(!is_numeric($amount)){
			$_SESSION['message']="Invalid amount";
			$_SESSION['msg_type']="danger";
			header('location: ../index.php');
		}else{
			#check if the transaction id already exist
			$query=$conn->prepare("SELECT * FROM transactions WHERE tranid=?");
			$query->bind_param("s", $tranid);
			$query->execute();
			$result=$query->get_result();
			if($result->num_rows>0){
				$_SESSION['message']="Transaction already exist";
				$_SESSION['msg_type']="danger";
				header('location: ../index.php');
			}else{
				#save tran data
				$query=$conn->prepare("INSERT INTO transactions(tranid, type, amount, trandate, admin) VALUES(?,?,?,?,?) ");
				$query->bind_param("sssss", $tranid, $tran_type, $amount, $date, $admin);
				$query->execute();
				$_SESSION['message']="Data saved successfuly";
				$_SESSION['msg_type']="success";
				header('location: ../index.php');
			}
		}
	}


	#deleting the transaction
	if(isset($_POST['delete'])){
		#performing checks
		$tranid=$conn->real_escape_string($_POST['tranid']);
		$query=$conn->prepare("SELECT * FROM transactions WHERE tranid=?");
		$query->bind_param("s", $tranid);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows>0){
			$query=$conn->prepare("DELETE FROM transactions WHERE tranid=?");
			$query->bind_param("s", $tranid);
			$query->execute();
			$_SESSION['message']="Transaction deleted";
			$_SESSION['msg_type']="danger";
			header('location: ../index.php');
		}else{
			$_SESSION['message']="Copy and paste ID in the field provided";
			$_SESSION['msg_type']="danger";
			header('location: ../index.php');
		}
		
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

