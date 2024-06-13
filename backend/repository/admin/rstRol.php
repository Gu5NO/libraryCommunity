<?php
    require_once('backend/repository/admin/queries/rolImpl.php');
    class rstRol extends rolImpl{
        private $rol;
        function __construct(){
            $this->rol = new rolImpl();            
        }
          
        public function findAllRol(Int $limit, Int $offset,String $search, String $sort,String $order){
            return $this->rol->consultarRoles($limit, $offset, $search, $sort, $order); 
        }
      
        public function countRolByEstatus(Int $estatus){
              return $this->rol->totalRolesEstatus($estatus); 
        }
      
        public function findByRolAndEstatus(String $rol, Int $estatus){
            return $this->rol->consultarRolEstatus($rol, $estatus); 
        }
      
        public function createRol(mdlRol $rol){
            return $this->rol->guardarRol($rol); 
        }
      
        public function updateRol(mdlRol $rol){
            return $this->rol->actualizarRol($rol); 
        }
      
        public function deleteRol(Int $idRol, String $user){
            return $this->rol->eliminarRol($idRol, $user); 
        }
      
    }