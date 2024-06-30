<?php
    require_once('backend/out/outUsuario.php');
    require_once("backend/utils/regex.php");
    require_once('backend/db/model/mdlUsuario.php');
    class Usuario extends outUsuario{
        private $usuario;
        function __construct(){
            $this->usuario = new outUsuario();            
        }
        public function guardarUsuario($param) {
            $resp = $this->validarUsuario($param);
            if ($resp["status"] == true) {
                echo json_encode($this->usuario->guardarUsuario($param));
            }else{
                echo  json_encode($resp);
            }
        }  
        private function validarUsuario($data){
            $regex = new Regex();
            $status = true;
            $msg = "Los datos han sido validados con éxito";
            $tipoMsg = "success";
            //SE VALIDACIONES DE VACIOS Y DE REGEX
            //USERNAME
            if(empty($data['USERNAME'])){
                $status = false;
                $msg = "El nombre de usuario viene vacio.";
                $tipoMsg = "warning";
            }else{
                $validarUsername = $regex->regexUsername($data['USERNAME'], 3, 16);
                if($validarUsername["status"] == false){
                    $status = false;
                    $msg    = "El nombre de usuario contiene caracteres invalidos.";
                    $tipoMsg= "error";
                }
            }
            //NOMBRE DE LA PERSONA
            if(empty($data['NOMBRE'])){
                $status = false;
                $msg = "El nombre viene vacio.";
                $tipoMsg = "warning";
            }else{
                $validarNombre = $regex->regexTextSpace($data['NOMBRE'], 1, 100);
                if($validarNombre["status"] == false){
                    $status = false;
                    $msg    = "El nombre contiene caracteres invalidos.";
                    $tipoMsg= "error";
                }
            }
            //APELLIDO PATERNO
            if(empty($data["APATERNO"])){
                $status = false;
                $msg = "El apellido paterno viene vacio.";
                $tipoMsg = "warning";
            }else{
                $validarApellidoP = $regex->regexTextSpace($data['APATERNO'], 1, 100);
                if($validarApellidoP["status"] == false){
                    $status = false;
                    $msg    = "El apellido Paterno contiene caracteres invalidos.";
                    $tipoMsg= "error";
                }
            }
            //APELLIDO MATERNO
            if(!empty($data["AMATERNO"])){
                $validarApellidoM = $regex->regexTextSpace($data['AMATERNO'], 1, 100);
                if($validarApellidoM["status"] == false){
                    $status = false;
                    $msg    = "El apellido Materno contiene caracteres invalidos.";
                    $tipoMsg= "error";
                }
            }
            //TEL
            if(empty($data["TEL"])){
                $status = false;
                $msg = "El teléfono viene vacio.";
                $tipoMsg = "warning";
            }else{
                $validarTel = $regex->regexTelefono($data['TEL']);
                if($validarTel["status"] == false){
                    $status = false;
                    $msg    = "El teléfono contiene caracteres invalidos.";
                    $tipoMsg= "error";
                }
                if($data["TEL"] !== $data["TELV"]){
                    $status = false;
                    $msg    = "El teléfono no coincide con el de validación.";
                    $tipoMsg= "warning";
                }           
            }
            //CORREO
            if(empty($data["CORREO"])){
                $status = false;
                $msg = "El correo viene vacio.";
                $tipoMsg = "warning";
            }else{
                $validarCorreo = $regex->regexCorreo($data['CORREO']);
                if($validarCorreo["status"] == false){
                    $status = false;
                    $msg    = "El Correo contiene caracteres invalidos.";
                    $tipoMsg= "error";
                }
                if($data["CORREO"] !== $data["CORREOV"]){
                    $status = false;
                    $msg    = "El Correo no coincide con el de validación.";
                    $tipoMsg= "warning";
                }           
            }   
            $resp["status"] = $status;
            $resp["msg"]    = $msg;
            $resp["tipoMsg"]= $tipoMsg;
            return $resp;
        }
    }