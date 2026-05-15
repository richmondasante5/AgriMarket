<?php 
	session_start();
	require_once 'connection.php';

	if(isset($_POST['submit'])){
		$userId=$_SESSION['user'];
		$prodname=$conn->real_escape_string($_POST['prodname']);
		$description=$conn->real_escape_string($_POST['description']);
		$price=$conn->real_escape_string($_POST['price']);
		$category=$conn->real_escape_string($_POST['category']);
		$defCat="Select category";

		//check user
		$query=$conn->prepare("SELECT status FROM users WHERE id=?");
		$query->bind_param("s", $userId);
      	$query->execute();
     	$result=$query->get_result();
       	if($result->num_rows==1){
       		$row=$result->fetch_array();
       		$status=$row['status'];
       		if($status!="1"){
       			$_SESSION['error']="Complete your info in profile to continue".'<br>'."Your account is not activated" ;
				header('location: ../product_upload.php');
       		}else{
       			#do the other operations

       			if(strlen($prodname)<5){
					$_SESSION['error']="Product name too short";
				header('location: ../product_upload.php');
				}else if(preg_match('~[0-9]+~', $description)){
					$_SESSION['error']="Details should not cotain digits";
					header('location: ../product_upload.php');
				}else if(strlen($description)<20){
					$_SESSION['error']="Product description must be more than 20 characters";
					header('location: ../product_upload.php');
				}else if(!strpos($description, ' ')){
					$_SESSION['error']="Space your details well";
					header('location: ../product_upload.php');
				}else if($category==$defCat){
					$_SESSION['error']="Select product category";
					header('location: ../product_upload.php');
				}elseif(!is_numeric($price)){
					$_SESSION['error']="Invalid amount";
					header('location: ../product_upload.php');
				}else{

					//getting the category ID
					$query=$conn->prepare("SELECT * FROM category WHERE name=?");
					$query->bind_param("s", $category);
	              	$query->execute();
		         	$result=$query->get_result();
		            $row=$result->fetch_array();

		            $categoryId=$row['id'];
		            $categoryName=$row['name'];

		            //getting the category ID
					$query=$conn->prepare("SELECT * FROM category WHERE id=? AND name=?");
					$query->bind_param("ss", $categoryId, $categoryName);
	              	$query->execute();
		         	$result=$query->get_result();
		            $row=$result->fetch_array();

		            $categoryId=$row['id'];

		            $slugData=strtolower($prodname);


	         		$imageCount=count($_FILES['image']['name']);
					for($i=0; $i<$imageCount; $i++){
						$imageNAME=$_FILES['image']['name'][$i];
						$imageTemName=$_FILES['image']['tmp_name'][$i];
						$targetPath="../uploads/". $imageNAME;

						//check if the image already exist in the system
						$query=$conn->prepare("SELECT * FROM products WHERE photo=? AND prostatus=?");
						$query->bind_param("ss", $imageNAME, $proStat);
		              	$query->execute();
			         	$result=$query->get_result();
			         	if($result->num_rows>0){
			         		$_SESSION['error']="Product already exist";
							header('location: ../product_upload.php');
			         	}else{
			         		//checking if the product exist in the upload table
			         		//check if the image already exist in the system
			         		$proStat=0;
							$query=$conn->prepare("SELECT * FROM products WHERE photo=?");
							$query->bind_param("s", $imageNAME);
			              	$query->execute();
				         	$result=$query->get_result();
				         	if($result->num_rows>0){
				         		$_SESSION['error']="Product already exist";
				         		header('location: ../product_upload.php');
			         		}else{
				         		$category_id;
				         		if(move_uploaded_file($imageTemName, $targetPath)){
									$query=$conn->prepare("INSERT INTO products(userid, category_id, name, description, slug, price, photo) VALUES(?,?,?,?,?,?,?)");
									$query->bind_param("sssssss", $userId, $categoryId, $prodname, $description, $slugData, $price, $imageNAME);
									$query->execute();
									$_SESSION['success']="Product uploaded: Wait for approval";
									header('location: ../product_upload.php');	
								}
							}
						}
		         	}
					
				}


       		}//end 
       	}
	}

?>