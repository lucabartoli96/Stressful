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

head(array('sections', 'testadmin'), array('utils','testadmin'));
section_head();

if( !isset( $_POST['category'] ) ) {
    echo "<h1>Something wrong happened, you are trying to create/modify a test inside no category</h1>";
    die();
} else {
 
    $category = $_POST['category'];
    
    if ( isset( $_POST['modify'] ) ) {
        
        $name = $_POST['name'];
        
        $test = Test::get()->getTest($category, $name);
        
        $number = $test['number'];
        $correct = $test['correct'];
        $mistake = $test['mistake'];
        $questions = $test['questions'];
        
        newtest('Update', $user->name(), 
                $category, $name, 
                $number, $correct, 
                $mistake, $questions);
        
    } else if ( isset($_POST['update']) ) {
        
        $oldname = $_POST['update'];
        $name = $_POST['name'];
        $number = $_POST['number'];
        $correct = $_POST['correct'];
        $mistake = $_POST['mistake'];
        $questions = $_POST['questions'];
        
        try {
            
            Test::get()->update($category, $oldname,
                                $name, $number, 
                                $correct, $mistake, 
                                $questions
                            );

            echo "<h1>Successfully modified</h1>";
            hiddenForm(PUBLIC_HTML_PATH . '/home.php', 
                       array(
                        'category' => $_POST['category']
                      ));


        } catch ( TestException $err ) {

            newtest('Update', $user->name(), 
                    $category, $oldname, 
                    $number, $correct, 
                    $mistake, $questions,
                    $err->getMessage());

        }
            
        
    } else if (isset($_POST['number']) and 
               isset($_POST['correct']) and 
               isset($_POST['mistake']) and 
               isset($_POST['questions']) ) {
        
        $name = $_POST['name'];
        $number = $_POST['number'];
        $correct = $_POST['correct'];
        $mistake = $_POST['mistake'];
        $questions = $_POST['questions'];
        
        try {
            
            //signature: $category, $name, $number, $correct, $mistake, $questions
            Test::get()->add($category, $name, 
                             $number, $correct, 
                             $mistake, $questions);

            echo "<h1>Successfully created</h1>";
            hiddenForm(PUBLIC_HTML_PATH . '/home.php', 
                       array(
                        'category' => $_POST['category']
                      ));


        } catch ( TestException $err ) {

            newtest('Create', $user->name(), 
                    $category, $name, 
                    $number, $correct, 
                    $mistake, $questions,
                    $err->getMessage());

        }
        
    } else {
        newtest('Create', $user->name(), $category);
    }
    
}

section_foot();
foot();

?>