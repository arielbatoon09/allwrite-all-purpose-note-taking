<?php
    class database
    {
        private $db_host;
        private $db_user;
        private $db_pass;
        private $dbms;
        private $conn;
        private $status;

        function __construct()
        {
            $this->db_host = "localhost";
            $this->db_user = "root";
            $this->db_pass = "";
            $this->dbms = "allwrite";
            $this->status = false;
            $this->conn = $this->init();
        }
        public function getStatus(){
            return $this->status;
        }
        public function getConnection(){
            return $this->conn;
        }
        public function destroyConnection(){
            return $this->conn = null;
        }
        private function init(){
            try{
                $conn = new PDO("mysql:host=$this->db_host;dbname=".$this->dbms, 
                $this->db_user, $this->db_pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->status = true;
                return $conn;

            }catch(PDOException $error){
                echo "Connection Failed: ".$error->getMessage();
            }
        }
    }
?>