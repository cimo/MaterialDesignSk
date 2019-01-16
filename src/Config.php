<?php
date_default_timezone_set("Japan/Tokyo");

session_write_close();
session_name("material_design_sk_dev");
//session_save_path(dirname(__DIR__) . "/var/sessions");

if (session_id() == "")
    session_start();

class Config {
    // Vars
    private $databaseConnectionFields;
    private $protocol;
    private $pathRoot;
    private $urlRoot;
    private $supportSymlink;
    private $file;
    private $name;
    
    // Properties
    public function getDatabaseConnectionFields() {
        return $this->databaseConnectionFields;
    }
    
    public function getProtocol() {
        return $this->protocol;
    }
    
    public function getPathRoot() {
        return $this->pathRoot;
    }
    
    public function getUrlRoot() {
        return $this->urlRoot;
    }
    
    public function getSupportSymlink() {
        return $this->supportSymlink;
    }
    
    public function getFile() {
        return $this->file;
    }
    
    public function getName() {
        return $this->name;
    }
    
    // Functions public
    public function __construct() {
        $this->databaseConnectionFields = Array("", "", "", Array());
        $this->protocol = isset($_SERVER['HTTPS']) == true ? "https://" : "http://";
        $this->pathRoot = "/projects/material_design_sk";
        $this->urlRoot = "/projects/material_design_sk/public";
        $this->supportSymlink = true;
        $this->file = "index.php";
        $this->name = "M.D. sk 1.0.0";
    }
    
    // Functions private
}