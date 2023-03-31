<?php

namespace Surveyplus\App\Config;

use PDO;
use PDOException;
use Surveyplus\App\Config\DevEnv;

/**
 * Manage Database Connection
 */
class Database{

    /** @var DevEnv An instance of the env class */
    protected DevEnv $env;

    /** @var array Data Source Name, contains all the database connection settings */
    private array $dsn = [];

    /** @var mixed Database connection */
    private $conn;

    public function __construct(){

        // Load the env file here!
        $this->env = new DevEnv(BASE_PATH . "/.env");
        $this->env->load();
        
        if(array_key_exists("DATABASE_HOST", $_SERVER) || array_key_exists("DATABASE_USER", $_SERVER) || array_key_exists("DATABASE_NAME", $_SERVER) || array_key_exists("DATABASE_PASSWORD", $_SERVER) || array_key_exists("DATABASE_PORT", $_SERVER) || array_key_exists("DATABASE_ENGINE", $_SERVER)){

            $this->dsn = [
                "host" => getenv("DATABASE_HOST"),
                "database" => getenv("DATABASE_NAME"),
                "port" =>  getenv("DATABASE_PORT"),
                "username" =>  getenv("DATABASE_USER"),
                "password" =>  getenv("DATABASE_PASSWORD"),
                "driver" =>  getenv("DATABASE_ENGINE")
            ];

        }else{

            $this->dsn = [
                "host" => "localhost",
                "database" => "surveyplus",
                "port" => 33012,
                "username" => "root",
                "password" => "",
                "driver" => "mysql"
            ];

        }


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