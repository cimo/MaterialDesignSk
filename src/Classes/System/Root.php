<?php
require_once("Utility.php");
require_once("Query.php");
require_once("Ajax.php");

class Root {
    // Vars
    private $response;
    
    private $utility;
    private $query;
    private $ajax;
    
    private $settingRow;
    private $websiteName;
    
    // Properties
    public function getSettingRow() {
        return $this->settingRow;
    }
    
    public function getWebsiteName() {
        return $this->websiteName;
    }
    
    // Functions public
    public function __construct() {
        $this->response = Array();
        
        $this->utility = new Utility();
        $this->query = $this->utility->getQuery();
        $this->ajax = new Ajax();
        
        // Logic
        $this->settingRow = $this->query->selectSettingDatabase();
        
        $this->utility->generateToken();
        
        $this->utility->checkLanguage($this->settingRow);
        
        $this->utility->configureCookie(session_name(), 0, true, true);
        
        $url = $this->utility->checkSessionOverTime();
        
        $this->response['path']['documentRoot'] = $_SERVER['DOCUMENT_ROOT'];
        $this->response['path']['root'] = $this->utility->getPathRoot();
        $this->response['path']['src'] = $this->utility->getPathSrc();
        $this->response['path']['web'] = $this->utility->getPathWeb();
        
        $this->response['url']['root'] = $this->utility->getUrlRoot();
        
        $this->websiteName = $this->utility->getWebsiteName();
        
        if ($url != false)
            header("Location: $url");
        
        $event = isset($_POST['event']) == true ? $_POST['event'] : "";
        
        if ($event == "your_event") {
            $this->response['your_event'] = $event;
            
            echo $this->ajax->response(Array(
                'response' => $this->response
            ));
            
            exit;
        }
    }
    
    // Functions private
}
