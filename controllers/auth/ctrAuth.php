<?php
    include("rest/auth/restAuth.php");
class ctrAuth{
    /*-------------------------------------------------
                    VISTAS
    -------------------------------------------------*/   
    public function auth(){ //Vista de Login
        $title = "Login Library Community";
        extract(compact('title'));
        require 'views/auth/layout/login.php';
    }
    public function register(){ //Vista del registro
        $title = "Registro Library Community";
        extract(compact('title'));
        require 'views/auth/layout/register.php';
    } 
    public function resetPassword(){ //Vista del cambio de contraseña
        $title = "Cambio de contraseña Library Community";
        extract(compact('title'));
        require 'views/auth/layout/login.php';
    } 
    public function confirmCode(){ //Vista de la confirmación de la contraseña
        $title = "Confirmar Cambio Library Community";
        extract(compact('title'));
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