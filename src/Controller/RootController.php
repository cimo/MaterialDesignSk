<?php
require_once(dirname(__DIR__) . "/Classes/System/Helper.php");
require_once(dirname(__DIR__) . "/Classes/System/Ajax.php");

class RootController {
    // Vars
    private $response;
    
    private $helper;
    private $query;
    private $ajax;

    private $session;

    // Properties

    // Functions public
    public function __construct() {
        $this->response = Array();
        
        $this->helper = new Helper();
        $this->query = $this->helper->getQuery();
        $this->ajax = new Ajax();

        // Logic
        $this->helper->generateToken();

        $this->helper->xssProtection();
        
        $this->helper->createCookie(session_name(), "", 0, true, true);

        $this->helper->checkLanguage();

        header("{$_SESSION['xssProtectionTag']}: {$_SESSION['xssProtectionRule']}");

        $_SESSION['currentPageId'] = 1;

        $this->response['url']['root'] = $this->helper->getUrlRoot();

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
