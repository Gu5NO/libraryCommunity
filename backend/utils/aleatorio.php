<?php
class Aleatorio{

    static function generarPassword() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTVUWXYZ';
        $password = substr(str_shuffle($permitted_chars), 0,8);
        return $password;
    }
    static function generarToken() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTVUWXYZ.#$=?¡¿!@9876543210';
        $token = substr(str_shuffle($permitted_chars), 0,10);
        return $token;
    }
    static function randomText(){
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSATVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 10);
    }
    static function random16(){
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSATVWXYZ1234567890';
        return substr(str_shuffle($permitted_chars), 0, 16);
    }
    static function random8(){
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSATVWXYZ1234567890';
        return substr(str_shuffle($permitted_chars), 0, 16);
    }
    static function random32(){
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSATVWXYZ1234567890';
        return substr(str_shuffle($permitted_chars), 0, 32);
    }

}