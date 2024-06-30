<?php
    require_once('backend/out/admin/outRol.php');
    require_once("backend/utils/regex.php");
    require_once('backend/db/model/mdlRol.php');
    class Rol extends outRol{
        private $rol;
        function __construct(){
            $this->rol = new outRol();            
        }
        public function obtRoles($param){
            echo json_encode($this->rol->obtRoles($param));
        }
        public function guardarRol($param) {
            $regex = new Regex();
            $validarRol = $regex->regexText($param['ROL']);
            if ($validarRol['status'] === true) {
                echo json_encode($this->rol->guardarRol($param));
            } else {
                echo json_encode($validarRol);
            }
        }
        public function borrarRol($param){
            echo json_encode($this->rol->borrarRol($param));
        }        
    }