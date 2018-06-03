<?php 
require_once("/var/www/html/Stressful/resources/config.php");
require_once(TEMPLATES_PATH . '/build.php');
require_once(LIBRARY_PATH . '/db.php');


$username = "";
$email = "";
$password = "";

$err = null;

if(isset($_POST['signup'])) {
    try {
        User::get()->signup($_POST['username'], $_POST['email'], $_POST['password']);
        header("location: home.php");
    } catch ( UserException $err ) {
        //DO NOTHING
    }
}

?>

<?php 
head(array('login'), array('index'));
login_form_head($config['urls']['base'] . "/signup.php");
?>
<input type="text" placeholder="username" name="username"/>
<?php 
print_if_err($err, 'username');
?>
<input type="email" placeholder="email" name="email"/>
<?php 
print_if_err($err, 'email');
?>
<input type="password" placeholder="password" name="password"/>
<input type="password" placeholder="password confirmation" name="password_conf"/>
<button type="submit" name="signup">Create</button>
<p class="message">Already registered? <a id="login" href="login.php">Sign In</a></p>

<?php
login_form_foot();
foot();
?>