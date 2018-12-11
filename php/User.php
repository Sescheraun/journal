<?php

    class User {
        private $conn;
        private $id;
        private $userName;
        private $password;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        public function __set($property, $value) {
                $this->$property = $value;
        }

        /********************************************************************************
        **                                 Create User                                 **
        ********************************************************************************/
        
        public function createUser() {

            $query = 'INSERT INTO '
                . 'users (userName, password) '
                . 'VALUES '
                . '(:userName, :password)'
                ;

                $stmt = $this->conn->prepare($query);

                $this->userName = htmlspecialchars(strip_tags($this->userName));
                
                $stmt -> bindParam(':userName', $this->userName);
                
                $password = $this->muckedPassword($this->password) ;
                
                $stmt->bindParam(':password', $password );
            
                echo $this->muckedPassword($this->password) . "\n";

                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
        }


        /********************************************************************************
        **                                 Verify User                                 **
        ********************************************************************************/   
        public function readUsers() {
            
            $query = 'SELECT '
                . 'userName, '
                . 'password '
                . 'FROM '
                . 'users '
                . 'WHERE '
                . 'userName = :userName';

                $stmt = $this->conn->prepare($query);

                $this->userName = htmlspecialchars(strip_tags($this->userName));

                $stmt -> bindParam(':userName', $this->userName);
    
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                return $this->confirmPassword($result[password]);


        
        }
        /********************************************************************************
        **                               Hash Passwords                                **
        ********************************************************************************/

        private function muckedPassword($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }

        /********************************************************************************
        **                              Confirm Password                               **
        ********************************************************************************/

        private function confirmPassword($hash) {
            return password_verify($this->password, $hash);
        }
    }

?>
