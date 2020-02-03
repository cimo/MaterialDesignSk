<?php
class Query {
    // Vars
    private $database;
    
    // Properties
    
    // Functions public
    public function __construct($database) {
        $this->database = $database;
    }
    
    public function selectSettingDatabase() {
        $rows = Array();
        
        $rows['template'] = "basic";
        $rows['language'] = "en";
        $rows['website_active'] = "1";
        
        return $rows;
    }
    
    // Functions private
}
