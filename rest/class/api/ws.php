<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    date_default_timezone_set('America/Mexico_City');
    include("rest/class/validation/validation.php");
    class WS{
        //VALIDACIÓN DE LAS APIS
        public function application($method,$request,$private,$session){
            $resp = [];
            if($method === $request){
                if($private){
                    $validation = new Validation();
                    if((isset($session['token']) && !empty($session['token'])) && ($validation->validarSession(base64_decode($session['token'])))){
                        $resp['status'] = true;
                        $resp['code']   = 202;
                        $resp['msg']    = "Accepted";
                    }else{
                        $resp['status'] = false;
                        $resp['code']   = 401;
                        $resp['msg']    = "Necesita iniciar sesión para consumir el servicio";        
                    }
                }else{
                    $resp['status'] = true;
                    $resp['code']   = 202;
                    $resp['msg']    = "Accepted";
                }
            }else{
                $resp['status'] = false;
                $resp['code']   = 405;
                $resp['msg']    = "Método no permitido";
            }
            return $resp;
        }
        // VALIDACIÓN DE LAS VISTAS
        // SESSION Y TIPO ROL
        public function routers($private,$session){
            $resp = [];
            if($private){
                echo "Entre a metodo con sesión <br>";
                $validation = new Validation();
                if((isset($session['token']) && !empty($session['token'])) && ($validation->validarSession(base64_decode($session['token'])))){
                    $resp['status'] = true;
                    $resp['code']   = 202;
                    $resp['msg']    = "Accepted";
                }else{
                    var_dump("Entre al Necesitas una sessión par consumir el servicio");
                    $resp['status'] = false;
                    $resp['code']   = 401;
                    $resp['msg']    = "Necesita iniciar sesión para consumir el servicio";        
                }
            }else{
                $resp['status'] = true;
                $resp['code']   = 202;
                $resp['msg']    = "Accepted";
            }
            return $resp;
        }
    }