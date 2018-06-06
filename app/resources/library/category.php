
<?php

class Category {
    
    private static $ALL = "SELECT * FROM category";
    private static $CHECK = "SELECT * FROM category WHERE name=%s LIMIT 1";
    private static $INSERT = "INSERT INTO category (name, creator) VALUES ('%s', '%s')";
    private static $DELETE = "DELETE FROM category WHERE name='%s'";
    
    private static $instance = null;
    
    private function __construct() { }
    
    public static function get() {
        
        Session::start();
        
        if ( !isset($_SESSION[__CLASS__]) ) {
            $_SESSION[__CLASS__] = new static();
        }
        
        return $_SESSION[__CLASS__];
        
    }
    
    public function all() {
        $db = Connection::get();
        $result = $db->query(self::$ALL);
        $converted = array();
        while ( $row = $result->fetch_assoc() ) {
            array_push($converted, $row);
        }
        return $converted;
    }
    
    public function add($name, $creator) {
        
        $user = User::get();
        
        if( $user->is_admin() ) {
         
            $db = Connection::get();
            $category = $db->query(sprintf(self::$CHECK, $name));
        
            if( $category ) {
                throw new CategoryException("$name already exists!");
            } else {
                $db->query(sprintf(self::$INSERT, $name, $creator));
            }
            
        } else {
            throw new UserException('User does not have enough privilieges to add a category');
        }
        
    }
    
    public function delete($name) {
            
        $user = User::get();
        
        if( $user->is_admin() ) {
            
            $db = Connection::get();
            $db->query(sprintf(self::$DELETE, $name));
            
        } else {
            throw new UserException('User does not have enough privilieges to delete a category');
        }
    }
    
    
    public function change_name($old_name, $name) {
        
        $user = User::get();
        
        if( $user->is_admin() ) {
         
            $db = Connection::get();
            $category = $db->query(sprintf(self::$CHECK, $name));
        
            if( $category ) {
                throw new CategoryException("$name already exists!");
            } else {
                $db->query(sprintf(self::$UPDATE, $name));
            }
            
        } else {
            throw new UserException('User does not have enough privilieges to add a category');
        }
        
    }
    
}

?>