<?php
require_once(dirname(dirname(__DIR__)) . "/Config.php");
require_once("Database.php");
require_once("Query.php");
require_once("QueryCustom.php");

class Helper {
    // Vars
    private $sessionMaxIdleTime;
    
    private $config;
    private $databse;
    private $query;
    private $queryCustom;
    
    private $settingRow;

    private $languageFormat;
    
    private $protocol;
    
    private $pathRoot;
    private $pathSrc;
    private $pathPublic;
    
    private $urlRoot;
    private $urlEventListener;
    
    private $supportSymlink;
    
    private $websiteFile;
    private $websiteName;

    private $sshConnection;
    private $sshSudo;
    
    // Properties
    public function getSessionMaxIdleTime() {
        return $this->sessionMaxIdleTime;
    }

    public function getDatabase() {
        return $this->database;
    }
    
    public function getQuery() {
        return $this->query;
    }

    public function getQueryCustom() {
        return $this->queryCustom;
    }
    
    public function getSettingRow() {
        return $this->settingRow;
    }
    
    public function getProtocol() {
        return $this->protocol;
    }
    
    public function getPathRoot() {
        return $this->pathRoot;
    }
    
    public function getPathSrc() {
        return $this->pathSrc;
    }
    
    public function getPathPublic() {
        return $this->pathPublic;
    }
    
    public function getUrlRoot() {
        return $this->urlRoot;
    }

    public function getUrlEventListener() {
        return $this->urlEventListener;
    }
    
    public function getSupportSymlink() {
        return $this->supportSymlink;
    }
    
    public function getWebsiteFile() {
        return $this->websiteFile;
    }
    
    public function getWebsiteName() {
        return $this->websiteName;
    }
      
    // Functions public
    public function __construct() {
        $this->sessionMaxIdleTime = ini_get("session.gc_maxlifetime");
        
        $this->config = new Config();
        $this->database = new Database($this->config);
        $this->query = new Query($this->database);
        $this->queryCustom = new QueryCustom($this->database);
        
        $this->settingRow = $this->query->selectSettingDatabase();

        $languageRow = $this->query->selectLanguageDatabase($this->settingRow['language']);
        $this->languageFormat = $languageRow['date'];

        $serverRoot = isset($_SERVER['DOCUMENT_ROOT']) == true ? $_SERVER['DOCUMENT_ROOT'] : $this->settingRow['server_root'];
        $serverHost = isset($_SERVER['HTTP_HOST']) == true ? $_SERVER['HTTP_HOST'] : $this->settingRow['server_host'];
        
        $this->protocol = $this->config->getProtocol();
        
        $this->pathRoot = $serverRoot . $this->config->getPathRoot();
        $this->pathSrc = "{$this->pathRoot}/src";
        $this->pathPublic = "{$this->pathRoot}/public";
        $this->pathLock = "{$this->pathRoot}/src/files/lock";
        
        $this->urlRoot = $this->config->getProtocol() . $serverHost . $this->config->getUrlRoot();
        $this->urlEventListener = $this->config->getProtocol() . $serverHost . $this->config->getUrlRoot() . "/event_listener";
        
        $this->supportSymlink = $this->config->getSupportSymlink();

        $this->websiteFile = $this->config->getFile();
        $this->websiteName = $this->config->getName();

        $this->sshConnection = false;
        $this->sshSudo = "";

        $this->arrayColumnFix();
    }
    
    public function generateToken() {
        if (isset($_SESSION['token']) == false)
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(21));
    }
    
    public function checkToken($token) {
        if (isset($_SESSION['token']) == true && $token == $_SESSION['token'])
            return true;
        
        return false;
    }

    public function xssProtection() {
        $nonceCsp = base64_encode(random_bytes(20));
        
        $_SESSION['xssProtectionTag'] = "Content-Security-Policy";
        $_SESSION['xssProtectionRule'] = "script-src 'strict-dynamic' 'nonce-{$nonceCsp}' 'unsafe-inline' http: https:; object-src 'none'; base-uri 'none';";
        $_SESSION['xssProtectionValue'] = $nonceCsp;
    }

    public function createCookie($name, $value, $expire, $secure, $httpOnly) {
        $currentCookieParams = session_get_cookie_params();

        if ($value == null)
            $value = isset($_COOKIE[$name]) == true ? $_COOKIE[$name] : session_id();

        setcookie($name, $value, $expire, $currentCookieParams['path'], $currentCookieParams['domain'], $secure, $httpOnly);
    }

    public function checkLanguage() {
        $_SESSION['languageTextCode'] = $this->settingRow['language'];

        if (isset($_REQUEST['languageTextCode']) != false)
            $_SESSION['languageTextCode'] = $_REQUEST['languageTextCode'];
        else if (isset($_REQUEST['_locale']) != false)
            $_SESSION['languageTextCode'] = $_REQUEST['_locale'];
    }

    // Functions private
    private function arrayColumnFix() {
        if (function_exists("array_column") == false) {
            function array_column($input = null, $columnKey = null, $indexKey = null) {
                $argc = func_num_args();
                $params = func_get_args();
                
                if ($argc < 2) {
                    trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
                    
                    return null;
                }
                
                if (!is_array($params[0])) {
                    trigger_error("array_column() expects parameter 1 to be array, " . gettype($params[0]) . " given", E_USER_WARNING);
                    
                    return null;
                }
                
                if (!is_int($params[1]) && !is_float($params[1]) && !is_string($params[1]) && $params[1] !== null && !(is_object($params[1]) && method_exists($params[1], "__toString"))) {
                    trigger_error("array_column(): The column key should be either a string or an integer", E_USER_WARNING);
                    
                    return false;
                }
                
                if (isset($params[2]) && !is_int($params[2]) && !is_float($params[2]) && !is_string($params[2]) && !(is_object($params[2]) && method_exists($params[2], "__toString"))) {
                    trigger_error("array_column(): The index key should be either a string or an integer", E_USER_WARNING);
                    
                    return false;
                }
                
                $paramsInput = $params[0];
                $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
                $paramsIndexKey = null;
                
                if (isset($params[2])) {
                    if (is_float($params[2]) || is_int($params[2]))
                        $paramsIndexKey = (int)$params[2];
                    else
                        $paramsIndexKey = (string)$params[2];
                }
                
                $resultArray = array();
                
                foreach ($paramsInput as $row) {
                    $key = null;
                    $value = null;
                    
                    $keySet = false;
                    $valueSet = false;
                    
                    if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                        $keySet = true;
                        $key = (string)$row[$paramsIndexKey];
                    }
                    
                    if ($paramsColumnKey == null) {
                        $valueSet = true;
                        $value = $row;
                    }
                    else if (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                        $valueSet = true;
                        $value = $row[$paramsColumnKey];
                    }
                    
                    if ($valueSet) {
                        if ($keySet)
                            $resultArray[$key] = $value;
                        else
                            $resultArray[] = $value;
                    }
                }
                
                return $resultArray;
            }
        }
    }
}
