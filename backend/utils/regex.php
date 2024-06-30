<?php
class Regex{
    function regexText($text, $min = 0, $max=100000000000){
        if (preg_match('/^[a-zA-Z]+$/', $text)) {
            if(strlen($text) > $min && strlen($text) > $max){
                $resp['status']  = true;
                $resp['tipoMsg'] = "success";
                $resp['msg']     = "Texto validado con éxito";
            }else{
                $resp['status']  = true;
                $resp['tipoMsg'] = "success";
                $resp['msg']     = "El username debe de estar entre los ".$min." y ".$max." caracteres";
            
            }
        } else {
            $resp['status']  = false;
            $resp['tipoMsg'] = "error";
            $resp['msg']     = "El valor contine caracteres invalidos, favor de validar la cadena de texto";
        } 
        return $resp;
    }

    function regexUsername($username, $min = 0, $max=100000000000){
        if (preg_match('/^[a-zA-Z0-9_\-@]+$/', $username)) {
            if(strlen($username) > $min && strlen($username) > $max){
                $resp['status']  = true;
                $resp['tipoMsg'] = "success";
                $resp['msg']     = "Texto validado con éxito"; 
            }else{
                $resp['status']  = true;
                $resp['tipoMsg'] = "success";
                $resp['msg']     = "El username debe de estar entre los ".$min." y ".$max." caracteres";
            }
        } else {
            $resp['status']  = false;
            $resp['tipoMsg'] = "error";
            $resp['msg']     = "El valor contine caracteres invalidos, favor de validar la cadena de texto";
        } 
        return $resp;
    }

    function regexTextSpace($text, $min = 0, $max=100000000000){
        if (preg_match('/^[a-zA-Z\s]+$/', $text)) {
            if(strlen($text) > $min && strlen($text) > $max){
                $resp['status']  = true;
                $resp['tipoMsg'] = "success";
                $resp['msg']     = "Texto validado con éxito";
            }else{
                $resp['status']  = true;
                $resp['tipoMsg'] = "success";
                $resp['msg']     = "El username debe de estar entre los ".$min." y ".$max." caracteres";
            
            }
        } else {
            $resp['status']  = false;
            $resp['tipoMsg'] = "error";
            $resp['msg']     = "El valor contine caracteres invalidos, favor de validar la cadena de texto";
        } 
        return $resp;
    }

    function regexCorreo($correo){
        if (preg_match('/^[a-zA-Z0-9.-%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $correo)) {
            $resp['status']  = true;
            $resp['tipoMsg'] = "success";
            $resp['msg']     = "Correo validado con éxito";
        } else {
            $resp['status']  = false;
            $resp['tipoMsg'] = "error";
            $resp['msg']     = "El correo no cuenta con las normas establecidas";
        } 
        return $resp;
    }

    function regexTelefono($telefono){
        if (preg_match('/^\d{10}$/', $telefono)) {
            $resp['status']  = true;
            $resp['tipoMsg'] = "success";
            $resp['msg']     = "Teléfono validado con éxito";
        } else {
            $resp['status']  = false;
            $resp['tipoMsg'] = "error";
            $resp['msg']     = "El teléfono no cuenta con las normas establecidas";
        } 
        return $resp;
    }


    function regexCurp($curp){
        if (preg_match('/^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[0-9]{2}$/', $curp)) {
            $resp['status']  = true;
            $resp['tipoMsg'] = "success";
            $resp['msg']     = "CURP validado con éxito";
        } else {
            $resp['status']  = false;
            $resp['tipoMsg'] = "error";
            $resp['msg']     = "La CURP no cuenta con las normas establecidas";
        } 
        return $resp;
    }

    function regexRFC($rfc){
        if (preg_match('/^[A-Z]{4}[0-9]{6}[A-Z0-9]{3}$/', $rfc)) {
            $resp['status']  = true;
            $resp['tipoMsg'] = "success";
            $resp['msg']     = "RFC validado con éxito";
        } else {
            $resp['status']  = false;
            $resp['tipoMsg'] = "error";
            $resp['msg']     = "El RFC no cuenta con las normas establecidas";
        } 
        return $resp;
    }


}