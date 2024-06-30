<?php
    include("rest/class/security/security.php");
    date_default_timezone_set('America/Mexico_City');
    class Validation{
        public function validarSession($token){
            $security = new Security();
            $info = json_decode($security->decodificar($token));    
            echo var_dump($info);
            $horaActual = date('Y-m-d H:i:s');
            $dateTimeHoraActual  = new DateTime($horaActual);
            $dateTimeHoraProporcionada = new DateTime($info->exp);
            if ($dateTimeHoraActual < $dateTimeHoraProporcionada) {
                return true;
            } elseif ($dateTimeHoraActual > $dateTimeHoraProporcionada) {
                return false;
            } else {
                return true;
            }
        }
    }