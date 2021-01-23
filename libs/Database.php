<?php
class Database {

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "inventario";
    
    private static $instance = null;
    private static $connect;
    private static $result;
    private function __clone(){}
    private function __construct(){
        $this->connectDB();
    }
    public static function getInstance() : Database {
        if(self::$instance == null ) self::$instance = new Database;
        return self::$instance;
    }

    private function connectDB() {
        try {
            self::$connect = new PDO("mysql:hots={$this->host};dbname={$this->dbname};charset=utf8", $this->user, $this->pass);
            //self::$connect->setAttribute(PDO::ATTR_EMULATE_PREPARES,0);
        }catch(PDOException $e) {
            die("Error: It has been imposible to connect to database ".$e->getMessage());
        }
         
    }
    public function query($sql, $params = []){
        self::$result = self::$connect->prepare($sql);
        self::$result->execute($params); 
    }
    public function getRow($class = "stdClass") {
        return self::$result->fetchObject($class);
    }
    public function __destruct() {
        self::$connect = [];
    }


}
