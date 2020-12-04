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
        $rows['website_active'] = 1;
        $rows['block_multitab'] = 0;

        return $rows;
    }

    public function selectLanguageDatabase() {
        $rows = Array();

        $rows['code'] = "en";
        $rows['date'] = "Y-m-d";
        $rows['active'] = 1;

        return $rows;
    }
    
    // Functions private
}
