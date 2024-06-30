<?php
    include("rest/class/api/ws.php");
    class restAuth{
        //private $url 	= 'http://10.16.20.182/DevsCodeTotal/Api/index.php/';        
        //private $url 	= 'http://192.168.0.12/DevsCodeTotal/Api/index.php/';        
        private $url 	= 'http://localhost/libraryCommunity/Api/index.php/';                
       
    function generarToken() {
        $ws = new WS();
        $app = $ws->application('POST', $_SERVER['REQUEST_METHOD'], false, null);
        if ($app['status'] === true) {
            $param = file_get_contents('php://input');
            $p = json_decode($param, true);
            $post = [
                'IPPUBLICA' => empty($p['ipPublica'])? null : $p['ipPublica'],
                'IPINTERNA' => empty($p['ipInterna'])? null:$p['ipInterna'],
                'PAGINA'    => 'LOGIN',
            ];
            $resp = $this->_ConsultaPostSinToken('Token/obtToken', $post);
            echo $resp;
        } else {
            http_response_code($app['code']);
            header('Content-Type: application/json');
            echo json_encode(array("mensaje" => $app['msg']));
            exit;
        }
    }
        function iniciarSesion(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $param = file_get_contents('php://input');
                    $p = json_decode($param, true);
                    $post = [
                        'USER'      => $p['user'],
                        'CONTRA'    => $p['contra'],
                        'TOKEN'     => $p['token']
                    ];
                    $resp = $this->_ConsultaPostToken('Tokn/iniciarSesion',$post);
                    $resp = json_decode($resp);   
                    if($resp->status == true){
                        $this->_generarSession($resp->datos);
                    }
                    echo (json_encode($resp));
            }else{
                http_response_code(405);
                header('Content-Type: application/json');
                echo json_encode(array("mensaje" => "Método no permitido"));
                exit;
            }
        }

        //Funciones genericas
        function _ConsultaPostToken($metodo,$post, $r = false){
            // Inicializar la sesión cURL
	        $ch 	= 	curl_init(); 
           // Ingresar la liga
				        curl_setopt($ch, CURLOPT_URL,$this->url.$metodo ); 
            // Verificación del certificado SSL
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            // Establecer límite de tiempo de conexión
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            // Limitar las redirecciones
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
            // User agent personalizado
                        curl_setopt($ch, CURLOPT_USERAGENT, 'MiUsuarioAgente/1.0');
            //Token Para el consumo del recurso
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-API-KEY:'.$post['TOKEN']));
			// Devolver el resultado en lugar de imprimirlo
				        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
            // Pasar los datos a la opción CURLOPT_POSTFIELDS
				        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	        $output = 	curl_exec($ch); 
	                    curl_close($ch);    
	        if($r) return $output;
	        else return $output;
        }

        function _ConsultaPostSinToken($metodo, $post, $r = false) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url . $metodo);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE); // Establecer como solicitud POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); // Convertir array a cadena de consulta
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // Establecer tipo de contenido
            $output = curl_exec($ch);
            curl_close($ch);
            if ($r) return $output;
            else return $output;
        }

	    private function _generarSession($respuesta){ 
            session_start();    
            $obj = new Security();
            $_SESSION['usuario']= $respuesta->user;
            $_SESSION['rol']    = $respuesta->rol;
            $_SESSION['token']  = $respuesta->token;
            $_SESSION['id']     = $respuesta->id;
            $_SESSION['estatus']= $respuesta->estatus;
            setcookie(session_name(), session_id(), time() + 7200, '/');
            session_write_close();
        }

        //cerrar session
        function cerrar(){
            session_start();
            session_destroy();
            session_write_close();   
            $resp['success'] = true;
            $resp['tipoMsg'] = "success";
            $resp['success'] = "Session cerrada";
            echo (json_encode($resp));       
        }

    }