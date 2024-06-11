<?php
$uri = $_SERVER["REQUEST_URI"];
$request = explode('/',$uri);
    if($request === null){
        include('views/error/index.html');
        exit;
    }
    /*---------------------------------------------------------------
               WEB
    ---------------------------------------------------------------*/   
    else if($request[2] == '' || $request[2] == 'index' || $request[2] == 'INDEX'){
        echo "Landing page";
        /*require_once 'routers/web/web.php';
        $libraryCommunity = new web();*/
    }else if($request[2] == 'web' || $request[2] == 'guest'){
        echo $request[3];
    }
    /*---------------------------------------------------------------
               AUTH
    ---------------------------------------------------------------*/
    else if($request[2] == 'auth'){
        echo $request;
        /*require_once 'routers/auth/auth.php';
        $libraryCommunity = new $request[2]();*/
    }
    /*------------------------------------------------------------
                ADMINISTRADOR
    -------------------------------------------------------------*/
    else if($request[2] == 'admin'){
        if($request[3] === 'home'){
            $request[3] = 'admin';
        }
        if($request[3] !== ""){
            $pathRouter   = 'routers/admin/'.$request[3].'.php';
            if(file_exists($pathRouter)) {
                require_once 'routers/admin/'.$request[3].'.php';
                $libraryCommunity = new $request[3]();
            }else{
                include('views/error/index.html');
                exit;
            }
        }else{
            include('views/error/index.html');
            exit;
        }
    }
    /*--------------------------------------------------------------
                  WS API RESTFULL Y ERROR
    ---------------------------------------------------------------*/
    else{
        if($request[2] != "Api"){
            include('views/error/index.html');
            exit;
        }else{
            include('backend/index.php');
        }       
    }
   
    

