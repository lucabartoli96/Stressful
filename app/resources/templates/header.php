<?php 
require_once("/var/www/html/Stressful/resources/config.php");
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Stressful</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo FRAMEWORK_PATH . '/bootstrap.css'; ?>">
        
    <?php
        
    foreach ( $css as $href ) {
        echo '<link rel="stylesheet" href="css/'. $href . '.css">';
    }
    
    ?>
        
    <script type="text/javascript" src="<?php echo FRAMEWORK_PATH.'/jquery.min.js'; ?>" ></script>
    
    <?php
            
    foreach ( $js as $src ) {
        echo '<script type="text/javascript" src="js/'. $src . '.js"> </script>';
    }
    
    ?>
	</head>
    <body>