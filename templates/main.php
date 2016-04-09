<!DOCTYPE html>   
  <!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
  <!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
  <!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
  <!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
  <head>
  	<meta charset="utf-8">
  	<!--[if IE]><![endif]-->
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  	<title><?php echo AUTH_REALM ?></title>
  	<meta name="description" content="">
  	<meta name="keywords" content="" />
  	<meta name="author" content="">
  	<meta name="viewport" content="initial-scale=1.0">
  	<!-- !CSS -->
  	<link rel="stylesheet" href="assets/css/style.css?v=1">
  	
  </head>
  
  <!-- !Body -->
  <body>
  	<div id="container">
  		<header>
    		<h1></h1>
  		</header><!-- /header -->
  		
  		<section id="main">
  		  <?php
    		  $presentations = new Presentations();
    		  
          foreach($presentations->get_presentations() as $p):
            require 'templates/presentation.php';
          endforeach;
    		?>
  		</section><!-- /main -->
  		
  		<footer>
  		
  		</footer><!-- /footer -->
  	</div><!--!/#container -->
  	
  </body>
</html>
