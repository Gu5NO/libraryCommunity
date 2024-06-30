<?php
    date_default_timezone_set('America/Mexico_City');
    require_once 'backend/db/model/mdlToken.php';
    require_once "backend/repository/rstToken.php";
    require_once "backend/utils/aleatorio.php";
    class outToken{
        private $token;
        function __construct() {
            $this->token    = new rstToken();
        }
        //FUNCIÓN PARA CREAR EL TOKEN DE LA PAGINA
        protected function generarToken($data){
            // SE MANDA A GENERAR EL TOKEN
            $token = Aleatorio::random16();
            $hash  = hash('sha256', $token);
            // SE SETTEA EL TOKEN
            //$mdlToken = new mdlToken($hash,$data['PAGINA'],$data['IPPUBLICA'],$data['IPINTERNA']);
            $mdlToken = new mdlToken($hash,$data['PAGINA'],'192.168.0.10','10.16.104.87');
            try {
                $respuesta =  $this->token->saveToken($mdlToken);
            } catch (Exception $excepcion) {
                echo "Se produjo un error al guardar el token: " . $excepcion->getMessage();
            }
        
            if($respuesta['status'] === true){
                $resp['status'] = $respuesta['status'];
                $resp['datos']  = $hash;
                $resp['msg']    = "Hash generado con éxito";
                $resp['tipoMsg']= "success";
                return $resp;
            } else {
                // En caso de error, puedes devolver un mensaje o manejarlo adecuadamente.
                return [
                    'status' => false,
                    'msg' => 'No se pudo guardar el token correctamente',
                    'tipoMsg' => 'error'
                ];
            }
        }
        
}