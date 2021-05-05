<?php
    class Database {
        //DB paramaters
        private $host = 'localhost';
        private $db_name = 'quotesdb';
        private $username = 'mgs_user';
        private $password = 'pa55word';
        private $conn;

        // DB connects
        public function connect(){
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }