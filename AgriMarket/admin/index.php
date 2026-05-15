<?php 
  //getting date and time
include 'inc/connection.php';

 //getting total uploads for today
    $status=0;
    $query=$conn->prepare("SELECT * FROM admin");
    $query->execute();
    $result=$query->get_result();
    if($result->num_rows>0){
        $row=$result->fetch_array();
       
    }else{
        header('location: signup.php');
    }



  $year=date('Y');
  $month=date('m');
  $day=date('d');
 
  //geting the time
  $hour=date('H');
  $min=date('i');
  $sec=date('s');

    //date and time
    $uploadDate="$year-$month-$day";
    $tranTime="$hour:$min:$sec";

    $_SESSION['date']=$uploadDate;


    //getting total uploads for today
    $status=0;
    $query=$conn->prepare("SELECT COUNT(id) FROM products WHERE prostatus=? AND upload_date=?");
    $query->bind_param("ss", $status, $uploadDate);
    $query->execute();
    $result=$query->get_result();
    if($result->num_rows>0){
        $row=$result->fetch_array();
        $_SESSION['uploadToday']=$row['COUNT(id)'];
    }
    
    //getting total uploads for today
    $approved=1;
    $query=$conn->prepare("SELECT COUNT(id) FROM products WHERE prostatus=? AND upload_date=?");
    $query->bind_param("ss", $approved, $uploadDate);
    $query->execute();
    $result=$query->get_result();
    if($result->num_rows>0){
        $row=$result->fetch_array();
        $_SESSION['approvedToday']=$row['COUNT(id)'];
    }

    //getting overall approved products
    $overall=1;
    $query=$conn->prepare("SELECT COUNT(id) FROM products WHERE prostatus=?");
    $query->bind_param("s", $overall);
    $query->execute();
    $result=$query->get_result();
    if($result->num_rows>0){
        $row=$result->fetch_array();
        $_SESSION['all']=$row['COUNT(id)'];
    }

    //getting total pending uploads
    $pending=0;
    $query=$conn->prepare("SELECT COUNT(id) FROM products WHERE prostatus=?");
    $query->bind_param("s", $pending);
    $query->execute();
    $result=$query->get_result();
    if($result->num_rows>0){
        $row=$result->fetch_array();
        $_SESSION['pend']=$row['COUNT(id)'];
    }

    #getting the admin
    $query=$conn->prepare("SELECT COUNT(id) FROM admin");
    $query->execute();
    $result=$query->get_result();
    if($result->num_rows==1){
        $row=$result->fetch_array();
        $count=$row['COUNT(id)'];
       
       if($count>0){
             #getting the admin
        $query=$conn->prepare("SELECT * FROM admin WHERE id=1");
        $query->execute();
        $result=$query->get_result();
        if($result->num_rows==1){
            $row=$result->fetch_array();
            $_SESSION['Adminemail']=$row['email'];
            $_SESSION['Adminname']=$row['name'];
            $_SESSION['Adminphone']=$row['phone'];
        }else{
            $_SESSION['Adminemail']="example@admin.com";
            $_SESSION['Adminname']="Admin name...";
            $_SESSION['Adminphone']="(eg. 02XXXXXXXXXX)";
        }
    }
}





?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

     <title>Agri-market-official-website</title>
     <link rel="icon" type="img/*" href="img/logo.jpg">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body id="page-top">
    
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Products & Category
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Products & Categories</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products/Category:</h6>
                        <a class="collapse-item" href="products.php">Products</a>
                        <a class="collapse-item" href="Category.php">Categories</a>
                    </div>
                </div>
            </li>

           

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="users.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                  <div class="bg-success" style="background: #31993E; font-family: calibri;"><h5>
                    <a class="nav-link" href="../index.php" target="blank"><i class="text-white" style="font-style: normal;"><img class="mr-2" src="../images/logo.jpg" height="40" width="40" sy>AgriMarket</i></a>
                        </h5>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                      
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1" style="font-family: calibri;">
                          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           
                             <button class="btn-success btn-sm btn-flat mr-1 mt-4">Uploaded Products</button><h2><i class="fa fa-product-" title="Uploaded products" style="color: #22C42E;"></i></h2>
                            <!-- Counter - Alerts -->
                            <?php 
                              $productstatus=0;
                              
                              $query = $conn->prepare("SELECT * FROM products WHERE prostatus=?");
                              $query->bind_param("s",  $productstatus);
                              $query->execute();
                              $query->store_result();

                              $rows = $query->num_rows;

                            ?>
                          <h2 class="mb-4"><span class="badge badge-danger badge-counter"><?php echo $rows; ?></span></h2>
                          </a>
                          <!-- Dropdown - Alerts -->
                          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="height: 400px; width: 100%">
                            <h6 class="dropdown-header bg-success">
                             <center> Uploaded products</center>
                            </h6>
                             
                            <?php  
                            ?>

                            <div class="row justify-content-" style="width: 350px; overflow: auto; height: 300px; font-size: 10px;">
                              <div class="container">

                                <?php
                                    if($rows<1){ ?>
                                        <h3>No Pending Upload</h3> <?php
                                    }else{ ?>
                                        <!--show the table-->
                                        <table class="table table-hover" id="notifyTbl" style="font-size: 12px; text-transform: capitalize; overflow: auto ; margin-bottom: 100px;" >

                                            <thead>
                                                <?php 
                                                    $productstatus=0;
                                                    $result= $mysqli->query("SELECT * FROM products WHERE prostatus=0") or
                                                    die($mysqli->error());
                                                ?>
                                              <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th colspan="2">Actions</th>
                                              </tr>
                                            </thead>
                                            <?php while($row=$result->fetch_assoc()): ?>
                                            <tbody>
                                              <tr>
                                                <td style="overflow: hidden;">
                                                    <?php echo substr($row['name'], 0, 15)." "; ?>
                                                </td>
                                                <td><?php echo "GHS".number_format($row['price'], 2); ?></td>
                                                <td colspan="2">
                                                  <a  href="inc/view-upload.php? view=<?php echo($row['id']); ?>"
                                                      class="btn btn-success" style="font-size: 12px; font-weight: bold;">View</a>
                                                </td>
                                              </tr>
                                              <?php endwhile; ?>
                                            </tbody>
                                        </table>

                                    <?php
                                        }
                                        ?>

                                  </div>
                                </div>

                          </div>
                        </li>


                        <!-- Nav Item - Messages -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php 

                                echo $_SESSION['Adminemail'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addCategoryModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                 <!-- End of Topbar -->
                <div class="card" style="width: 50%;">
                    <h6> <?php if(isset($_SESSION['message'])): ?>
                            <div align="center" class="alert alert-<?=$_SESSION['msg_type']?>">
                          <?php 
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            session_destroy();
                            ?>
                            </div>
                            <?php endif; ?>
                        </h6>
                </div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Today's Uploads</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $_SESSION['uploadToday']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <!--i class="fas fa-calendar fa-2x text-gray-300"></i-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Today's Approved Products</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $_SESSION['approvedToday']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!--i class="fas fa-dollar-sign fa-2x text-gray-300"></i-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Products
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $_SESSION['all']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!--i class="fas fa-clipboard-list fa-2x text-gray-300"></i-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Pending Uploads</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $_SESSION['pend']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!--i class="fas fa-comments fa-2x text-gray-300"></i-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <?php  
                                #counting the total transactions
                            $query=$conn->prepare("SELECT COUNT(id) FROM transactions");
                            $query->execute();
                            $result=$query->get_result();
                            if($result->num_rows>0){
                                $row=$result->fetch_array();
                                $totrow=$row['COUNT(id)'];
                                if($totrow<=0){ ?>
                                    <h3>No transaction data to show</h3>
                                    <?php 
                                }else{
                                    #display table here
                                    ?>

                                    <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body" style="height: ">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <?php 
                                                      $productstatus=0;
                                                      $result= $mysqli->query("SELECT * FROM transactions ORDER BY tranid DESC") or
                                                      die($mysqli->error());
                                                    ?>
                                                    <tr>
                                                        <th>Transaction Type</th>
                                                        <th>Transaction ID</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th rowspan="2">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Transaction Type</th>
                                                        <th>Transaction ID</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th colspan="2">Actions</th>
                                                    </tr>
                                                </tfoot>
                                                <?php while($row=$result->fetch_assoc()): ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $row['type']; ?></td>
                                                        <td><?php echo $row['tranid']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['trandate']; ?></td>
                                                        <td>
                                                           <div align="center" style="font-size: 12px;">

                                                                <a href="? view=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm view btn-flat">Veiw</a>

                                                                <?php $_SESSION['delId']=$row['id']; ?>
                                                                <a href="" type="button" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#exampleModalReject">Delete</i></a>
                                                                <!-- Button trigger modal -->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <?php endwhile; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                }
                            }


                            ?>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <a class="btn btn-primary btn-sm btn-flat" href="#" data-toggle="modal" data-target="#transactionModal">
                                        <i class="fa fa-plus mr-2"></i>New Transaction
                                    </a>
                                    <!--h6 class="m-0 font-weight-bold text-success">Revenue Sources</h6-->
                                   
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <a class="btn btn-primary btn-sm btn-flat" href="#" data-toggle="modal" data-target="#tranSummary">
                                        <i class="fa fa-eye mr-2"></i>Transaction Summary
                                    </a>
                                </div>
                                    <div style="margin-left: 20px;">
                                    <?php  
                                       #getting the one who initiated the transaction
                                        if(isset($_GET['view'])){
                                            $_SESSION['viewId'] =$_GET['view'];
                                            $query=$conn->prepare("SELECT * FROM transactions WHERE id=?");
                                            $query->bind_param("s", $_GET['view']);
                                            $query->execute();
                                            $result=$query->get_result();
                                            if($result->num_rows>0){
                                                $row=$result->fetch_array();
                                                $tranadmin=$row['admin'];
                                                $_SESSION['tran_id'] =$row['id'];

                                                $_SESSION['date'] =$row['trandate'];
                                                $_SESSION['tranid'] =$row['tranid'];
                                                $_SESSION['amount'] =$row['amount'];
                                                $_SESSION['type'] =$row['type'];

                                                #getting full admin details
                                                $query=$conn->prepare("SELECT * FROM admin WHERE email=?");
                                                $query->bind_param("s", $tranadmin);
                                                $query->execute();
                                                $result=$query->get_result();
                                                if($result->num_rows>0){
                                                    $row=$result->fetch_array();
                                                    $_SESSION['adminname'] =$row['name'];
                                                    $_SESSION['adminphone'] =$row['phone'];
                                                    $_SESSION['adminmail'] =$row['email'];
                                                    ?>

                                                    <p style="font-weight: bold;">Initiated by:</p>
                                                    <p>Name:<?php echo " ". $_SESSION['adminname'] ?></p>
                                                    <p>Phone:<?php echo " ". $_SESSION['adminphone'] ?></p>
                                                    <p>Email:<?php echo " ". $_SESSION['adminmail'] ?></p>
                                                    <hr style="border: 1px solid;">


                                                    <a href="" type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#tranedit">Edit</i></a>
                                                        <!-- Button trigger modal -->
                                                <?php
                                                }
                                            }
                                        }
                                    ?>
                                        
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Agri-Market 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!--Modal for tran edit-->

   <!-- add transaction modal----->
     <div class="modal fade" id="tranedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div align="center">
                        <p align="center" class="modal-title bg-primary text-white" id="exampleModalLabel">Edit Transaction</p>
                        <?php echo $_SESSION['viewId']; ?>
                    </div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="user" action="inc/edit-transaction.php" method="POST">
                        <div class="form-group">
                            <label>Transaction Date:</label><br>
                            <input type="date" class="form-control form-control" 
                                id="exampleInputPassword" name="date" style="height: 35px;" min="2021-09-01" max="<?php echo $_SESSION['date']; ?>" data-date="" data-date-format="yyy-MMMM-DD" value="<?php echo $_SESSION['date']; ?>" />
                        </div>

                        <div class="form-group">
                            <label>Transaction Type:</label><br>
                           <select class="form-control" name="trantype" id="exampleFormControlSelect1" style="height: 40px;">
                                <option><?php echo $_SESSION['type']; ?></option>
                                <option>Payment</option>
                                <option>Received</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Transaction ID:</label><br>
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="tranid" style="height: 35px;" required value="<?php echo $_SESSION['tranid']; ?>" />
                        </div>

                        <div class="form-group">
                            <label>Amount:</label><br>
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="amount" style="height: 35px;" required value="<?php echo $_SESSION['amount']; ?>" />
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm btn-flat" type="button" data-dismiss="modal">Cancel
                            </button>
                           <button class="btn btn-primary btn-sm btn-flat" type="submit" name="update">
                              Update <i class="fas fa-save ml-auto"></i>
                           </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





     <!-- Modal for tran delete -->
    <div class="modal fade" id="exampleModalReject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-warning" id="exampleModalLabel">Delete Transaction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true text-danger">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <p class="text-danger">Do you want to delete Transaction?</p>
          </div>
          <form class="user" action="inc/add-transaction.php" method="POST">

            <div class="form-group" style="margin: 0px 15px;">
                <label>Transaction ID:</label><br>
                <input type="text" class="form-control form-control"
                    id="exampleInputPassword" name="tranid" style="height: 35px;" required placeholder="Enter Transaction ID to confirm delete" />
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-sm btn-flat" type="button" data-dismiss="modal">Cancel
                </button>
               <button class="btn btn-primary btn-sm btn-flat" type="submit" name="delete">
                  Delete <i class="fas fa-save ml-auto"></i>
               </button>
            </div>
        </form>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div><!-- end of rejection modal-->



    <!-- add transaction modal----->
     <div class="modal fade" id="tranSummary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div align="center">
                        <p align="center" class="modal-title bg-primary text-white" id="exampleModalLabel">Transaction Summary</p>
                    </div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php  
                       # getting total amount received today
                        $type="receivables";
                        $query=$conn->prepare("SELECT SUM(amount) FROM transactions WHERE trandate=? AND type=?");
                        $query->bind_param("ss", $_SESSION['date'], $type);
                        $query->execute();
                        $result=$query->get_result();
                        if($result->num_rows>0){
                            $row=$result->fetch_array();
                            #amount received for today
                            $_SESSION['received']=$row['SUM(amount)'];
                        }


                        # getting total amount received
                        $type="receivables";
                        $query=$conn->prepare("SELECT SUM(amount) FROM transactions WHERE type=?");
                        $query->bind_param("s", $type);
                        $query->execute();
                        $result=$query->get_result();
                        if($result->num_rows>0){
                            $row=$result->fetch_array();
                            #amount received for today
                            $_SESSION['totalRec']=$row['SUM(amount)'];
                        }


                        #getting total amount paid today
                        $paytype="payment";
                        $query=$conn->prepare("SELECT SUM(amount) FROM transactions WHERE trandate=? AND type=?");
                        $query->bind_param("ss", $_SESSION['date'], $paytype);
                        $query->execute();
                        $result=$query->get_result();
                        if($result->num_rows>0){
                            $row=$result->fetch_array();
                            #amount received for today
                            $_SESSION['payment']=$row['SUM(amount)'];
                        }


                        #getting total amount paid today
                        $paytype="payment";
                        $query=$conn->prepare("SELECT SUM(amount) FROM transactions WHERE type=?");
                        $query->bind_param("s", $paytype);
                        $query->execute();
                        $result=$query->get_result();
                        if($result->num_rows>0){
                            $row=$result->fetch_array();
                            #amount received for today
                            $_SESSION['totalPay']=$row['SUM(amount)'];
                        }

                         #getting total amount paid today
                        $paytype="other";
                        $query=$conn->prepare("SELECT SUM(amount) FROM transactions WHERE trandate=? AND type=?");
                        $query->bind_param("ss", $_SESSION['date'], $paytype);
                        $query->execute();
                        $result=$query->get_result();
                        if($result->num_rows>0){
                            $row=$result->fetch_array();
                            #amount received for today
                            $_SESSION['other']=$row['SUM(amount)'];
                        }


                        #getting total amount paid today
                        $paytype="other";
                        $query=$conn->prepare("SELECT SUM(amount) FROM transactions WHERE type=?");
                        $query->bind_param("s", $paytype);
                        $query->execute();
                        $result=$query->get_result();
                        if($result->num_rows>0){
                            $row=$result->fetch_array();
                            #amount received for today
                            $_SESSION['totalOther']=$row['SUM(amount)'];
                        }

                    ?>
                    <div style="font-family: calibri;">
                        <!-- for amount receivable-->
                        <p>Amount Received Today:
                            <?php  
                                if($_SESSION['received']>0){
                                    echo " GHS".number_format($_SESSION['received'], 2);
                                }else{
                                    echo " GHS0.00";
                                }
                            ?>
                        </p>

                        <!-- for amount paid-->
                        <p>Payment Today:
                            <?php  
                                if($_SESSION['payment']>0){
                                    echo " GHS".number_format($_SESSION['payment'], 2);
                                }else{
                                    echo " GHS0.00";
                                }
                            ?>
                        </p>
                        <p>Other Payments:
                            <?php  
                                if($_SESSION['other']>0){
                                    echo " GHS".number_format($_SESSION['other'], 2);
                                }else{
                                    echo " GHS0.00";
                                }
                            ?>
                        </p>
                        <hr>
                    </div>

                    <!-- for amount paid-->
                    <p>Total Amount Received:
                        <?php  
                            if($_SESSION['totalRec']>0){
                                echo " GHS".number_format($_SESSION['totalRec'], 2);
                            }else{
                                echo " GHS0.00";
                            }
                        ?>
                    </p>

                    <!-- for amount paid-->
                    <p>Total Payment:
                        <?php  
                            if($_SESSION['totalPay']>0){
                                echo " GHS".number_format($_SESSION['totalPay'], 2);
                            }else{
                                echo " GHS0.00";
                            }
                        ?>
                    </p>

                     <!-- for amount paid-->
                    <p>Total Other Pay:
                        <?php  
                            if($_SESSION['totalOther']>0){
                                echo " GHS".number_format($_SESSION['totalOther'], 2);
                            }else{
                                echo " GHS0.00";
                            }
                        ?>
                    </p>

                </div>
            </div>
        </div>
    </div>



    <!-- add transaction modal----->
     <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div align="center">
                        <p align="center" class="modal-title bg-primary text-white" id="exampleModalLabel">New Transaction</p>
                    </div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="user" action="inc/add-transaction.php" method="POST">

                        <div class="form-group">
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="admin" style="height: 35px;" hidden="true" value="<?php echo $_SESSION['Adminemail']; ?>" />
                        </div>

                        <div class="form-group">
                            <label>Transaction Date:</label><br>
                            <input type="date" class="form-control form-control"
                                id="exampleInputPassword" name="date" style="height: 35px;"  required min="2021-09-01" max="<?php echo $_SESSION['date'];?>" />
                        </div>

                        <div class="form-group">
                            <label>Transaction Type:</label><br>
                           <select class="form-control" name="trantype" id="exampleFormControlSelect1" style="height: 40px;">
                                <option>Select transaction</option>
                                <option>Payment</option>
                                <option>Received</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Transaction ID:</label><br>
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="tranid" style="height: 35px;" required />
                        </div>

                        <div class="form-group">
                            <label>Amount:</label><br>
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="amount" style="height: 35px;" required />
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger btn-sm btn-flat" type="button" data-dismiss="modal">Cancel
                            </button>
                           <button class="btn btn-primary btn-sm btn-flat" type="submit" name="save">
                              Save <i class="fas fa-save ml-auto"></i>
                           </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- User details modal-->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div align="center">
                        <h6 align="center" class="modal-title bg-primary text-white" id="exampleModalLabel">Edit Profile</h6>
                    </div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="user" action="inc/edit-profile.php" method="POST">

                        <div class="form-group">
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="name" style="height: 35px;" value="<?php echo $_SESSION['Adminname']; ?>"disabled  />
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="email" style="height: 35px;" value="<?php echo $_SESSION['Adminemail']; ?>"disabled />
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="phone" style="height: 35px;" value="<?php echo $_SESSION['Adminphone']; ?>"disabled />
                        </div>

                         <div class="form-group">
                            <input type="password" class="form-control form-control"
                                id="exampleInputPassword" name="newpassword" placeholder="New Password" style="height: 35px;"required/>
                        </div>
                         <div class="form-group">
                            <input type="password" class="form-control form-control"
                                id="exampleInputPassword" name="repassword" placeholder="Repeat Password" style="height: 35px;"required/>
                        </div>
                         <div class="form-group">
                            <input type="password" class="form-control form-control"
                                id="exampleInputPassword" name="oldpassword" placeholder="Old Password" style="height: 35px;"required/>
                        </div>
                        

                        <div class="modal-footer">
                            <button class="btn btn-danger sm-flat" type="button" data-dismiss="modal">Cancel
                            </button>
                           <input type="submit" name="save" class="btn btn-primary sm-flat" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>