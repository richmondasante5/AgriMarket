<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
		         <h2 class="card-header text-primary">ABOUT AGRIMARKERT</h2>
		       		<p style="text-align: justify; font-size: 16px; font-family: calibri">
AgriMarket is a web-based marketplace designed to connect farmers, suppliers, and buyers through a single digital platform. The system enables users to browse agricultural products, manage inventory, place orders, and complete secure online transactions. By simplifying the buying and selling process, AgriMarket helps improve market access, reduce manual processes, and create a more efficient agricultural trading experience for both vendors and customers.
<br><br>
Built using PHP, JavaScript, MySQL, and Bootstrap, the platform features user authentication, product management, inventory tracking, shopping cart functionality, and Paystack payment integration. The application was developed with a focus on usability, security, and scalability, providing a reliable solution for managing agricultural commerce in a modern digital environment.
</p>

	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>