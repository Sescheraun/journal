<?php 
    

    class journal {
        private $conn;
        private $id;
        private $dateOfEntry;
        private $subject;
        private $subject_description;
        private $entry;
        private $isDeleted;

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
         * This is the get all method.
         * 
         * @return full array of the undeleted journal entries.
         */
        
        public function readAll() {
            $query = "SELECT "
                .   "s.subject as subject_description, "
                .   "p.id, "
                .   "p.subject, "
                .   "p.dateOfEntry, "
                .   "p.entry, "
                .   "p.isdeleted "
                . "FROM "
                .   JOURNAL_TABLE . " p "
                . "LEFT JOIN "
                .    "subject s ON p.subject = s.id"
                . " WHERE "
                .   "p.isDeleted = false "
                . "ORDER by "
                .   "p.id DESC";
                
            // echo $query;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }
    
}
?>