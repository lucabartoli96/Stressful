<?php

class UserException extends Exception {
    private $stack;
    
    public function __construct($message) {
        parent::__construct($message);
        $this->stack = null;
    }
    
    public function is_set() {
        return $this->stack !== null;
    }
    
    public function push($name, $message) {
        
        if ( !$this->is_set() ) {
            $this->stack = array();
        }
        
        $this->stack[$name] = $message;
    }
    
    public function to_json() {
        
        $err = array(
            "error" => $this->stack
        );
        
        return json_encode($err);
    }
}

class CategoryException extends Exception {

    public function __construct($message) {
        parent::__construct($message);
    }
    
    public function to_json() {
        $message = $this->getMessage();
        return "{'error' : $message }";
    }
}

class TestException extends Exception {

    public function __construct($message) {
        parent::__construct($message);
    }
    
    public function to_json() {
        $message = $this->getMessage();
        return "{'error' : $message }";
    }
}


?>