<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('sections', 'table', 'testui'), array('utils', 'testuser'));
section_head();

if( !isset( $_POST['category'] ) ) {
    echo "<h1>Something wrong happened, you are trying to perform a test inside no category</h1>";
    die();
} else if ( !isset($_POST['test']) ) {
    echo "<h1>Something wrong happened, no test specified</h1>";
    die();
} else {
    loadtest($_POST['category'], $_POST['test']);
}

//} else {
//    
//    $category = $_POST['category'];
//    $name = $_POST['test'];
//    
//    $test = Test::get()->getTest($category, $name);
//    
//    if ( isset($_POST['submitted']) ) {
//        
//        $number = $test['number'];
//        $total_points = $number*$test['correct'];
//        $correct = $test['correct'];
//        $mistake = $test['mistake'];
//        
//        $submitted = json_decode($_POST['submitted'], true);
//        $questions = json_decode($_POST['questions'], true);
//        
//        $points = 0;
//        $answeared = 0;
//        
//        for( $i=0 ; $i < $number ; $i++ ) {
//            
//            if ( $submitted[$i] !== -1) {
//                
//                if ( $submitted[$i] === $questions[$i]['answear'] ) {
//                    $points += $correct;
//                } else {
//                    $points -= $mistake;
//                }
//                
//                $answeared++;   
//            }
//        }
//        
//        $perc = 0;
//
//        if ($points !== 0) {
//            $perc = ceil(( $points /$total_points ) * 100);
//        }
//        
//        $result = "$perc%";
//        
//        Submission::get()->add(
//            User::get()->name(),
//            $category,
//            $name,
//            $result
//        );
//        
//        result_table($category, $name, $answeared, $number, $points, $total_points, $result);
//        
//    } else {
//    }
//}

section_foot();
foot();
?>