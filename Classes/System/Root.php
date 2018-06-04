<?php
require_once("Utility.php");
require_once("Ajax.php");

class Root {
    // Vars
    private $utility;
    private $ajax;
    
    // Properties
    
    // Functions public
    public function __construct() {
        $this->utility = new Utility();
        $this->ajax = new Ajax();
        
        $this->utility->generateToken();
        
        $this->utility->configureCookie(session_name(), 0, true, true);
        
        $this->utility->checkSessionOverTime(true);
        
        // Logic
        $event = isset($_POST['event']) == true ? $_POST['event'] : "";
        
        if ($event == "your_event") {
            echo $this->ajax->response(Array(
                'response' => $this->response
            ));
            
            exit;
        }
    }
    
    // Functions private
}
