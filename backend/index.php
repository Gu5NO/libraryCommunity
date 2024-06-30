<?php
try{
    $uri = explode("index.php",$_SERVER["REQUEST_URI"]);  
    if(!isset($uri[1])){
        throw new Exception("Al consumir el WS API RESTFULL , información incompleta.");
        echo 'Error: ' . $e->getMessage();
    }
    $ctr = explode("/",$uri[1]);
    if(isset($ctr[1]) && isset($ctr[2])) {
        $mtd = isset($ctr[2]) ? $ctr[2] : null;
        $controllerMaster = "controller/" . $ctr[1] . ".php";
        $pathController   = "backend/".$controllerMaster;
        if(file_exists($pathController)) {
            include($controllerMaster);
            unset($_REQUEST['x']);
            $model = new $ctr[1]();
            $p = $_REQUEST;
            if($mtd && method_exists($model, $mtd)) {
                    return $model->$mtd($p);
            } else {
                    throw new Exception("Método no válido.");
            }
        } else {
            throw new Exception("Archivo de controlador no encontrado.");
        }
    } else {
        throw new Exception("Al consumir el WS API RESTFULL , información incompleta.");
    }
}catch(Exception $e) {  
    echo 'Error: ' . $e->getMessage();
}
