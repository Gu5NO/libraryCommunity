<?php
    session_start();
    include("controllers/auth/ctrAuth.php");
    //RUTAS DEL LOGIN
    class auth{
        function __construct(){
            
            /*-------------------------------------------------
                PROTECCIÓN
            -------------------------------------------------*/
            $ws  = new WS();
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
            }else if(count($funcion) == 3){
                $funcion = $funcion[2];
            }else{
                include('views/error/index.html');
            }
            $controller = new ctrAuth();
            /*-------------------------------------------------
                VISTAS 
            -------------------------------------------------*/
            if($funcion === "auth" || $funcion === "login" || $funcion === "index"){//Vista del loggeo
                $app= $ws->routers(false,$_SESSION);
                if($app['status'] === true){
                    return $controller->auth();
                }else{
                    echo "ERROR";
                }
            }
            if($funcion === "register"){//Vista del registro
                $app= $ws->routers(false,$_SESSION);
                if($app['status'] === true){
                    return $controller->$funcion();
                }else{
                    echo "ERROR";
                }
            }
            if($funcion === "resetPassword"){//Vista del cambio de contraseña
                $app= $ws->routers(false,$_SESSION);
                if($app['status'] === true){
                    return $controller->$funcion();
                }else{
                    echo "ERROR";
                }
            }
            if($funcion === "confirmCode"){//Confirma contraseña y codigo de seguridad
                $app= $ws->routers(false,$_SESSION);
                if($app['status'] === true){
                    return $controller->$funcion();
                }else{
                    echo "ERROR";
                }
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

        public function  error(){
            echo "ERROR 404 NO EXISTE EL APARTADO";
            echo "<a href='http://localhost/libraryCommunity/'>Regresar al inicio</a>";
        }
    
    }

    

