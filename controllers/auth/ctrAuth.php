<?php
    include("rest/auth/restAuth.php");
class ctrAuth{
    /*-------------------------------------------------
                    VISTAS
    -------------------------------------------------*/   
    public function auth(){ //Vista de Login
        require 'views/auth/layout/login.php';
    } 
    /*-------------------------------------------------
                    REST
    -------------------------------------------------*/
    function generarToken($metodo){
        $param   = $_REQUEST;
        $funcion = new restAuth();
        return     $funcion->$metodo($param);
    }
    function iniciarSesion($metodo){
        $param   = $_REQUEST;
        $funcion = new restAuth();
        return     $funcion->$metodo($param);
    }
}