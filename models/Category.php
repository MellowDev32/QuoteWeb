<?php
    class Category {
        // DB stuf
        private $conn;
        private $table = 'categories';

        // Properties
        public $id;
        public $category;

        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        // Get categories
        public function read() {
            // Create Query
            $query = 'SELECT id, category FROM ' . $this->table;

            //Prepare Statment
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        //Get Single Category
        public function read_single(){
            // Create query
            $query = 'SELECT id, category FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
           
            // prepare statement
           $stmt = $this->conn->prepare($query);

           // Bind ID
           $stmt->bindParam(1, $this->id);

           // Execute Query
           $stmt->execute();

           $row = $stmt->fetch(PDO::FETCH_ASSOC);

           // set properties
           $this->category = $row['category'];
       }

       // Create Category
       public function create(){
        // Create Query
        $query = 'INSERT INTO ' . $this->table . ' 
        SET 
            category = :category';
        
        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $this->category = htmlspecialchars(strip_tags($this->category));

         // bind data
         $stmt->bindParam(':category', $this->category);

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

    // Update Category
    public function update(){
        // Create Query
        $query = 'UPDATE ' . $this->table . ' 
        SET 
            category = :category
        WHERE
            id = :id';
        
        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
         $this->category = htmlspecialchars(strip_tags($this->category));
         $this->id = htmlspecialchars(strip_tags($this->id));

         // bind data
         $stmt->bindParam(':category', $this->category);
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

    // Delete Category
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