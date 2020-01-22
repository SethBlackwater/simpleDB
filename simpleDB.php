<?php
//simpleDB 2020

//Error Reporting 1 = on, 0 = off
phpErrors(1);

//Database info
require_once "db.php";

//simpleDB
class simpleDB{
    private $host;
    private $user;
    private $pass;
    private $db;
    public $conn;
    public function __construct($user,$pass,$host,$db) {
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->host = $host;
        $this->db_connect();
    }
    private function db_connect(){
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        $this->conn->set_charset('utf-8');
        return $this->conn;
    }
    private function clean($in){
        return mysqli_real_escape_string($this->conn,$in);
    }
    public function selectRows($item,$value,$table){
        $item = $this->clean($item);
        $table = $this->clean($table);
        $sql = "SELECT * FROM `$table` WHERE `$item` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",$value);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        $stmt->close();
        return $arr;
    }
    public function selectRow($item,$value,$table){
        $item = $this->clean($item);
        $table = $this->clean($table);
        $sql = "SELECT * FROM `$table` WHERE `$item` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",$value);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $arr;
    }
    public function insertRow($item,$value,$table){
        $table = $this->clean($table);
        $item_str = '';
        $value_str = '';
        $b='';
        if(is_array($item)){
            foreach($item as $a){
                $item_str .= '`'.$a.'`,'; 
            }
            $item_str = rtrim($item_str,',');
        }
        else{
            $item_str = $item;
        }
        if(is_array($value)){
            foreach($value as $a){
                $value_str .= '?,'; 
                $b .= 's';
            }
            $value_str = rtrim($value_str,',');
        }
        else{
            $value_str = $value;
            $b = 's';
        }
        $item_str = $this->clean($item_str);
        $value_str = $this->clean($value_str);
        $sql = "INSERT INTO `$table`($item_str) VALUES ($value_str)";
        if(!($stmt = $this->conn->prepare($sql))){
            //Add error script
        }
        $stmt->bind_param("$b",...$value);
        $stmt->execute();
        $stmt->close();
    }
};

//PHP error reporting function
function phpErrors($a){if($a==1){ini_set('display_errors',1);ini_set('display_startup_errors',1);error_reporting(E_ALL);}else{}}

?>
