<?php
    class Database {
        //DB paramaters
        private $host = 'frwahxxknm9kwy6c.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $db_name = 'tkuv2gd5bfiq5mtz';
        private $username = 'svfbin0h54imco92';
        private $password = 'mjewed91hw92azkq';
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