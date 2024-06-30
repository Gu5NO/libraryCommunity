<?php
    date_default_timezone_set('America/Mexico_City');
    require_once 'backend/db/model/mdlRol.php';
    require_once "backend/repository/admin/rstRol.php";
    require_once "backend/config/core/ws.php";

    class outUsuario{
        private $rol;
        private $ws;
        function __construct() {
            $this->rol = new rstRol();
            $this->ws  = new WS();
        }

        protected function obtRoles($data){
            $app                = $this->ws->application($data, ["ADMIN"]);
            if($app['status'] === true){
                $roles          = $this->rol->findAllRol($data['limit'],$data['offset'],$data['search'],$data['sort'],$data['order']);
                $totalregistros = $this->rol->countRolByEstatus(1);
                return array(
                    'total' => $totalregistros['datos'],
                    'data' => $roles['datos']
                );
            }else{
                header($app['code']);
                echo json_encode(array("mensaje" => $app['msg']));
                exit();
            }
        }

        protected function guardarUsuario($data){
            $app                = $this->ws->application($data, ["ADMIN"]);
            if($app['status'] === true){
                $user = $app['datos'];
                $mdlRol = $this->cargaDatosRol($data,$user);
                $existeRolActivo = $this->rol->findByRolAndEstatus($mdlRol->getRol(),1);
                if($existeRolActivo['total'] === 0){
                    if($mdlRol->getId() === null){
                        $existeRolBorrado = $this->rol->findByRolAndEstatus($mdlRol->getRol(),0);
                        if($existeRolBorrado['status'] === true){
                            $mdlRol->setId($existeRolBorrado['datos']['ID']);
                            try {
                                return $this->rol->updateRol($mdlRol);
                            } catch (Exception $excepcion) {
                                echo "Se produjo una error al guardar el rol: " . $excepcion->getMessage();
                            }
                        }else{
                            try {
                                return $this->rol->createRol($mdlRol);
                            } catch (Exception $excepcion) {
                                echo "Se produjo una error al crear el rol: " . $excepcion->getMessage();
                            }   
                        }
                    }else{
                        try {
                            return $this->rol->updateRol($mdlRol);
                        } catch (Exception $excepcion) {
                            echo "Se produjo una error al editar el rol: " . $excepcion->getMessage();
                        }
                    }
                }else if($existeRolActivo['total'] === 1){
                    $resp["status"] = false;
                    $resp["tipoMsg"]= "warning";
                    $resp["msg"]    = "Ya existe el Rol: ".$mdlRol->getRol();
                    return $resp;
                }else{
                    return $existeRolActivo;
                }    
            }else{
                header($app['code']);
                echo json_encode(array("mensaje" => $app['msg']));
                exit();
            }
        }

        private function cargaDatosRol($data, $user){
            if(!isset($data['ID'])){
                $data['ID'] = null;
            }
            $rol = new mdlRol(strtoupper($data['ROL']),$data['ID'],1,$user->USER);
            return $rol;
        }

        protected function borrarRol($data){
            $app                = $this->ws->application($data, ["ADMIN"]);
            if($app['status'] === true){
                $user = $app['datos'];
                return $this->rol->deleteRol($data['ID'],$user->USER);
            }else{
                header($app['code']);
                echo json_encode(array("mensaje" => $app['msg']));
                exit();
            }
        }
}