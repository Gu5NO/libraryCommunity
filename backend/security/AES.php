<?php    
    class AES{
        public static function encriptar($text){
            $key = "L1br4ryC0mmun1ty_@libraryCommunity";
            $key = str_pad($key, 32, "\0");
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
            $ciphertext = openssl_encrypt($text, 'aes-256-cbc', $key, 0, $iv);
            $encoded = base64_encode($iv . $ciphertext);
            return $encoded;
        }
        public static function desencriptar($hast){
            $key = "L1br4ryC0mmun1ty_@libraryCommunity";
            $decoded = base64_decode($hast);
            $iv = substr($decoded, 0, openssl_cipher_iv_length('aes-256-cbc'));
            $ciphertext = substr($decoded, openssl_cipher_iv_length('aes-256-cbc'));
            $key = str_pad($key, 32, "\0");
            $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);
            return $plaintext;
        }
    }