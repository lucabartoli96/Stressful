<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar', 'sections', 'profile'), array('utils', 'topbar', 'profile'));
topbar($config['info']['topbar'], 'Profile');

section_head();
?>
<div class="form-container"> 
    <div class="form">
        <form method="POST" action="<?php echo PUBLIC_HTML_PATH . '/profile.php'; ?>">
            
            <?php
            
            if( isset($_POST['modify']) ) {
                profile_inputs($user->name(), $user->email());
            } else if( isset($_POST['save']) ) {
                
                $err = null;
                        
                $username = "";
                $email = "";
                $password = "";
                    
                if ( isset($_POST['username']) ) {
                    $username = $_POST['username'];
                }

                if ( isset($_POST['email']) ) {
                    $email = $_POST['email'];
                }

                if ( isset($_POST['password']) ) {
                    $password = $_POST['password'];
                }

                try {
                    $user->change($username, $email, $password);    
                } catch (UserException $err) {
                    //DO NOTHING
                }

                
                if ( $err ) {
                    profile_inputs($username, $email, $err);
                } else {
                    profile_desc($user);  
                }
                  
            } else {
                profile_desc($user); 
            }
            
            ?>
        </form>
    </div>
</div>

<?php

section_foot();
foot();

?>