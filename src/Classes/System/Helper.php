<?php
require_once(dirname(dirname(__DIR__)) . "/Config.php");
require_once("Database.php");
require_once("Query.php");

class Helper {
    // Vars
    private $sessionMaxIdleTime;
    
    private $config;
    private $database;
    private $query;
    
    private $settingRow;
    
    private $protocol;
    
    private $pathRoot;
    private $pathSrc;
    private $pathPublic;
    
    private $urlRoot;
    private $urlEventListener;
    
    private $supportSymlink;
    
    private $websiteFile;
    private $websiteName;
    
    // Properties
    public function getDatabase() {
        return $this->database;
    }
    
    public function getUrlEventListener() {
        return $this->urlEventListener;
    }
    
    // ---
    
    public function getSessionMaxIdleTime() {
        return $this->sessionMaxIdleTime;
    }
    
    public function getQuery() {
        return $this->query;
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
        
        $this->settingRow = $this->query->selectSettingDatabase();
        
        $this->protocol = $this->config->getProtocol();
        
        $this->pathRoot = $_SERVER['DOCUMENT_ROOT'] . $this->config->getPathRoot();
        $this->pathSrc = "{$this->pathRoot}/src";
        $this->pathPublic = "{$this->pathRoot}/public";
        
        $this->urlRoot = $this->config->getProtocol() . $_SERVER['HTTP_HOST'] . $this->config->getUrlRoot();
        $this->urlEventListener = $this->config->getProtocol() . $_SERVER['HTTP_HOST'] . dirname($this->config->getUrlRoot()) . "/src/EventListener";
        
        $this->supportSymlink = $this->config->getSupportSymlink();
        
        $this->websiteFile = $this->config->getFile();
        $this->websiteName = $this->config->getName();
        
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
    
    // ---
    
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
    
    public function removeCookie($name) {
        if (isset($_COOKIE[$name]) == true) {
            $currentCookieParams = session_get_cookie_params();
            
            setcookie($name, null, time() - 3600, $currentCookieParams['path'], $currentCookieParams['domain'], false, false);
        }
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
        $writing = fopen("{$filePath}.tmp", "w");
        
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
            rename("{$filePath}.tmp", $filePath);
        else
            unlink("{$filePath}.tmp");
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
    
    public function unitFormat($value) {
        $result = "";
        
        if ($value == 0)
            $result = "0 Bytes";
        else {
            $reference = 1024;
            $sizes = Array("Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");
            
            $index = floor(log($value) / log($reference));
            
            $result = round(floatval(($value / pow($reference, $index))), 2) . " " . $sizes[$index];
        }
        
        return $result;
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
    
    public function arrayLike($elements, $like) {
        $result = Array();
        
        foreach ($elements as $key => $value) {
            $result[$key] = preg_grep("~{$like}~i", $value);
            
            if (count($result[$key]) == 0)
                unset($result[$key]);
            else
                $result[$key] = $value;
        }
        
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
    
    public function arrayExplodeFindValue($first, $second, $multi = true) {
        $firstExplode = explode(",", $first);
        array_pop($firstExplode);
        
        if ($multi == true) {
            $secondExplode =  explode(",", $second);
            array_pop($secondExplode);
            
            if ($this->arrayFindValue($firstExplode, $secondExplode) == true)
                return true;
        }
        else {
            if (in_array($second, $firstExplode) == true)
                return true;
        }
        
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
    
    public function checkLanguage() {
        if (isset($_SESSION['languageTextCode']) == false)
            $_SESSION['languageTextCode'] = $this->settingRow['language'];
        
        if (isset($_REQUEST["languageTextCode"]) == true)
            $_SESSION['languageTextCode'] = $_REQUEST["languageTextCode"];
    }
    
    public function checkSessionOverTime() {
        if (isset($_SESSION['currentUser']) == true) {
            $timeElapsed = time() - intval($_SESSION['userOvertime']);
            $userOverRole = false;
            
            if (isset($_SESSION['userOvertime']) == false)
                $timeElapsed = 0;
            
            $currentUser = $_SESSION['currentUser'];
            
            if (is_string($currentUser) == false) {
                // Role changed
            }
            
            if ($timeElapsed >= $this->sessionMaxIdleTime || $userOverRole == true) {
                $_SESSION['userInform'] = "Session time is over, please login again.";
                
                if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) == false && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") {
                    echo json_encode(Array(
                        'userInform' => $_SESSION['userInform']
                    ));
                    
                    exit;
                }
                else {
                    unset($_SESSION['userOvertime']);
                    
                    return $this->forceLogout();
                }
            }
            
            $_SESSION['userOvertime'] = time();
        }
        else {
            if (isset($_SESSION['forceLogout']) == true && $_SESSION['forceLogout'] == 2) {
                $_SESSION['userInform'] = "";
                
                unset($_SESSION['forceLogout']);
            }
            
            if (isset($_SESSION['userInform']) == true && $_SESSION['forceLogout'] != "")
                $_SESSION['forceLogout'] = 2;
        }
        
        return false;
    }
    
    public function forceLogout() {
        $userInform = $_SESSION['userInform'];
        
        $this->sessionUnset();
        
        $this->generateToken();
        
        $_SESSION['userInform'] = $userInform;
        
        $_SESSION['forceLogout'] = 1;
        
        return $this->urlRoot;
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
        $curlError = curl_error($curl);
        $curlInfo = curl_getinfo($curl);
        
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
    
    public function download() {
        if (isset($_SESSION['download']) == true) {
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=\"" . basename("{$_SESSION['download']['path']}/{$_SESSION['download']['name']}") . "\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize("{$_SESSION['download']['path']}/{$_SESSION['download']['name']}"));
            header("Content-Type: {$_SESSION['download']['mime']}");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, pre-check=0, post-check=0");
            header("Pragma: public");
            
            readfile("{$_SESSION['download']['path']}/{$_SESSION['download']['name']}");
            
            if ($_SESSION['download']['remove'] == true)
                unlink("{$_SESSION['download']['path']}/{$_SESSION['download']['name']}");
            
            unset($_SESSION['download']);
            
            return;
        }
        
        echo "404";
    }
    
    public function fileReadTail($path, $limit = 50) {
        $fopen = fopen($path, "r");
        
        fseek($fopen, -1, SEEK_END);
        
        for ($a = 0, $lines = Array(); $a < $limit && ($char = fgetc($fopen)) !== false;) {
            if ($char === "\n") {
                if (isset($lines[$a]) == true) {
                    $lines[$a][] = $char;
                    $lines[$a] = implode("", array_reverse($lines[$a]));
                    
                    $a ++;
                }
            }
            else
                $lines[$a][] = $char;
            
            fseek($fopen, -2, SEEK_CUR);
        }
        
        fclose($fopen);
        
        if (count($lines) > 0 && $a < $limit)
            $lines[$a] = implode("", array_reverse($lines[$a]));
        
        return array_reverse($lines);
    }
    
    public function loginAuthBasic($url, $username, $password) {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36");
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
        
        $curlResponse = curl_exec($curl);
        $curlError = curl_error($curl);
        $curlInfo = curl_getinfo($curl);
        
        curl_close($curl);
        
        return $curlResponse;
    }
    
    public function closeAjaxRequest($response, $memoryLimit = false) {
        echo json_encode(Array(
            'response' => $response
        ));
        
        fastcgi_finish_request();
        ignore_user_abort(true);
        
        if ($memoryLimit == true) {
            set_time_limit(0);
            ini_set("memory_limit", "-1");
        }
    }
    
    public function escapeScript($value) {
        $pattern = "/<script.*?>|<\/script>|javascript:/i";
        $replacement = "";
        
        if (preg_match_all($pattern, $value, $matches) !== false)
            return preg_replace($pattern, $replacement, $value);
        else
            return $value;
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
