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
    }