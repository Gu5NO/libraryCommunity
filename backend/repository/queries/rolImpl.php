<?php
    require_once "backend/config/connection/conexion.php";	
    
    class rolImpl{
        private $conexion;
        public  $obj = [];    
        function __construct(){
            $this->conexion = new conexion();
        }
        
        protected function consultarRoles(Int $limit, Int $offset, String $search,String $sort,String $order){
            $sql  = "   SELECT 	r.id, r.rol
                        FROM    TC_ROL r 
                        WHERE	1 = 1	
                        AND	    r.ESTATUS = 1
                    ";

            if(!empty($search)){
                $sql .= " AND (
                                :search IS NULL 
                            OR  :search = '' 
                            OR  (  
                                        r.ROL LIKE CONCAT('%', :search, '%') 
                                )
                        )";
                $search = '%' . $search . '%';
            }
            $sql .= "   ORDER BY    
                            CASE
                                WHEN :sort IS NULL THEN r.ROL END,
                                CASE 
                                    WHEN :sort = 'ROL' THEN r.ROL 
                                    
                                END
                        $order
                        LIMIT       
                            :limit
                        OFFSET      
                            :offset";

            $bd = $this->conexion->connect();
            $consulta = $bd->prepare($sql);
            $consulta->bindParam(':limit', $limit, PDO::PARAM_INT);
            $consulta->bindParam(':offset', $offset, PDO::PARAM_INT);
            if (!empty($search)) {
                $consulta->bindParam(':search', $search, PDO::PARAM_STR);
            }
            $consulta->bindParam(':sort', $sort, PDO::PARAM_STR);
            $consulta->execute();
            $totalRegistros                 = $consulta->rowCount();
            $respuesta                      = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if($totalRegistros > 0){
                $resp['status']             =  true;
                $resp['msg']                = "Roles obtenidos con éxito";
                $resp["tipoMsg"]            = "success";
                $resp['total']              = $totalRegistros;
                $resp["datos"]              = $respuesta;
                //$resp["sql"]                = $sql;
            }else{
                $resp['status']             = false;
                $resp['msg']                = "No se encontraron roles";
                $resp["tipoMsg"]            = "warning";
                $resp['total']              = 0;
                $resp["datos"]              = $respuesta;
            }
            $bd = null;
            return $resp;
        }

        protected function totalRolesEstatus(Int $estatus){
            $sql  = "	SELECT 		COUNT(r.id) AS total
                        FROM        TC_ROL r 
                        WHERE		1 = 1
                        AND	        r.ESTATUS =:estatus
                    ";
            $bd = $this->conexion->connect();
            $consulta = $bd->prepare($sql);
            $consulta->bindParam(':estatus', $estatus, PDO::PARAM_INT);
            $consulta->execute();
            $respuesta      = $consulta->fetch(PDO::FETCH_ASSOC);
            $resp['status'] = true;
            $resp['msg']    = "El total fue ".$respuesta['total'];
            $resp["tipoMsg"]= "success";
            $resp["datos"]  = $respuesta['total'];
            $bd = null;
            return $resp;
        }

        protected function consultarRolEstatus(String $rol, Int $estatus){
            $sql  = "	SELECT 		*
                        FROM        TC_ROL r 
                        WHERE		1 = 1
                        AND         r.ROL     =:rol 
                        AND	        r.ESTATUS =:estatus
                    ";
            $bd                                 = $this->conexion->connect();
            $consulta                           = $bd->prepare($sql);
            $consulta->bindParam(':rol', $rol, PDO::PARAM_STR);
            $consulta->bindParam(':estatus', $estatus, PDO::PARAM_INT);
            $consulta->execute();
            $totalRegistros                     = $consulta->rowCount();
            $respuesta                          = $consulta->fetch(PDO::FETCH_ASSOC);
            if($totalRegistros > 0){
                if($totalRegistros === 1){
                    $resp['status']             =  true;
                    $resp['msg']                = "Rol obtenido con éxito";
                    $resp["tipoMsg"]            = "success";
                    $resp['total']              = $totalRegistros;
                    $resp["datos"]              = $respuesta;
                    //$resp["sql"]                = $sql;
                }else{
                    $resp['status']             = false;
                    $resp['msg']                = "Se encuentra más de un registro con ese nombre de Rol.";
                    $resp["tipoMsg"]            = "error";
                    $resp['total']              = $totalRegistros;
                    $resp["datos"]              = $respuesta;
                }
            }else{
                $resp['status']             = false;
                $resp['msg']                = "No se encontraro el rol";
                $resp["tipoMsg"]            = "warning";
                $resp['total']              = $totalRegistros;
                $resp["datos"]              = $respuesta;
            }
            $bd = null;
            return $resp;   
        }

        protected function guardarRol(mdlRol $rol){
            $bd = $this->conexion->connect();
            $sql = "    INSERT INTO  
                                    TC_ROL
                                                        ( 
                                                                ROL
                                                            ,   ESTATUS
                                                            ,   UM
                                                            ,   FM
                                                        ) 
                        VALUES 				
                                                        (
                                                                    ?
                                                                ,   1
                                                                ,   ?
                                                                ,   CURRENT_TIMESTAMP()
                                                                
                                                        )
                    ";

            try {
                $consulta   = $bd->prepare($sql);
                $role       = $rol->getRol();
                $um         = $rol->getUm();
                $consulta->bindParam(1, $role, PDO::PARAM_STR);
                $consulta->bindParam(2, $um, PDO::PARAM_STR);
                $resp = [];
                if($consulta->execute()){
                    $resp['status'] = true;
                    $resp['msg']    = "Rol creado con éxito";
                    $resp["tipoMsg"]= "success";
                    $resp['id']     = $bd->lastInsertId();
                }else{
                    $resp['status'] = false;
                    $resp['msg']    = "Ocurrio un error al guardar el rol";
                    $resp["tipoMsg"]= "error";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }finally {
                $bd = null;
            }
            return $resp;            
        }

        protected function actualizarRol(mdlRol $rol){
            $bd  = $this->conexion->connect();
            $sql = "    UPDATE  TC_ROL
                        SET     ROL     = :role,
                                ESTATUS = :estatus,
                                UM      = :user,
                                FM      = CURRENT_TIMESTAMP()
                        WHERE   1       = 1  
                        AND     ID      = :id
                    ";
            try {
                $stmt   = $bd->prepare($sql);
                $id     = $rol->getId();
                $role   = $rol->getRol();
                $user   = $rol->getUm();
                $estatus   = $rol->getEstatus();
                $stmt->bindValue(':role', $role, PDO::PARAM_STR);
                $stmt->bindValue(':user', $user, PDO::PARAM_STR);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':estatus', $estatus, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    $resp['status'] = true;
                    $resp['msg']    = "Rol guardado con éxito";
                    $resp["tipoMsg"]= "success";
                } else {
                    $resp['status'] = false;
                    $resp['msg']    = "Error al guardar el Rol.";
                    $resp["tipoMsg"]= "error";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }finally {
                $bd = null;
            }
            return $resp;            
        }  

        protected function eliminarRol(Int $idRol, String $user){
            $bd = $this->conexion->connect();
            $sql = "    UPDATE  TC_ROL
                        SET     ESTATUS = 0,
                                UM      = :user,
                                FM      = CURRENT_TIMESTAMP()
                        WHERE   1       = 1  
                        AND     ID      = :idRol";
            try {
                $stmt = $bd->prepare($sql);
                $stmt->bindValue(':user', $user);
                $stmt->bindValue(':idRol', $idRol);
                if ($stmt->execute()) {
                    $resp['status'] = true;
                    $resp['msg']    = "Rol eliminado con éxito";
                    $resp["tipoMsg"]= "success";
                } else {
                    $resp['status'] = false;
                    $resp['msg']    = "Error al eliminar el Rol.";
                    $resp["tipoMsg"]= "error";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }finally {
                $bd = null;
            }
            return $resp;            
        }

    }