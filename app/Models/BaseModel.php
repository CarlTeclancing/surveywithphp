<?php

namespace Surveyplus\App\Models;

use PDO;
use Surveyplus\App\Config\Database;

/**
 * The Base Model inherited by all models
 */
class BaseModel 
{

    /** @var Database Database Instance in Base Model */
    public Database $db;

    /** @var mixed Database connection variable */
    protected $conn;

    /** @var mixed Statement variable for query manipulations */
    protected $stmt;




    public function __construct()
    {
        $this->db = new Database();

        if($this->db instanceof Database){            
            // Connect to database
            $this->conn = $this->db->connect();
        }
    }


    /**
     * Database select query
     *
     * @param string $query
     * @return this
     */
    public function select(string $query)
    {
        $this->stmt =  $this->conn->prepare($query);
        $this->stmt->execute();
        $this->stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $this;
    }
    

    /**
     * Find all values from query
     *
     * @return array
     */
    public function findAll(){
        return $this->stmt->fetchAll();
    }

 



}