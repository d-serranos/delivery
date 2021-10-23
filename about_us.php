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
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
                    <img src="images/innomovil.png">
                    <h3>Somos una compañía en constante cambio y crecimiento que busca brindar los mejores accesorios para tu celular y estar a la vanguardia en lo más tecnológico</h3>
                    
                    <img src="images/personaliza.jpg" >
                    <h3>Totalmente único y diferente, Así lucirá tu smartphone con tus familiares y tus amigos, plantea algo diferente.</h3>
                    </br>
                    <h1>Encuéntranos</h1>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15443.941364471028!2d-90.5123655!3d14.5999109!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6d18efc9e7686e57!2sInnom%C3%B3vil!5e0!3m2!1sen!2sgt!4v1634981627601!5m2!1sen!2sgt" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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