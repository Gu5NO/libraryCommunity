<?php
    session_start();
    include("rest/class/api/ws.php");
    class restRol{
       //private $url 	= 'http://10.16.20.182/DevsCodeTotal/Api/index.php/';        
       //private $url 	= 'http://192.168.0.12/DevsCodeTotal/Api/index.php/';        
       private $url 	= 'http://localhost/libraryCommunity/Api/index.php/';        
        function obtRoles(){
            $ws = new WS();
            $app= $ws->application('GET',$_SERVER['REQUEST_METHOD'],true,$_SESSION);
            if ($app['status'] === true) {
                $p  = $_REQUEST;
                if(
                            isset($p['search']) &&  isset($p['sort'])  &&  isset($p['order'])  
                        &&  isset($p['offset']) &&  isset($p['limit'])
                ){
                            $post   = [ 
                            "search"=>$p['search'],
                            "sort"  =>$p['sort'],
                            "order" =>$p['order'],
                            "offset"=>$p['offset'],
                            "limit" =>$p['limit'],
                            'token' =>$_SESSION['token']
                        ];
                        $resp   = $this->_ConsultaPostToken('admin/Rol/obtRoles',$post);
                        echo $resp;
                }else{
                        http_response_code(400);
                        header('Content-Type: application/json');
                        echo json_encode(array("mensaje" => "Ocurrio un error al intentar consumir el recurso"));
                        exit;     
                }
            }else{
                http_response_code($app['code']);
                header('Content-Type: application/json');
                echo json_encode(array("mensaje" => $app['msg']));
                exit;
            }
        }
        
        function guardarRol(){
            $ws = new WS();
            $app= $ws->application('POST',$_SERVER['REQUEST_METHOD'],true,$_SESSION);
            if ($app['status'] === true) {
                $param = file_get_contents('php://input');
                $p = json_decode($param, true);
                if(isset($p['rol'])){
                    $post = [
                        'ID'        => empty(!$p['id']) ? $p['id'] : null,
                        'ROL'       => $p['rol'],
                        'token'     => $_SESSION['token']
                    ];
                    $resp = $this->_ConsultaPostToken('admin/Rol/guardarRol',$post);
                    echo $resp;
                }else{
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(array("mensaje" => "Ocurrio un error al intentar consumir el recurso"));
                    exit; 
                }
            }else{
                http_response_code($app['code']);
                header('Content-Type: application/json');
                echo json_encode(array("mensaje" => $app['msg']));
                exit;
            }
        }
        function borrarRol(){
            $ws = new WS();
            $app= $ws->application('DELETE',$_SERVER['REQUEST_METHOD'],true,$_SESSION);
            if ($app['status'] === true) {
                $param = file_get_contents('php://input');
                $p = json_decode($param, true);
                if(isset($p['id'])){
                    $post   = [ 
                        "ID"    =>  $p['id'],
                        'token' =>  $_SESSION['token']
                    ];
                    $resp   = $this->_ConsultaPostToken('admin/Rol/borrarRol',$post);
                    echo $resp;
                }else{
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(array("mensaje" => "Ocurrio un error al intentar consumir el recurso"));
                    exit; 
                }
            }else{
                http_response_code($app['code']);
                header('Content-Type: application/json');
                echo json_encode(array("mensaje" => $app['msg']));
                exit;
            }
        }

        function _ConsultaPostToken($metodo,$post, $r = false){
            // Inicializar la sesión cURL
	        $ch 	= 	curl_init(); 
           // Ingresar la liga
				        curl_setopt($ch, CURLOPT_URL,$this->url.$metodo ); 
            // Verificación del certificado SSL
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            // Establecer límite de tiempo de conexión
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
            // Limitar las redirecciones
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_MAXREDIRS, 120);
            // User agent personalizado
                        curl_setopt($ch, CURLOPT_USERAGENT, 'MiUsuarioAgente/1.0');
            //Token Para el consumo del recurso
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-KEY:'.$_SESSION['token']));
			// Devolver el resultado en lugar de imprimirlo
				        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
            // Pasar los datos a la opción CURLOPT_POSTFIELDS
				        //curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	        $output = 	curl_exec($ch); 
	        curl_close($ch);    
	        if($r) return $output;
	        else return $output;
        }
	 
    }