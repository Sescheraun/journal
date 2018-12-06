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
        /********************************************************************************
        **                                Creat Methods                                **
        ********************************************************************************/        

        // https://www.youtube.com/watch?v=-nq4UbD0NT8&list=PLillGF-RfqbZ3_Xr8do7Q2R752xYrDRAo&index=2

        public function create() {

            $query = 'INSERT INTO '
                . JOURNAL_TABLE 
                . ' (subject, entry)'
                . ' VALUES ('
                . ' :subject,'
                . ' :entry)';
            
            $stmt = $this->conn->prepare($query);

            $this->subject = htmlspecialchars(strip_tags($this->subject));
            $this->entry = htmlspecialchars(strip_tags($this->entry));

            $stmt -> bindParam(':subject', $this->subject);
            $stmt -> bindParam(':entry', $this->entry);
    
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        /********************************************************************************
        **                                Read Methods                                 **
        ********************************************************************************/
        /** 
         * This is the read all method.
         * 
         * @return full array of the undeleted journal entries.
         * Do not forget the table references in the $whereClause
         */
        
        public function readAll() {
            $whereClause = " WHERE p.isDeleted = ? ";

            $bindable = false;
            
            return $this->read($whereClause, $bindable);
        }

        /**
         * This will be the readById
         * 
         * @return the enttry that matches the id being searched for.
         * Do not forget the table references in the $whereClause
         */
        public function readById($id){
            $whereClause = " WHERE p.id = ? ";

            $bindable = $id;

            return $this->read($whereClause, $bindable);
        }
         

         /**
          * This will return all entries with a given subject
          * 
          * @return a list of entries with the selected subject.
         * Do not forget the table references in the $whereClause
          */

          public function readBySubject($subject){
              $whereClause = " WHERE p.subject = ? ";

              $bindable = $subject;

              return $this->read($whereClause, $bindable);
          }


        private function read($whereClause, $bindable) {
            
            $query = "SELECT "
            .   "c.category as subject_description, "
            .   "p.id, "
            .   "p.subject, "
            .   "p.dateOfEntry, "
            .   "p.entry, "
            .   "p.isdeleted "
            . "FROM "
            .   JOURNAL_TABLE . " p "
            . "LEFT JOIN "
            .    "category c ON p.subject = c.id"
            . $whereClause
            . "ORDER by "
            .   "p.id ASC";
            
            $stmt = $this->conn->prepare($query);

            $stmt -> bindParam(1, $bindable);

            $stmt->execute();

            return $stmt;

        }

        /********************************************************************************
        **                                Update Methods                               **
        ********************************************************************************/        

        // https://www.youtube.com/watch?v=-nq4UbD0NT8&list=PLillGF-RfqbZ3_Xr8do7Q2R752xYrDRAo&index=2

        public function update() {

            $query = 'UPDATE '
                . JOURNAL_TABLE 
                . ' SET '
                . ' subject = :subject'
                . ' , entry = :entry'
                . ' WHERE'
                . ' id = :id'
                . ' AND isDeleted = 0';
            
            $stmt = $this->conn->prepare($query);

            $this->subject = htmlspecialchars(strip_tags($this->subject));
            $this->entry = htmlspecialchars(strip_tags($this->entry));

            $stmt -> bindParam(':subject', $this->subject);
            $stmt -> bindParam(':entry', $this->entry);
            $stmt -> bindParam(':id', $this->id);
    
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

    
}
?>