<?php
require_once('backend/repository/queries/tokenImpl.php');
class rstToken extends tokenImpl{
    private $token;
    function __construct(){
      $this->token = new tokenImpl();            
    }
    
    public function saveToken(mdlToken $token){
      return $this->token->insertarToken($token); 
    }

    public function findTokenAndEstatus(String $token, Int $estatus){
      return $this->token->obtenerToken($token,$estatus); 
    }

    public function disabledToken(Int $idToken){
      return $this->token->deshabilitarToken($idToken); 
    }
    
}