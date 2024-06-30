<?php
    class conexion{    
        private $host;
        private $dbname;
        private $username;
        private $password;
        private $charset;
        private $pdo;
        public function __construct()
        {
            $this->host         = "localhost";
            $this->dbname       = "librarycommunity";
            $this->username     = "root";
            $this->password     = "es@u4lv4";
            $this->charset      = "utf8";
            
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

            try {
                $this->pdo = new PDO($dsn, $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        public function connect()
        {
            return $this->pdo;
        }
    }