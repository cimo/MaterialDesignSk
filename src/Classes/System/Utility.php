<?php
require_once(dirname(dirname(__DIR__)) . "/Config.php");
require_once("Database.php");
require_once("Query.php");

class Utility {
    // Vars
    private $sessionMaxIdleTime;
    
    private $config;
    private $database;
    private $query;
    
    private $protocol;
    
    private $pathRoot;
    private $pathSrc;
    private $pathWeb;
    
    private $urlRoot;
    private $urlListener;
    
    private $supportSymlink;
    
    private $websiteFile;
    private $websiteName;
    
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
    
    public function getProtocol() {
        return $this->protocol;
    }
    
    public function getPathRoot() {
        return $this->pathRoot;
    }
    
    public function getPathSrc() {
        return $this->pathSrc;
    }
    
    public function getPathWeb() {
        return $this->pathWeb;
    }
    
    public function getUrlRoot() {
        return $this->urlRoot;
    }
    
    public function getUrlListener() {
        return $this->urlListener;
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
        $this->sessionMaxIdleTime = 3600;
        
        $this->config = new Config();
        $this->database = new Database($this->config);
        $this->query = new Query($this->database);
        
        $this->protocol = $this->config->getProtocol();
        
        $this->pathRoot = $_SERVER['DOCUMENT_ROOT'] . $this->config->getPathRoot();
        $this->pathSrc = "{$this->pathRoot}/src";
        $this->pathWeb = "{$this->pathRoot}/public";
        
        $this->urlRoot = $this->config->getProtocol() . $_SERVER['HTTP_HOST'] . $this->config->getUrlRoot();
        $this->urlListener = $this->config->getProtocol() . $_SERVER['HTTP_HOST'] . dirname($this->config->getUrlRoot()) . "/src";
        
        $this->supportSymlink = $this->config->getSupportSymlink();
        
        $this->websiteFile = $this->config->getFile();
        $this->websiteName = $this->config->getName();
        
        $this->arrayColumnFix();
    }
    
    public function generateToken() {
        if (isset($_SESSION['token']) == false)
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(21));
    }
    
    public function configureCookie($name, $lifeTime, $secure, $httpOnly) {
        $currentCookieParams = session_get_cookie_params();
        
        $value = isset($_COOKIE[$name]) == true ? $_COOKIE[$name] : session_id();
        
        if (isset($_COOKIE[$name]) == true)
            setcookie($name, $value, $lifeTime, $currentCookieParams['path'], $currentCookieParams['domain'], $secure, $httpOnly);
    }
    
    public function sessionUnset() {
        session_unset();
        
        $cookies = Array(
            session_name() . "_REMEMBERME"
        );
        
        foreach ($cookies as $value) {
            unset($_COOKIE[$value]);
        }
    }
    
    public function searchInFile($filePath, $word, $replace) {
        $reading = fopen($filePath, "r");
        $writing = fopen($filePath + ".tmp", "w");
        
        $checked = false;
        
        while (feof($reading) == false) {
            $line = fgets($reading);
            
            if (stristr($line, $word) != false) {
                $line = $replace;
                
                $checked = true;
            }
            
            if (feof($reading) == true && $replace == null) {
                $line = "$word\n";

                $checked = true;
            }
            
            fwrite($writing, $line);
        }
        
        fclose($reading);
        fclose($writing);
        
        if ($checked == true) 
            @rename($filePath + ".tmp", $filePath);
        else
            unlink($filePath + ".tmp");
    }
    
    public function removeDirRecursive($path, $parent) {
        if (file_exists($path) == true) {
            $rdi = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
            $rii = new RecursiveIteratorIterator($rdi, RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($rii as $file) {
                if (file_exists($file->getRealPath()) == true) {
                    if ($file->isDir() == true)
                        rmdir($file->getRealPath());
                    else
                        unlink($file->getRealPath());
                }
                else if (is_link($file->getPathName()) == true)
                    unlink($file->getPathName());
            }

            if ($parent == true)
                rmdir($path);
        }
    }
    
    public function generateRandomString($length) {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randomString = "";
        
        for ($a = 0; $a < $length; $a ++)
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        
        return $randomString;
    }
    
    public function sendEmail($to, $subject, $message, $from) {
        $headers  = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=UTF-8 \r\n";
        $headers .= "From: $from \r\n Reply-To: $from";

        mail($to, $subject, $message, $headers);
    }
    
    public function sizeUnits($bytes) {
        if ($bytes >= 1073741824)
            $bytes = number_format($bytes / 1073741824, 2) . " GB";
        else if ($bytes >= 1048576)
            $bytes = number_format($bytes / 1048576, 2) . " MB";
        else if ($bytes >= 1024)
            $bytes = number_format($bytes / 1024, 2) . " KB";
        else if ($bytes > 1)
            $bytes = "$bytes bytes";
        else if ($bytes == 1)
            $bytes = "$bytes byte";
        else
            $bytes = "0 bytes";

        return $bytes;
    }
    
    public function clientIp() {
        $ip = "";
        
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("HTTP_X_FORWARDED"))
            $ip = getenv("HTTP_X_FORWARDED");
        else if(getenv("HTTP_FORWARDED_FOR"))
            $ip = getenv("HTTP_FORWARDED_FOR");
        else if(getenv("HTTP_FORWARDED"))
           $ip = getenv("HTTP_FORWARDED");
        else if(getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "UNKNOWN";
        
        return $ip;
    }
    
    public function dateFormat($date) {
        $newData = Array("", "");
        
        $dateExplode = explode(" ", $date);
        
        if (count($dateExplode) == 0)
            $dateExplode = $newData;
        else {
            $languageDate = isset($_SESSION['languageDate']) == false ? "Y-m-d" : $_SESSION['languageDate'];
            
            if (strpos($dateExplode[0], "0000") === false)
                $dateExplode[0] = date($languageDate, strtotime($dateExplode[0]));
        }
        
        return $dateExplode;
    }
    
    public function timeFormat($type, $time) {
        if ($time == 0)
            return "0s";
        
        $result = Array();
        
        if ($type == "micro") {
            $elements = Array(
                'y' => $time / 31556926 % 12,
                'w' => $time / 604800 % 52,
                'd' => $time / 86400 % 7,
                'h' => $time / 3600 % 24,
                'm' => $time / 60 % 60,
                's' => $time % 60
            );
        }
        else if ($type == "seconds") {
            $elements = Array(
                'h' => floor($time / 3600),
                'm' => floor($time / 60),
                's' => $time % 60 == 0 ? round($time, 2) : $time % 60
            );
        }

        foreach ($elements as $key => $value) {
            if ($value > 0)
                $result[] = $value . $key;
        }

        return join(" ", $result);
    }
    
    public function cutStringOnLength($value, $length) {
        return strlen($value) > $length ? substr(value, 0, $length) . "..." : $value;
    }
    
    public function takeStringBetween($string, $start, $end) {
        $string = " " . $string;
        $position = strpos($string, $start);
        
        if ($position == 0)
            return "";
        
        $position += strlen($start);
        $length = strpos($string, $end, $position) - $position;
        
        return substr($string, $position, $length);
    }
    
    public function arrayLike($elements, $like, $flat) {
        $result = Array();
        
        if ($flat == true) {
            foreach($elements as $key => $value) {
                $pregGrep = preg_grep("~$like~i", $value);

                if (empty($pregGrep) == false)
                    $result[] = $elements[$key];
            }
        }
        else
            $result = preg_grep("~$like~i", $elements);
        
        return $result;
    }
    
    public function arrayMoveElement(&$array, $a, $b) {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);
    }
    
    public function arrayFindValue($elements, $subElements) {
        $result = false;
        
        foreach ($elements as $key => $value) {
            if (in_array($value, $subElements) == true) {
                $result = true;
                
                break;
            }
        }
        
        return $result;
    }
    
    public function arrayFindKeyWithValue($elements, $label, $item) {
        foreach ($elements as $key => $value) {
            if ($value[$label] === $item )
                return $key;
        }
        
        return false;
    }
    
    public function arrayExplodeFindValue($elementsFirst, $elementsSecond) {
        $elementsFirstExplode = explode(",", $elementsFirst);
        array_pop($elementsFirstExplode);

        $elementsSecondExplode =  explode(",", $elementsSecond);
        array_pop($elementsSecondExplode);
        
        if ($this->arrayFindValue($elementsFirstExplode, $elementsSecondExplode) == true)
            return true;
        
        return false;
    }
    
    public function arrayUniqueMulti($elements, $index, $fix = true) {
        $results = Array();
        
        $a = 0;
        $keys = Array();
        
        foreach ($elements as $key => $value) {
            if (in_array($value[$index], $keys) == false) {
                $results[$a] = $value;
                
                $keys[$a] = $value[$index];
            }
            
            $a ++;
        }
        
        if ($fix == true)
            $results = array_values($results);
        
        return $results;
    }
    
    public function arrayCombine($elementsA, $elementsB) {
        $count = min(count($elementsA), count($elementsB));
        
        return array_combine(array_slice($elementsA, 0, $count), array_slice($elementsB, 0, $count));
    }
    
    public function urlParameters($completeUrl, $baseUrl) {
        $lastPath = substr($completeUrl, strpos($completeUrl, $baseUrl) + strlen($baseUrl));
        $lastPathExplode = explode("/", $lastPath);
        array_shift($lastPathExplode);
        
        return $lastPathExplode;
    }
    
    public function requestParametersParse($parameters) {
        $result = Array();
        $matches = Array();
        
        foreach ($parameters as $key => $value) {
            if (is_object($value) == false)
                $result[$key] = $value;
            else {
                preg_match("#\[(.*?)\]#", $value->name, $matches);
                
                $keyTmp = "";
                
                if (count($matches) == 0)
                    $keyTmp = $value->name;
                else
                    $keyTmp = $matches[1];
                    
                $result[$keyTmp] = $value->value;
            }
        }
        
        return $result;
    }
    
    public function checkToken($token) {
        if (isset($_SESSION['token']) == true && $token == $_SESSION['token'])
            return true;
        
        return false;
    }
    
    public function checkLanguage($settingRow) {
        if (isset($_SESSION['languageTextCode']) == false)
            $_SESSION['languageTextCode'] = $settingRow['language'];
        
        if (isset($_REQUEST["languageTextCode"]) == true)
            $_SESSION['languageTextCode'] = $_REQUEST["languageTextCode"];
    }
    
    public function checkSessionOverTime() {
        if (isset($_SESSION['userActionCount']) == false)
            $_SESSION['userActionCount'] = 0;
        
        if (isset($_SESSION['userInform']) == false || isset($_SESSION['userInformCount']) == false) {
            $_SESSION['userInform'] = "";
            $_SESSION['userInformCount'] = 0;
        }
        
        if (isset($_SESSION['token']) == true && isset($_COOKIE[session_name() . '_REMEMBERME']) == false && isset($_SESSION['userLogged']) == false && $_SESSION['userInform'] == "") {
            $_SESSION['userInform'] = "Session time is over, please login again.";
            
            $isOver = true;
        }
        
        if (isset($_SESSION['token']) == true && isset($_COOKIE[session_name() . '_REMEMBERME']) == false && isset($_SESSION['userLogged']) == true) {
            if (isset($_SESSION['userTimestamp']) == false)
                $_SESSION['userTimestamp'] = time();
            
            $_SESSION['userActionCount'] ++;
            
            $timeElapsed = time() - $_SESSION['userTimestamp'];
            
            $isOver = false;
            
            // Inactivity
            if ($_SESSION['userActionCount'] > 1 && $timeElapsed >= $this->sessionMaxIdleTime) {
                $_SESSION['userInform'] = "Session time is over, please login again.";
                
                $isOver = true;
            }
            
            // Roles changed
            //...
            
            if ($isOver == true) {
                if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) == false && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") {
                    echo json_encode(Array(
                        'userInform' => $_SESSION['userInform']
                    ));

                    exit;
                }
                else {
                    $_SESSION['userActionCount'] = 0;
                    
                    $userInform = $_SESSION['userInform'];

                    $this->sessionUnset();

                    $this->generateToken();

                    $_SESSION['userInform'] = $userInform;

                    return $this->urlRoot;
                }
            }

            $_SESSION['userTimestamp'] = time();
        }
        
        if ($_SESSION['userInform'] != "")
            $_SESSION['userInformCount'] ++;

        if ($_SESSION['userInformCount'] > 1) {
            $_SESSION['userInform'] = "";
            $_SESSION['userInformCount'] = 0;
        }
        
        return false;
    }
    
    public function checkHost($host) {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $host);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36");
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        
        $curlResponse = curl_exec($curl);
        curl_close($curl);
        
        if ($curlResponse == false)
            return false;
        
        return true;
    }
    
    public function replaceString4byte($string, $replacement, $remove = false) {
        $isFind = false;
        
        // A -> 1-3 | B -> 4-15 | C -> 16
        $newString = preg_replace("%(?:\xF0[\x90-\xBF][\x80-\xBF]{2} | [\xF1-\xF3][\x80-\xBF]{3} | \xF4[\x80-\x8F][\x80-\xBF]{2})%xs", $replacement, $string);    
        
        if (strpos($newString, $replacement) !== false)
            $isFind = $string;
        
        if ($remove == true)
            $newString = str_replace($replacement, "", $newString);
        
        return Array(
            $newString,
            $isFind
        );
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