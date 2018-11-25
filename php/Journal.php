<?php 
    

    class Journal {
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
         * This is the read all method.
         * 
         * @return full array of the undeleted journal entries.
         */
        
        public function readAll() {
            $whereClause = " WHERE isDeleted = ? ";

            $bindable = false;

            return $this->read($whereClause, $bindable);
        }

        /**
         * This will be the readById
         * 
         * @return the enttry that matches the id being searched for
         */

         

         /**
          * This will return all entries with a given subject
          * 
          * @return a list of entries with the selected subject.
          */


        private function read($whereClause, $bindable) {
            
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
            . $whereClause
            . "ORDER by "
            .   "p.id DESC";
            
            // echo $query;

            $stmt = $this->conn->prepare($query);

            $stmt -> bindParam(1, $bindable);

            $stmt->execute();

            return $stmt;

        }

    
}
?>