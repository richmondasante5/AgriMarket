<?php  
	require_once 'connection.php';
	if(isset($_POST['savecat'])){
		$catname=$conn->real_escape_string($_POST['catname']);

		$category=ucwords(strtolower($catname)); 
		$cat_slug=strtolower($category);
		#echo "Category: ".$category;
		#echo "SLUG: ".$cat_slug;

		$query=$conn->prepare("SELECT * FROM category WHERE name=?");
		$query->bind_param("s", $category);
		$query->execute();
		$result=$query->get_result();
		if($result->num_rows>0){
			$_SESSION['message']="Category name exists";
			$_SESSION['msg_type']="danger";
			header('location: ../category.php');
		}else{
				
			$query=$conn->prepare("INSERT INTO category(name, cat_slug) VALUES(?,?)");
			$query->bind_param("ss", $category, $cat_slug);
			$query->execute();
			$_SESSION['message']="Category added";
			$_SESSION['msg_type']="success";
			header('location: ../category.php');
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
?>