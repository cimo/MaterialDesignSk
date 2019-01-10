<?php
class Ajax {
    // Vars
    
    // Properties
    
    // Functions public
    public function __construct() {
    }
    
    public function response($array) {
        return json_encode($array, JSON_FORCE_OBJECT);
    }
    
    public function errors($elements) {
        $errors = Array();
        
        foreach ($elements as $key => $value) {
            $errors[$key][] = $value;
        }
        
        return $errors;
    }
    
    // Functions private
}
