<?php

class Test {
    
    private static $ALL = "SELECT name, number AS questions, correct AS 'Correct answear', mistake AS 'Wrong answear', correct*number AS 'total points' from test WHERE category='%s'";
    private static $DELETE = "DELETE FROM test WHERE category='%s' AND name='%s'";
    private static $GET = "SELECT * FROM test WHERE category='%s' AND name='%s'";
    private static $ADD = "INSERT INTO test (category, name, number, correct, mistake, questions)".
                          " VALUES ('%s', '%s', %d, %d, %d, '%s') ";
    private static $UPDATE = "UPDATE test SET name='%s', number=%d, correct=%d, mistake=%d, questions='%s'" .
                             "WHERE category='%s' AND name='%s'";
    
    
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
    
    public function add($category, $name, $number, $correct, $mistake, $questions) {
            
        $user = User::get();
        
        if( $user->is_admin() ) {
            
            $db = Connection::get();
            
            $category = $db->real_escape_string($category);
            $name = $db->real_escape_string($name);
            
            $test = $db->query(sprintf(self::$GET, $category, $name))->fetch_assoc();
        
            if( $test ) {
                throw new TestException("$name already exists inside $category!");
            } else {
                
                $number = $db->real_escape_string($number);
                $correct = $db->real_escape_string($correct);
                $mistake = $db->real_escape_string($mistake);
                $questions = $db->real_escape_string($questions);
                
                $add = sprintf(self::$ADD, $category, $name, $number, $correct, $mistake, $questions);
                
                //HACK
                populate_sql($add);
                
                $db->query($add);
            }
                        
        } else {
            throw new UserException('User does not have enough privilieges to add a test');
        }
    }
    
    public function update($category, $oldname, $name, $number, $correct, $mistake, $questions) {
        
        $user = User::get();
        
        if( $user->is_admin() ) {
            $db = Connection::get();
            
            $category = $db->real_escape_string($category);
            $name = $db->real_escape_string($name);
            $oldname = $db->real_escape_string($oldname);
            
            if ( $oldname !== $name ) {
            
                $test = $db->query(sprintf(self::$GET, $category, $name))->fetch_assoc();
                
                if( $test ) {
                    throw new TestException("$name already exists inside $category!");
                }
            }
                
            $number = $db->real_escape_string($number);
            $correct = $db->real_escape_string($correct);
            $mistake = $db->real_escape_string($mistake);
            $questions = $db->real_escape_string($questions);
            
            $db->query(sprintf(self::$UPDATE, $name, $number, $correct, 
                                              $mistake, $questions, 
                                              $category, $oldname));
            
        } else {
            throw new UserException('User does not have enough privilieges to update a test');
        }
        
        
    }
    
    public function delete($category, $name) {
            
        $user = User::get();
        
        if( $user->is_admin() ) {
            
            $db = Connection::get();
            
            $db->query(sprintf(self::$DELETE, $category, $name));
            
        } else {
            throw new UserException('User does not have enough privilieges to delete a test');
        }
    }
    
    public function getTest($category, $name) {
        $db = Connection::get();
        return $db->query(sprintf(self::$GET, $category, $name))->fetch_assoc();
    }
    
}

?>