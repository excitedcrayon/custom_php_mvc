<?php
#PDO Database Class
#Connects to the MySQL Database
#Creates PrepareStatement
#Bind Values
#Returns Rows and Results

class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;

    private $dbHandler; // ued when preparing statements
    private $statement;
    private $error;

    public function __construct(){
        // Set DSN
        //$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
        $dsn = "mysql:host=$this->host;dbname=$this->database";
        $options = array(
            // persistent connection, increased perfomance by checking
            // for existing connection to the database
            PDO::ATTR_PERSISTENT => true,
            // error mode types (silent | warning | exception)
            // in this case we are using exception
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO Instance
        try{
            $this->dbHandler = new PDO($dsn, $this->user, $this->password, $options);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with Query
    public function query($sql){
        $this->statement = $this->dbHandler->prepare($sql);
    }

    // Bind  values
    // type by default is null
    public function bind($param, $value, $type = null){
        if(is_null($type)){
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

        $this->statement->bindValue($param, $value, $type);
    }

    // Execute the Prepared Statement
    public function execute(){
        return $this->statement->execute();
    }

    // Get result as array of objects
    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Fetch a single row | Get result of a single record
    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->statement->rowCount();
    }
}
?>
