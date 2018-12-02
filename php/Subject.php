<?php
    class Subject {

        private $conn;
        private $id;
        private $category;


        public function __construct($db) {
            $this->conn = $db;
        }

        public function __get($property) {
            
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        public function __set($property, $value) {
            if ($property == '$conn') {
                echo "There is an unhandled exception.";
            } else if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
        



        /** 
         * This is the read all method.
         * 
         * @return full array of the undeleted journal entries.
         */
        
        public function read() {
            
            $query = "SELECT "
            .   "id, "
            .   "category "
            . "FROM "
            .   SUBJECT_TABLE
            . " ORDER by "
            .   "category ";
            
            //  echo $query;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;

        }

    
}
?>
