<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    date_default_timezone_set('America/Mexico_City');
    require_once "backend/security/RSA.php";
    class WS{
        public function application($request,$role){
            $rsa = new RSA();
            $resp = [];
            if(isset($request['token'])){ //SE VALIDA QUE VENGA UN TOKEN
                $token = $request['token'];
                $user = json_decode($rsa->desencriptar(base64_decode($token)));//SE VALIDA QUE VENGA LA INFORMACIÓN DEL USUARIO
                if(!is_null($user)){
                    if($user->exp > date('Y-m-d H:i:s')){//SE VALIDA QUE NO HAYA EXPIRADO LA TOKEN
                        if(in_array($user->ROL, $role)){ //SE VALIDA QUE EL USUARIO CUENTE CON EL ROL
                            $resp['status'] = true;
                            $resp['code']   = "HTTP/1.1 202 Accepted";
                            $resp['datos']    = $user;
                        }else{
                            $resp['status'] = false;
                            $resp['code']   = "HTTP/1.1 403 Forbidden";
                            $resp['msg']    = "Acceso prohibido para este rol";   
                        }
                    }else{
                        $resp['status'] = false;
                        $resp['code']   = "HTTP/1.1 401 Unauthorized";
                        $resp['msg']    = "La sesión ha caducado, vuelva a iniciar sesión.";
                    }
                }else{
                    $resp['status'] = false;
                    $resp['code']   = "HTTP/1.1 406 Not Acceptable";
                    $resp['msg']    = "Información manipulada, error!!";
                }  
            }else{
                $resp['status'] = false;
                $resp['code']   = "HTTP/1.1 405 Not Allowed";
                $resp['msg']    = "Acceso denegado, falta de credenciales.";
            }
            return $resp;
        }
    }