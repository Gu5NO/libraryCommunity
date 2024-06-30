<?php
    require_once "backend/config/connection/conexion.php";	
    
class tokenImpl{
	private $conexion;
	public  $obj = [];    
	
    function __construct(){
		$this->conexion = new conexion();
    }

	protected function insertarToken(mdlToken $token){
	    $sql =  "   INSERT INTO  
                                TC_TOKEN
                                                    ( 
															TOKEN
                                                        ,   PAGINA
														,	IP_PUBLICA
														,	IP_INTERNA
                                                        ,   ESTATUS
                                                        ,   FM
                                                        
                                                    ) 
                    VALUES 				
                                                    (
                                                              	?
                                                            ,   ?
                                                            ,   ?
                                                            ,   ?
                                                            ,   1
                                                            ,   CURRENT_TIMESTAMP()
                                                    )
                ";
        $bd             = $this->conexion->connect();
        $consulta       = $bd->prepare($sql);
        $tokenPage      = $token->getToken();
        $pagina         = $token->getPagina();
        $ipPublica      = $token->getIpPublica();
        $ipInterna      = $token->getIpInterna();
        $consulta->bindParam(1, $tokenPage, PDO::PARAM_STR);
        $consulta->bindParam(2, $pagina, PDO::PARAM_STR);
        $consulta->bindParam(3, $ipPublica, PDO::PARAM_STR);
        $consulta->bindParam(4, $ipInterna, PDO::PARAM_STR);
        $resp = [];
        if($consulta->execute()){
            $resp['status'] 	= true;
            $resp['msg'] 		= 'Se guardo el token con éxito.';
            $resp['tipoMsg'] 	= 'success';
        }else{
            $resp['status']	    = false;
            $resp['msg'] 		= 'No fue posible guardar el token.';
            $resp['tipoMsg'] 	= 'error';
        }
        $bd = null;
        return $resp;
	} 

    protected function obtenerToken(String $token, Int $estatus){
		$sql  = "	SELECT  *
                    FROM    TC_TOKEN
                    WHERE   1       =   1
                    AND     TOKEN   = :token
                    AND     ESTATUS = :estatus
				";
        $bd = $this->conexion->connect();
        $consulta = $bd->prepare($sql);
        $consulta->bindParam(':token', $token, PDO::PARAM_STR);
        $consulta->bindParam(':estatus', $estatus, PDO::PARAM_INT);
        $consulta->execute();
        $totalRegistros = $consulta->rowCount();
        if($totalRegistros > 0){
            if($totalRegistros === 1){
                $respuesta                  = $consulta->fetch(PDO::FETCH_ASSOC);
                $resp['status']             =  true;
                $resp['msg']                = "Token obtenido con éxito";
                $resp["tipoMsg"]            = "success";
                $resp['totalRegistros']     = $totalRegistros;
                $resp["datos"]              = $respuesta;
            }else{
                $resp['status'] = false;
                $resp['msg']    = "Hay inconsistencias con el resultado, hay más de un token";
                $resp["tipoMsg"]= "error";
            }        
        }else{
            $resp['status'] = false;
            $resp['msg']    = "No se encontro algún registro del token";
            $resp["tipoMsg"]= "warning";
        }
        $bd = null;
        return $resp;
    }


    protected function deshabilitarToken(Int $idToken){
        $bd = $this->conexion->connect();
        $sql = "    UPDATE  TC_TOKEN
                    SET     ESTATUS = 0,
                            FM = CURRENT_TIMESTAMP()
                    WHERE   1 = 1  
                    AND     ID = :idToken";
        try {
            $stmt = $bd->prepare($sql);
            $stmt->bindValue(':idToken', $idToken);
            if ($stmt->execute()) {
                $resp['status'] = true;
                $resp['msg'] = "El token se a deshabilitado con éxito";
                $resp["tipoMsg"] = "success";
            } else {
                $resp['status'] = false;
                $resp['msg'] = "Error al deshabilitar el token.";
                $resp["tipoMsg"] = "error";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }finally {
            $bd = null;
        }
        return $resp;            
    }

	/*
	
	protected function insertarToken($token){
		$sql = "    INSERT INTO  
                                TC_TOKEN
                                                    ( 
															TOKEN
														,	IP_PUBLICA
														,	IP_INTERNA
                                                        ,   ESTATUS
                                                        ,   UM
                                                        ,   FM
                                                        
													) 
                    VALUES 				
                                                    (
                                                              	'".$token->getToken()."' 
                                                            ,	'".$token->getIpPublica()."'
															,	'".$token->getIpInterna()."'
															,   '".$token->getEstatus()."'
															,   '".$token->getUm()."'
                                                            ,   NOW()
                                                    )
                    ";
        $query 		= mysqli_query($this->conexion,$sql);
        if ($query>=1) {
            $resp['status'] 	= true;
            $resp['msg'] 		= 'Se guardo el token con éxito.';
            $resp['tipoMsg'] 	= 'success';
            // $resp['sql'] 		= $sql;
        }else{
            $resp['status']	= false;
            $resp['msg'] 		= 'No fue posible guardar el token.';
            $resp['tipoMsg'] 	= 'error';
            $resp['sql'] 		= $sql;
        }
        return $resp;
	}
   
    public function _repuesta($query,$sql){
        if($query){
		    if (mysqli_num_rows($query) > 0 ) {
				for ($i=0; $i < mysqli_num_rows($query) ; $i++) { $resp[] = $query->fetch_assoc();}
				$arrResp['status'] 		= true;
				$arrResp['error'] 		= false;
				$arrResp['datos'] 		= $resp;
				$arrResp['Numero_reg'] 	= mysqli_num_rows($query);
				$arrResp['msg'] 		= 'Éxito en la consulta';
				$arrResp['tipoMsg'] 	= 'success';
				$arrResp['sql'] 		= preg_replace("/[\t]+/", " ", preg_replace("/[\r\n|\n|\r]+/", " ", $sql));
			}else{
				$arrResp['status'] 		= true;
				$arrResp['error'] 		= true;
				$arrResp['datos'] 		= '';
				$arrResp['Numero_reg'] 	= mysqli_num_rows($query);
				$arrResp['msg'] 		= 'No se encontró ningún registro';
				$arrResp['tipoMsg'] 	= 'info';
    			$arrResp['sql'] 		= preg_replace("/[\t]+/", " ", preg_replace("/[\r\n|\n|\r]+/", " ", $sql));
			}
		}else{
				$arrResp['status'] 	= false;
				$arrResp['error'] 		= true;
				$arrResp['datos'] 		= '';
				$arrResp['Numero_reg'] 	= 0;
				$arrResp['msg'] 		= 'Error al consultar, hay algo mal en el Query.';
				$arrResp['tipoMsg'] 	= 'error';
				$arrResp['sql'] 		= preg_replace("/[\t]+/", " ", preg_replace("/[\r\n|\n|\r]+/", " ", $sql));
		}
		return $arrResp;	
	}*/
}