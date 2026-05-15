<?php 
    session_start();

    $servername="localhost";
    $username="root";
    $password="";
    $database="ecomm";

    $conn=new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: ".$conn->$connect_error);
    }else{
        //echo "Connected to database";
    }
    $mysqli= new mysqli($servername, $username, $password, $database) or die(mysqli_error($mysqli));

    include 'verify.php';

    if(isset($_SESSION['productId'])){
        $query=$conn->prepare("SELECT * FROM products WHERE id=?");
        $query->bind_param("s", $_SESSION['productId']);
        $query->execute();
        $result=$query->get_result();
        if($result->num_rows==1){
            $row=$result->fetch_array();
            $_SESSION['productId']=$row['id'];
            $_SESSION['userUploadId']=$row['userid'];
            $_SESSION['productname']=$row['name'];
            $_SESSION['description']=$row['description'];
            $_SESSION['catid']=$row['category_id'];
            $_SESSION['slug']=$row['slug'];
            $_SESSION['price']=$row['price'];
            $_SESSION['photo']=$row['photo'];
            $_SESSION['proDate']=$row['upload_date'];

                //getting the product category
            $query=$conn->prepare("SELECT * FROM category WHERE id=?");
            $query->bind_param("s", $_SESSION['catid']);
            $query->execute();
            $result=$query->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array();
                $_SESSION['catname']=$row['name'];
                $_SESSION['catslug']=$row['cat_slug'];
            }
                //getting the product uploader
            $query=$conn->prepare("SELECT * FROM users WHERE id=?");
            $query->bind_param("s", $_SESSION['userUploadId']);
            $query->execute();
            $result=$query->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array();
                $_SESSION['user_email']=$row['email'];
                $_SESSION['uplUser']=$row['firstname']. " ". $row['lastname'];
                $_SESSION['uplPhone']=$row['contact_info'];
                $_SESSION['uplAddress']=$row['address'];
            }
        }
        
    }

?>