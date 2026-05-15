
<?php 

include 'inc/connection.php';

 ?>

<header class="main-header">

  <nav class="navbar navbar-static-top" style="background: #31993E">
    <div class="container">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand"><b>Agric</b>Marketing</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse" style="height: 50px;">
        <ul class="nav navbar-nav">
          <li><a href="index.php"><i style="margin-right: 4px;" class="fa fa-home" aria-hidden="true"></i>Home</a></li>
          <li><a href="">ABOUT US</a></li>
          <li><a href="">CONTACT US</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CATEGORY <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              

              <?php  
              $query=$conn->prepare("SELECT * FROM category");
              $query->execute();
              $result=$query->get_result();
               foreach($result as $row){
                    echo "
                      <li><a href='category.php?category=".$row['cat_slug']."'>".$row['name']."</a></li>
                    ";                  
                  }
                  ?>

            </ul>
          </li>
           <li><a href="product_upload.php"><i style="margin-right: 4px;" class="fa fa-sellsy" aria-hidden="true"></i>SELL PRODUCT</a></li>
        </ul>
        <form method="POST" class="navbar-form navbar-left" action="search.php">
          <div class="input-group">
              <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
              <span class="input-group-btn" id="searchBtn" style="display:none;">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i> </button>
              </span>
          </div>
        </form>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-success cart_count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="cart_count"></span> item(s) in cart</li>
              <li>
                <ul class="menu" id="cart_menu">
                </ul>
              </li>
              <li class="footer"><a href="cart_view.php">Go to Cart</a></li>
            </ul>
          </li>

          <?php
          if(isset($_SESSION['usermail'])){
            $sessionmail=$_SESSION['usermail'];
            $query=$conn->prepare("SELECT * FROM users WHERE email=?");
            $query->bind_param("s", $sessionmail);
            $query->execute();
            $result=$query->get_result();
             if($result->num_rows>0){
              $row=$result->fetch_array();
              $profile="images/".$row['photo'];
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$profile.'" class="user-image" alt="User Image">
                    <span class="hidden-xs">'.$row['firstname'].' '.$row['lastname'].'</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="'.$profile.'" class="img-circle" alt="User Image">

                      <p>
                        '.$row['firstname'].' '.$row['lastname'].'
                        <small>Member since '.date('M. Y', strtotime($row['created_on'])).'</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';

          }
            
           
            }else{
              echo "
                <li><a href='login.php'>LOGIN</a></li>
                <li><a href='signup.php'>SIGNUP</a></li>
              ";
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>