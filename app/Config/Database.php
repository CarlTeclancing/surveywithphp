<?php

namespace Surveyplus\App\Config;

use PDO;
use PDOException;

/**
 * Manage Database Base actions
 */
class Database{

    /** @var array Data Source Name, contains all the database connection settings */
    private array $dsn = [];

    /** @var mixed Database connection */
    private $conn;

    public function __construct(){

        $this->dsn = [
            "host" => "localhost",
            "database" => "surveyplus",
            "port" => 3306,
            "username" => "root",
            "password" => "",
            "driver" => "mysql"
        ];

    }


    /**
     * Connect the database
     * @return void
     */
    public function connect()
    {   
       try{
            $this->conn = new PDO($this->dsn['driver'].":host=".$this->dsn['host'].";port=".$this->dsn['port'].";dbname=".$this->dsn['database'], $this->dsn['username'], $this->dsn['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;

       } catch(PDOException $e){
            echo "Connection Failed " . $e->getMessage();
       }

    }





}