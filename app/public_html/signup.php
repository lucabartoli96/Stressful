<?php 
require_once("/var/www/html/Stressful/resources/config.php");
require_once(TEMPLATES_PATH . '/build.php');
require_once(LIBRARY_PATH . '/db.php');

head(array('login'), array('utils', 'index'));
login_form_head('signup');
?>

<input type="text" placeholder="username" name="username"/>
<input type="email" placeholder="email" name="email"/>
<input type="password" placeholder="password" name="password"/>
<input type="password" placeholder="password confirmation" name="password_conf"/>
<button type="submit" name="signup">Create</button>
<p class="message">Already registered? <a id="login" href="login.php">Sign In</a></p>

<?php
login_form_foot();
foot();
?>