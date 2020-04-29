<?php

/* PDO Database Class
   Connect to Database
   Create prepared statements
   Bind values
   Return rows and results
*/

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh; // whenever statement is prepared,  the dbh is gonna be used, dbh - database handler
    private $stmt;
    private $error;

    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host' . $this->host . ';dbname=' . $this->dbname;
        $options = array (
            PDO::ATTR_PERSISTENT => true, // establishes a persistent connection
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        // Create PDO instance
        try {
        $this->dbh = new PDO($dsn, $this->user, $this->password, $options);

        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    //Prepare the query
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);

    }
    // Bind values 
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch(true){
                case is_int($value):
                  $type = PDO::PARAM_INT;
                  break;
                case is_bool($value):
                  $type = PDO::PARAM_BOOL;
                  break;
                case is_null($value):
                  $type = PDO::PARAM_NULL;
                  break;
                default:
                  $type = PDO::PARAM_STR;
              }
        }
        $this->stmt->bindValue($param,$value,$type); // check function on Google

    }

    // Execute query

    public function execute() {
        return $this->stmt->execute();

    }

    // Get result as array of objects

    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);

    }

    // Get result as single

    public function single() {
        $this->execute();
       return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count

    public function rowCount () {
        return $this->stmt->rowCount();
    }
}