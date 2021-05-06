<?php
    class Post {
        // DB stuf
        private $conn;
        private $table = 'quotes';

        // Post Properties
        public $id;
        public $categoryID;
        public $category_name;
        public $quote;
        public $authorID;
        public $author_name;
        public $lim;

        //Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //Get Posts
        public function read() {
            // Create query
            $query = 'SELECT c.category as category_name, q.id, q.categoryID, q.quote, q.authorID, a.author as author_name FROM ' . $this->table . ' q LEFT JOIN categories c ON q.categoryID = c.id LEFT JOIN authors a ON q.authorID = a.id ORDER BY q.id';
            if($this->authorID && $this->categoryID && $this->authorID > 0 && $this->categoryID > 0){
                $query = $query . ' WHERE q.authorId = :authorId AND q.categoryId = :categoryId';
            } else if($this->authorID && $this->authorID > 0){
                $query = $query . ' WHERE q.authorId = :authorId';
            } else if($this->categoryID && $this->categoryID > 0){
                $query = $query . ' WHERE q.categoryId = :categoryId';
            }
            if($this->lim){
                $query = $query . ' LIMIT 0,:lim'; 
            }
            // prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            if($this->lim){
                $this->lim = htmlspecialchars(strip_tags($this->lim));
            }
            if($this->authorID){
                $this->authorID = htmlspecialchars(strip_tags($this->authorID));
            }
            if($this->categoryID){
                $this->categoryID = htmlspecialchars(strip_tags($this->categoryID));
            
                // Bind Data
                $stmt->bindParam(':categoryID', $this->categoryID);
            }
            // Bind Data
            if($this->lim){
                $stmt->bindParam(':lim', $this->lim);
            }
            if($this->authorID){
                $stmt->bindParam(':authorID', $this->authorID);
            }
            if($this->categoryID){
                $stmt->bindParam(':categoryID', $this->categoryID);
            }
            
            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        //Get Single Post
        public function read_single(){
             // Create query
             $query = 'SELECT c.category as category_name, q.id, q.categoryID, q.quote, q.authorID, a.author as author_name FROM ' . $this->table . ' q LEFT JOIN categories c ON q.categoryID = c.id LEFT JOIN authors a ON q.authorID = a.id WHERE q.id = ? LIMIT 0,1';
            
             // prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set properties
            $this->quote = $row['quote'];
            $this->categoryID = $row['categoryID'];
            $this->category_name = $row['category_name'];
            $this->authorID = $row['authorID'];
            $this->author_name = $row['author_name'];
        }

        // Create Post
        public function create(){
            // Create Query
            $query = 'INSERT INTO ' . $this->table . ' 
            SET 
                quote = :quote,
                authorID = :authorID,
                categoryID = :categoryID';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
             $this->quote = htmlspecialchars(strip_tags($this->quote));
             $this->authorID = htmlspecialchars(strip_tags($this->authorID));
             $this->categoryID = htmlspecialchars(strip_tags($this->categoryID));

             // bind data
             $stmt->bindParam(':quote', $this->quote);
             $stmt->bindParam(':authorID', $this->authorID);
             $stmt->bindParam(':categoryID', $this->categoryID);

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

        // Update Post
        public function update(){
            // Create Query
            $query = 'UPDATE ' . $this->table . ' 
            SET 
                quote = :quote,
                authorID = :authorID,
                categoryID = :categoryID
            WHERE
                id = :id';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
             $this->quote = htmlspecialchars(strip_tags($this->quote));
             $this->authorID = htmlspecialchars(strip_tags($this->authorID));
             $this->categoryID = htmlspecialchars(strip_tags($this->categoryID));
             $this->id = htmlspecialchars(strip_tags($this->id));

             // bind data
             $stmt->bindParam(':quote', $this->quote);
             $stmt->bindParam(':authorID', $this->authorID);
             $stmt->bindParam(':categoryID', $this->categoryID);
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

        // Delete Post
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