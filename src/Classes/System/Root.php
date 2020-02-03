<?php
require_once("Helper.php");
require_once("Ajax.php");

class Root {
    // Vars
    private $response;
    
    private $helper;
    private $query;
    private $ajax;
    
    private $settingRow;
    private $websiteName;
    
    // Properties
    public function getWebsiteName() {
        return $this->websiteName;
    }
    
    // Functions public
    public function __construct() {
        $this->response = Array();
        
        $this->helper = new Helper();
        $this->query = $this->helper->getQuery();
        $this->ajax = new Ajax();
        
        // Logic
        $this->helper->xssProtection();
        
        $this->settingRow = $this->helper->getSettingRow();
        
        $this->helper->generateToken();
        
        $this->helper->checkLanguage();
        
        $this->helper->createCookie(session_name(), "", 0, true, true);
        
        $url = $this->helper->checkSessionOverTime();
        
        $this->response['path']['documentRoot'] = $_SERVER['DOCUMENT_ROOT'];
        $this->response['path']['root'] = $this->helper->getPathRoot();
        $this->response['path']['src'] = $this->helper->getPathSrc();
        $this->response['path']['public'] = $this->helper->getPathPublic();
        
        $this->response['url']['root'] = $this->helper->getUrlRoot();
        
        $this->websiteName = $this->helper->getWebsiteName();
        
        header("{$_SESSION['xssProtectionTag']}: {$_SESSION['xssProtectionRule']}");
        
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
