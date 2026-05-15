<?php  
    require_once 'inc/verify.php';
    if(isset($_SESSION['admin'])){
        session_unset();
        session_destroy();
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

    <title>Agric-commerce-admin-Login</title>
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

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-4">

                <div class="card ">
                    <div class="card-body ">
                        <!-- Nested Row within Card Body -->
                                <div class="p-3">
                                    <div class="text-center">
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
                                        <h1 class="h4 text-gray-900 mb-4"> Login Account</h1>
                                    </div>
                                    <form class="user" action="inc/verify.php" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email" required="true">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password" required="true">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div align="center">
                                            <button class="btn btn-success" style="width: 50%" name="login">
                                                <i class="fa fa-sign-in" aria-hidden="true">Login</i>
                                            </button>
                                        </div>
                                        <hr>
                                    </form>
                                   
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="signup.php">Create an Account!</a> <hr>
                                    </div>
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