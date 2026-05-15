<?php  
require_once 'inc/admin-register.php';
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

</head>

<body class="bg-gradient-light">

    <div class="container" style="margin-top: 20px">
        <!--printing the alert on the index page-->

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-4">

                <div class="card " style="height: 560px;">
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
                                    <div class="card-body " >
                        <!-- Nested Row within Card Body -->
                                <div class="p-3" style="">

                                    
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already a user? Login Account</a>
                                        <h5 class="card-title">Create Account</h5>
                                    </div>
                                    <form class="user" action="inc/admin-register.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control"
                                                id="exampleInputPassword" placeholder="Full name..." required="true" name="name" style="height: 35px; border-radius: 100px;"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control"
                                                id="exampleInputPassword" placeholder="Phone Number..." required="true" name="phone" style="height: 35px; border-radius: 100px;"/>
                                        </div>
                                         <div class="form-group">
                                            <input type="email" class="form-control form-control"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Email..." name="email" required style="height: 35px; border-radius: 100px;"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control"
                                                id="exampleInputPassword" placeholder="Password" name="password" style="height: 35px; border-radius: 100px;"/>
                                        </div>
                                         <div class="form-group">
                                            <input type="password" class="form-control form-control"
                                                id="exampleInputPassword" placeholder="Repeat password" name="repassword" style="height: 35px; border-radius: 100px;"/>
                                        </div>
                                       
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">
                                                    Agree to our <a href="">Terms and Conditions</a></label>
                                            </div>
                                        </div>
                                        <div align="center">
                                            <button class="btn btn-success" style="width: 50%" name="signup">
                                                <i class="fa fa-sign-in" aria-hidden="true">Login</i>
                                            </button>
                                        </div>
                                        
                                    </form>
                                    
                                </div>
                     
                    </div>
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

</body>

</html>