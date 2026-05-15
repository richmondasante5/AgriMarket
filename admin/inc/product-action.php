<?php 

    require_once 'connection.php';
    if(isset($_GET['approve'])){
        //checking the availability of that product
        $query=$conn->prepare("SELECT * FROM products WHERE id=?");
        $query->bind_param("s", $_GET['approve']);
        $query->execute();
        $result=$query->get_result();
        if($result->num_rows==1){
            $row=$result->fetch_array();
            $status=$row['prostatus'];
            if($status==0){
                $newStatus=1;
                #updating the product status to approved
                $query=$conn->prepare("UPDATE products SET prostatus=? WHERE id=?");
                $query->bind_param("ss", $newStatus, $_GET['approve']);
                $query->execute();

                $_SESSION['message']="Product successfully approved";
                $_SESSION['msg_type']="success";
                header('location: ../index.php');
            }
        }
    }

//rejecting product during approval
    if(isset($_GET['rejectprod'])){
        //checking the availability of that product
        $query=$conn->prepare("SELECT * FROM products WHERE id=?");
        $query->bind_param("s", $_GET['rejectprod']);
        $query->execute();
        $result=$query->get_result();
        if($result->num_rows==1){
            $row=$result->fetch_array();
            $prodid=$row['id'];
            $productname=$row['name'];
            $date=$row['upload_date'];
            $userid=$row['userid'];

            #getting user mail
            $query=$conn->prepare("SELECT * FROM users WHERE id=?");
            $query->bind_param("s", $userid);
            $query->execute();
            $result=$query->get_result();
            if($result->num_rows==1){
                $row=$result->fetch_array();
                $email=$row['email'];

                #deleting the uploaded product
                $query=$conn->prepare("DELETE FROM products WHERE id=?");
                $query->bind_param("s", $_GET['rejectprod']);
                $query->execute();

                #send email and sms to the user
                $verify_link = "http://$_SERVER[HTTP_HOST]"."/try/profile.php";
                $sub="PRODUCT UPLOAD REJECT";
                $msg="We are sorry to inform you that your product ($productname), with product id ($prodid) uploaded on $date has been rejected after a sucessful review
                    Reason: It dosn't meet the criteria for our standard products. Contact us for further info . \n\r".$verify_link;

                mail($email, $sub, $msg);
                $_SESSION['message']="Product deleted from Upload";
                $_SESSION['msg_type']="danger";
                header('location: ../index.php');
            }
        }
    }

    if(isset($_GET['deleteProduct'])){
        //checking the availability of that product
        $query=$conn->prepare("SELECT * FROM products WHERE id=?");
        $query->bind_param("s", $_GET['deleteProduct']);
        $query->execute();
        $result=$query->get_result();
        if($result->num_rows==1){
            $row=$result->fetch_array();
            $query=$conn->prepare("DELETE FROM products WHERE id=?");
            $query->bind_param("s", $_GET['deleteProduct']);
            $query->execute();
            $_SESSION['message']="Product deleted";
            $_SESSION['msg_type']="danger";
            header('location: ../products.php');
           
        }
    }

    if(isset($_GET['deleteProduct'])){
        //checking the availability of that product
        $query=$conn->prepare("SELECT * FROM transactions WHERE id=?");
        $query->bind_param("s", $_GET['deleteProduct']);
        $query->execute();
        $result=$query->get_result();
        if($result->num_rows==1){
            $row=$result->fetch_array();
            $query=$conn->prepare("DELETE FROM transactions WHERE id=?");
            $query->bind_param("s", $_GET['deleteProduct']);
            $query->execute();
            $_SESSION['message']="Transaction deleted";
            $_SESSION['msg_type']="danger";
            header('location: ../index.php');
           
        }
    }
?>