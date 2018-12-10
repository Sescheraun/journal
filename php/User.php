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
        **                                 Verify User                                 **
        ********************************************************************************/   
        public function readUsers () {

            $query = 'SELECT '
                . 'userName, '
                . 'password '
                . 'FROM '
                . 'user '
                . 'WHERE '
                . 'userName = :userName '
                ;

                $stmt = $this->conn->prepare($query);

                $this->userName = htmlspecialchars(strip_tags($this->userName));

                $stmt -> bindParam(':userName', $this->userName);
    
                $stmt->execute();

                $result = $stmt->get_result();

                echo $result;
    
                return confirmPassword($hashPassword);
        }



        /********************************************************************************
        **                                 Create User                                 **
        ********************************************************************************/
        
        public function createUser() {

            echo $this->password;

            $query = 'INSERT INTO '
                . 'users (userName, password) '
                . 'VALUES '
                . '(:userName, :password)'
                ;

                $stmt = $this->conn->prepare($query);

                $this->userName = htmlspecialchars(strip_tags($this->userName));
                $this->password = htmlspecialchars(strip_tags($this->password));
                
                $stmt -> bindParam(':userName', $this->userName);
                
                $password = $this->muckedPassword($this->password) ;
                
                $stmt->bindParam(':password', $password );
            
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
        }


        /********************************************************************************
        **                               Hash Passwords                                **
        ********************************************************************************/

        private function muckedPassword($password){
            return password_hash($password, PASSWORD_DEFAULT, ["cost" => 15]);
        }

        /********************************************************************************
        **                              Confirm Password                               **
        ********************************************************************************/

        private function confirmPassword(){

        }
    }

?>
