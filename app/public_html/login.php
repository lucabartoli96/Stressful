<?php 
require_once("/var/www/html/Stressful/resources/config.php");
require_once(TEMPLATES_PATH . '/build.php');
require_once(LIBRARY_PATH . '/db.php');

head(array('login'), array('utils', 'index'));

if ( User::get()->is_logged() ) {
    header('location: home.php');
}

login_form_head('login');

?>

<input type="text" placeholder="username" value="" name="username"/>
<input type="password" placeholder="password" name="password"/>
<button type="submit" name="login">Login</button>
<p class="message">Not registered? <a id="signup" href="signup.php">Create an account</a></p

<?php
login_form_foot();
foot();
?>