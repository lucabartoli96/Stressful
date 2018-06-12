<?php

class Submission {
    
    private static $ALL = "SELECT test, category, result, date FROM submission WHERE user='%s'";
    private static $ADD = "INSERT INTO submission (user, category, test, result) VALUES ('%s', '%s', '%s', '%s') ";
    
    private static $instance = null;

    private function __construct() { }
    
    public static function get() {
        
        Session::start();
        
        if ( !isset($_SESSION[__CLASS__]) ) {
            $_SESSION[__CLASS__] = new static();
        }
        
        return $_SESSION[__CLASS__];
        
    }
    
    public function all($user) {
        $db = Connection::get();
        $result = $db->query(sprintf(self::$ALL, $user));
        $converted = array();
        while ( $row = $result->fetch_assoc() ) {
            array_push($converted, $row);
        }
        return $converted;
    }
    
    public function add($user, $category, $test, $result) {
            
        $db = Connection::get();

        $user = $db->real_escape_string($user);
        $category = $db->real_escape_string($category);
        $test = $db->real_escape_string($test);
        $result = $db->real_escape_string($result);
        
        $add = sprintf(self::$ADD, $user, $category, $test, $result);
        
        //HACK 
        populate_sql($add);
        
        $db->query($add);

    }
}

?>