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
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
    <link href="assets/css/style.css?v=1" rel="stylesheet">
    
  </head>
  
  <!-- !Body -->
  <body>
    <div id="container">
      <header>
        <h1><?php echo AUTH_REALM ?></h1>
        <ul>
          <?php
            
            foreach(Slacker::get_channels() as $channel):
              $active = isset($_GET['channel']) ? $_GET['channel'] : '';
          ?>
            <li><a class="<?php echo $channel['channel_name'] == $active ? 'active' : '' ?>" href="?channel=<?php echo $channel['channel_name'] ?>">#<?php echo $channel['channel_name'] ?></a></li> 
          <?php
            endforeach;
          ?>
        </ul>
      </header><!-- /header -->
      
      <section id="main">
        <?php          
          if(isset($_GET['channel'])):
            $slack = new Slacker();
            if(file_exists('templates/'.basename($_GET['channel']).'.php')):
              require 'templates/'.basename($_GET['channel']).'.php';
            else:
              require 'templates/introductions.php';
            endif;
          endif;
        ?>
      </section><!-- /main -->
      
      <footer>
      
      </footer><!-- /footer -->
    </div><!--!/#container -->
    
  </body>
</html>
