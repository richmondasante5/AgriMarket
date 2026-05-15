<?php  
	//session_start();
	require_once 'connection.php';
	if (isset($_GET['view'])) {
		//header('location: ../index.php');
		$uploadId=$_GET['view'];

		//getting product detail
		$query=$conn->prepare("SELECT * FROM products WHERE id=?");
        $query->bind_param("s", $uploadId);
        $query->execute();
        $result=$query->get_result();
        if($result->num_rows==1){
            $row=$result->fetch_array();
          $_SESSION['productId']=$row['id'];
          header('location: ../product-view.php');
           
        }
	}

 // if(isset($_SESSION['']))
?>