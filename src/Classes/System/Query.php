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
        $row = Array();
        
        $row['template'] = "basic";
        $row['language'] = "en";
        $row['website_active'] = "1";
        
        return $row;
    }
    
    // Functions private
}
