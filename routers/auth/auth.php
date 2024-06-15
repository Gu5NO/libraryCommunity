<?php
    include("controllers/auth/ctrAuth.php");
    //RUTAS DEL LOGIN
    class auth{
        function __construct(){
            /*-------------------------------------------------
                URL
            -------------------------------------------------*/
            $url = $_GET['x'];
            $uri = rtrim($url,'/'); 
            $funcion = explode('/',$uri);
            if(count($funcion) == 1){
                $funcion = $funcion[0];
            }else if(count($funcion) == 2){
                $funcion = $funcion[1];
            }else{
                include('views/error/index.html');
            }
            $controller = new ctrAuth();
            /*-------------------------------------------------
                VISTAS 
            -------------------------------------------------*/
            if($funcion === "auth" || $funcion === "login"){//Vista del loggeo
                return $controller->auth();
            }
            /*-------------------------------------------------
                REST 
            -------------------------------------------------*/
            if($funcion === "generarToken"){
                return $controller->$funcion($funcion);
            }
            if($funcion === "iniciarSesion"){
                return $controller->$funcion($funcion);
            }
            /*-------------------------------------------------
                ERROR
            -------------------------------------------------*/
        }
    }

    

