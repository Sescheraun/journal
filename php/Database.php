<?php 
    include("connectVars.php");
    class Database{
        private $conn;

        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD );
                $this-conn-setAttribute(PDO::ATTR_ERRMODE, PDO::ERR_ECEPTION);
            } catch(PDOException $pdoException) {
                echo "Connection to database failed"; 
            }

            return $this->conn;
        }

    }
?>