<?php
    class Author {
        // DB stuf
        private $conn;
        private $table = 'authors';
        
        // Properties
        public $id;
        public $author;

        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get Authors
        public function read() {
            // Create Query
            $query = 'SELECT id, author FROM ' . $this->table;

            //Prepare Statment
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        //Get Single Author
        public function read_single(){
            // Create query
            $query = 'SELECT id, author FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
           
            // prepare statement
           $stmt = $this->conn->prepare($query);

           // Bind ID
           $stmt->bindParam(1, $this->id);

           // Execute Query
           $stmt->execute();

           $row = $stmt->fetch(PDO::FETCH_ASSOC);

           // set properties
           $this->author = $row['author'];
       }

       // Create Author
       public function create(){
        // Create Query
        $query = 'INSERT INTO ' . $this->table . ' 
        SET 
            author = :author';
        
        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $this->author = htmlspecialchars(strip_tags($this->author));

         // bind data
         $stmt->bindParam('author', $this->author);

         // Execute Query
         if($stmt->execute()){
            return true;
         }
         else {
            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
         }
    }

    // Update Author
    public function update(){
        // Create Query
        $query = 'UPDATE ' . $this->table . ' 
        SET 
            author = :author
        WHERE
            id = :id';
        
        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $this->author = htmlspecialchars(strip_tags($this->author));
         $this->id = htmlspecialchars(strip_tags($this->id));

         // bind data
         $stmt->bindParam(':author', $this->author);
         $stmt->bindParam(':id', $this->id);

         // Execute Query
         if($stmt->execute()){
            return true;
         }
         else {
            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
         }
    }

    // Delete Author
    public function delete(){
        // Create Query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind Data
        $stmt->bindParam(':id', $this->id);

        // Execute Query
        if($stmt->execute()){
            return true;
         }
         else {
            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
         }
    }
    }