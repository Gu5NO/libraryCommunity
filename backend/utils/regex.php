<?php
class Regex{
    function regexText($text){
        if (preg_match('/^[a-zA-Z\s]+$/', $text)) {
            $resp['status'] = true;
            $resp['tipoMsg'] = "success";
            $resp['msg']     = "Texto validado con éxito";
        } else {
            $resp['status'] = false;
            $resp['tipoMsg'] = "error";
            $resp['msg']     = "El valor contine caracteres invalidos, favor de validar la cadena de texto";
        } 
        return $resp;
    }
}