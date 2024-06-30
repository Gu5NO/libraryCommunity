<?php
    require_once('backend/out/outToken.php');
    class Token extends outToken{
        
        private $token;
        function __construct(){
            $this->token = new outToken();            
        }
        public function obtToken($param){
            echo json_encode($this->token->generarToken($param));
        }

        
    }