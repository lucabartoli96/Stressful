<?php

class Test {
    
    private static $ALL = "SELECT * FROM test WHERE category='%s'";
    
    private static $instance = null;

    private function __construct() { }
    
    public static function get() {
        
        Session::start();
        
        if ( !isset($_SESSION[__CLASS__]) ) {
            $_SESSION[__CLASS__] = new static();
        }
        
        return $_SESSION[__CLASS__];
        
    }
    
    public function all($category) {
        $db = Connection::get();
        $result = $db->query(sprintf(self::$ALL, $category));
        $converted = array();
        while ( $row = $result->fetch_assoc() ) {
            array_push($converted, $row);
        }
        return $converted;
    }
}

?>