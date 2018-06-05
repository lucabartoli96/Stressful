<?php 
require_once("/var/www/html/Stressful/resources/config.php");
require_once(TEMPLATES_PATH . '/build.php');
require_once(LIBRARY_PATH . '/db.php');

$username = "";
$password = "";

$err = null;

if(isset($_POST['login'])) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        User::get()->login($username, $password);
        header("location: home.php");
    } catch ( UserException $err ) {
        //DO NOTHING
    }
} else if (isset($_POST['logout'])) {
    User::get()->logout();
}

?>

<?php 
head(array('login'), array('index'));
login_form_head(PUBLIC_HTML_PATH . "/login.php");
?>

<input type="text" placeholder="username" value="<?php echo $username ?>" name="username"/>
<?php 
print_if_err($err, 'username');
?>
<input type="password" placeholder="password" name="password"/>
<?php 
print_if_err($err, 'password');
?>
<button type="submit" name="login">Login</button>
<p class="message">Not registered? <a id="signup" href="signup.php">Create an account</a></p

<?php
login_form_foot();
foot();
?>