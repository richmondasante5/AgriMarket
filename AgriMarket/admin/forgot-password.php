<?php require_once 'inc/forgot-password-mail.php';?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="img/JPG" href="img/logo.JPG">
    <title>Agric-admin-forgotpassword</title>
     <link rel="icon" type="img/*" href="img/logo.jpg">
  </head>
  <body class=""><br><br>
    <div class="container" style="width: 500px; ">
      <br>
        <div class="container-fluid" align="center">
          <div class="container">
            <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
            </div>
            <?php endif; ?>
            <div class="card" style="width: 80%; font-size: 11px;">
              <div class="card-header"><h6 align="">Reset your password</h6></div>
              <div class="card-body">
                <form class="form-group" action="inc/forgot-password-mail.php" method="POST">
                  <input type="email" name="email" placeholder="Enter your e-mail address..." class="form-control" required> <br>
                  <div class="card-footer">
                    <div class="float-right"><input class="btn btn-primary" type="submit" name="sendmail" value="Send mail" align="center">
                    </div>
                    <div class="float-left" style="font-size: 12px;"><a class="nav-link" href="login.php">Back to login page</a></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> 
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>