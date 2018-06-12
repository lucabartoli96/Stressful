
<?php

class Category {
    
    private static $ALL = "SELECT c.name, c.creator, c.since, COUNT(t.name) AS test FROM category AS c LEFT JOIN test AS t ON c.name = t.category GROUP BY c.name, c.creator, c.since";
    private static $CHECK = "SELECT * FROM category WHERE name='%s' LIMIT 1";
    private static $INSERT = "INSERT INTO category (name, creator) VALUES ('%s', '%s')";
    private static $DELETE = "DELETE FROM category WHERE name='%s'";
    private static $UPDATE = "UPDATE category SET name='%s' WHERE name='%s' ";
    
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
            
            $name = $db->real_escape_string($name);
            $creator = $db->real_escape_string($creator);
            
            $category = $db->query(sprintf(self::$CHECK, $name))->fetch_assoc();
        
            if( $category ) {
                throw new CategoryException("$name already exists!");
            } else {
                $insert = sprintf(self::$INSERT, $name, $creator);
                //HACK
                populate_sql($insert);
                
                $db->query($insert);
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
            
            $name = $db->real_escape_string($name);
            $old_name = $db->real_escape_string($old_name);
            
            if ( $name === $old_name) {
                return;
            }
            
            $category = $db->query(sprintf(self::$CHECK, $name))->fetch_assoc();
        
            if( $category ) {
                throw new CategoryException("$name already exists!");
            } else {
                $db->query(sprintf(self::$UPDATE, $name, $old_name));
            }
            
        } else {
            throw new UserException('User does not have enough privilieges to update a category');
        }
        
    }
    
}

?>