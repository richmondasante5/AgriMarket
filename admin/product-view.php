<?php  
include 'inc/connection.php';
//require_once 'inc/verify.php';

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

     <title>Agric-marketing-official-website</title>
     <link rel="icon" type="img/*" href="img/logo.jpg">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </style>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
   <script>tinymce.init({ selector:'textarea' });</script>

  <style>
    * {box-sizing: border-box;}

    .img-magnifier-container {
      position:relative;
    }

    .img-magnifier-glass {
      position: absolute;
      border: 3px solid #000;
      border-radius: 50%;
      cursor: none;
      /*Set the size of the magnifier glass:*/
      width: 100px;
      height: 100px;
    }
  </style>
  <script>
    function magnify(imgID, zoom){
      var img, glass, w, h, bw;
      img = document.getElementById(imgID);
      /*create magnifier glass:*/
      glass = document.createElement("DIV");
      glass.setAttribute("class", "img-magnifier-glass");
      /*insert magnifier glass:*/
      img.parentElement.insertBefore(glass, img);
      /*set background properties for the magnifier glass:*/
      glass.style.backgroundImage = "url('" + img.src + "')";
      glass.style.backgroundRepeat = "no-repeat";
      glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
      bw = 3;
      w = glass.offsetWidth / 2;
      h = glass.offsetHeight / 2;
      /*execute a function when someone moves the magnifier glass over the image:*/
      glass.addEventListener("mousemove", moveMagnifier);
      img.addEventListener("mousemove", moveMagnifier);
      /*and also for touch screens:*/
      glass.addEventListener("touchmove", moveMagnifier);
      img.addEventListener("touchmove", moveMagnifier);
      function moveMagnifier(e){
        var pos, x, y;
        /*prevent any other actions that may occur when moving over the image*/
        e.preventDefault();
        /*get the cursor's x and y positions:*/
        pos = getCursorPos(e);
        x = pos.x;
        y = pos.y;
        /*prevent the magnifier glass from being positioned outside the image:*/
        if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
        if (x < w / zoom) {x = w / zoom;}
        if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
        if (y < h / zoom) {y = h / zoom;}
        /*set the position of the magnifier glass:*/
        glass.style.left = (x - w) + "px";
        glass.style.top = (y - h) + "px";
        /*display what the magnifier glass "sees":*/
        glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
      }
      function getCursorPos(e) {
        var a, x = 0, y = 0;
        e = e || window.event;
        /*get the x and y positions of the image:*/
        a = img.getBoundingClientRect();
        /*calculate the cursor's x and y coordinates, relative to the image:*/
        x = e.pageX - a.left;
        y = e.pageY - a.top;
        /*consider any page scrolling:*/
        x = x - window.pageXOffset;
        y = y - window.pageYOffset;
        return {x : x, y : y};
      }
    }
  </script>
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
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
          Products & Services
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
              aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-cog"></i>
              <span>Services</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Site  Services:</h6>
                  <a class="collapse-item" href="products.php">Products</a>
                  <a class="collapse-item" href="Category.php">Edit Category</a>
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
            <span>Users</span>
          </a>
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
                    <h5></h5>
                    <!-- Topbar Search -->

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
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['Adminemail'] ?></span>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                        if(isset($_SESSION['message'])): ?>
                            <h5 style="width: 30%;">
                                <div class="alert alert-<?=$_SESSION['msg_type']?>">
                                <?php 
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                ?>
                            </div>
                            </h5>
                            
                        <?php endif; 
                    ?>

                <!-- Content Row for showing magnifying image--> 

                <div class="row" >
                  <div class="col-6">
                    <h6 class="background-light text-primary">Move cursor to magnify image</h6>
                    <div class="img-magnifier-container">
                        <img id="myimage" src="<?php echo "../uploads/".$_SESSION['photo']; ?>" width="500" height="300">
                    </div>
                    <br>
                    <p class="text-primary" style="font-family: calibri;">
                      <?php echo "Product name: ". $_SESSION['productname'] ?>
                    </p>
                    <hr>
                    <div align="center">
                        <a href="" type="button" class="btn btn-danger btn-sm btn-flat" data-toggle="modal" data-target="#exampleModalReject">Reject<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
                        <!-- Button trigger modal -->
                        <a href="" type="button" class="btn btn-success btn-sm btn-flat" data-toggle="modal" data-target="#exampleModal">Approve<i class="fa fa-thumbs-up ml-2"></i></a>
                    </div>
                  </div>
                  <div class="col-4" style="text-align: justify;">
                    <div class="card text-primary" style="font-family: calibri;">
                      <div class="card-body">

                        <p class="text-primary"><?php echo "Category: ".$_SESSION['catname']; ?></p>

                        <p>Product: <?php echo $_SESSION['productname']; ?></p><hr>

                        <p style="text-align: justify; overflow: auto;">
                          Description:<?php echo " ". $_SESSION['description'];?>
                          </p><hr>
                        <p><?php echo "Price: GHS". number_format($_SESSION['price'],2); ?>

                        <hr style="border: 1px solid;">
                          
                        </p> 
                        <p>Uploaded by: <?php echo " ".$_SESSION['uplUser'];?></p> 
                        <p>Phone: <?php echo $_SESSION['uplPhone']; ?></p>
                        <p>Location: <?php echo " ".$_SESSION['uplAddress'];?></p>
                        <p>Date Uploaded: <?php echo " ". $_SESSION['proDate']; ?></p>
                        <hr style="border: 1px solid;">

                      </div><br>
                    </div>
                  </div>
                   <!-- Button trigger modal -->
                </div>

                <!-- Modal for rejection button -->
                <div class="modal fade" id="exampleModalReject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-warning" id="exampleModalLabel">Reject upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true text-danger">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <p class="text-danger">Do you want to delete product permanently?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-sm btn-flat" data-dismiss="modal">Close</button>
                        <a class="btn btn-danger btn-sm btn-flat" href="inc/product-action.php? rejectprod=<?php echo  $_SESSION['productId']; ?>">Reject<i class="fa fa-trash ml-2"></i></a>
                      </div>
                    </div>
                  </div>
                </div><!-- end of rejection modal-->



                <!-- Modal for approve button -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header ">
                        <h5 class="modal-title" id="exampleModalLabel" >Approve upload</h5>
                        <button type="button" class="close btn-sm btn-flat" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <p class="text-warning">Do you want to aprove product?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">Close</button>
                        <a class="btn btn-success btn-sm btn-flat" href="inc/product-action.php? approve=<?php echo  $_SESSION['productId']; ?>">Approve<i class="fa fa-thumbs-up ml-2"></i></a>
                      </div>
                    </div>
                  </div>
                </div><!-- end of approcal modal-->


                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; AgriMarket 2026</span>
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
                                id="exampleInputPassword" name="name" style="height: 35px;" value="<?php echo $_SESSION['Adminname']; ?>"disabled />
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="email" style="height: 35px;" value="<?php echo $_SESSION['Adminemail']; ?>"disabled />
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-control form-control"
                                id="exampleInputPassword" name="catname" style="height: 35px;" value="<?php echo $_SESSION['Adminphone']; ?>"disabled />
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


        

    <script>
    /* Initiate Magnify Function
    with the id of the image, and the strength of the magnifier glass:*/
    magnify("myimage", 3);
    </script>



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