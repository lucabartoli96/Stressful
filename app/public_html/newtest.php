<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

if ( !$user->is_admin() ) {
    header('location: home.php');
}

head(array('sections', 'newtest'), array('utils','newtest'));
section_head();

if( !isset( $_POST['category'] ) ) {
    echo "<h1>Something wrong happened, you are trying to create a test inside no category</h1>";
    die();
} else {
 
    if ( isset($_POST['name']) and isset($_POST['questions']) ) {
        
        try {
            //signature: $category, $name, $number, $correct, $mistake, $questions
            Test::get()->add(
                $_POST['category'],
                $_POST['name'],
                $_POST['number'],
                $_POST['correct'],
                $_POST['mistake'],
                $_POST['questions']
            );
            
            echo "<h1>Successfully created</h1>";
            hiddenForm(PUBLIC_HTML_PATH . '/home.php', 
                       array(
                        'category' => $_POST['category']
                      ));
            
            
        } catch ( TestException $err ) {
            newtest($user->name(), $_POST['category'], $err->getMessage());
        }
        
    } else {
        newtest($user->name(), $_POST['category']);
    }
    
}

section_foot();
foot();

?>