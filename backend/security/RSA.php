<?php    
    class RSA{
        private $publicKey;
        private $privateKey;
        function __construct(){
            $this->publicKey = <<<EOD
            -----BEGIN PUBLIC KEY-----
            MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAl9gYJZeGEhjcheWCElKKXz4qzWD2UiJqKvJ1bQ/VUnPnXREzsUlFoqz6S5UuHgBAmNgJKg3doZZpd/W55Fm8fszCinFpX3534af0pnEBEhDns0InfwsJPWMqheHhvu1G8/BTt9MiGI+LknpqagEQ8UC+Zg0cLq+WqjL20895TOBoWEkDbuIgbkHpnkHPlB1Mydxtedq4Mo8tioYuhO5obmq0QOTaH5NGKtuWsKUjrA/RWUI1CJGkQuu9To+CZ1uMqkajD7turhvUEXSwaAb5ddOtR71N0wlMOhb4y7PSoO0ItJcdIaMQWzSaOuPxKUsE2ud5z9gRmcIDeTKbJzPQPwIDAQAB
            -----END PUBLIC KEY-----
            EOD;
            $this->privateKey = <<<EOD
            -----BEGIN RSA PRIVATE KEY-----
            MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCX2Bgll4YSGNyF5YISUopfPirNYPZSImoq8nVtD9VSc+ddETOxSUWirPpLlS4eAECY2AkqDd2hlml39bnkWbx+zMKKcWlffnfhp/SmcQESEOezQid/Cwk9YyqF4eG+7Ubz8FO30yIYj4uSempqARDxQL5mDRwur5aqMvbTz3lM4GhYSQNu4iBuQemeQc+UHUzJ3G152rgyjy2Khi6E7mhuarRA5Nofk0Yq25awpSOsD9FZQjUIkaRC671Oj4JnW4yqRqMPu26uG9QRdLBoBvl1061HvU3TCUw6FvjLs9Kg7Qi0lx0hoxBbNJo64/EpSwTa53nP2BGZwgN5MpsnM9A/AgMBAAECggEAFh/RXODYExj2QLgxHJRUPw5i1Cv1mAAVsg5D19E/xtTGeEQCYSmI8Ov9SDgDUTG+N8b6htsgWOP+mBEAtenxUhRpoBxoOxbFRube+cVrX4OBDxhrgtJL1Vr2ni1MZDJUbUSuHhGwXR3FO2GE0c839b72Pw5X9eF1tXTZjAEl7nJmblsfkNwWtebM1TLRWitLBniBCq3j0f+FPqU7F48UIbsBBZtuejL6SFmV+45DhGaUQL3CD6zSVlj4yc4WZrVjMk502tf4F9654aqdHo+sSegBlVo2DvU1c8H7s8k3d2NpPZafoXZ5zpWDA722yOD7yVKzUuDq41HMgz9sN5CpeQKBgQDYQ0BBpApMcS2w7qJKKJNY6e3G5ZgOSguJGKsc0WYxBnspx1rNU53vOsMqu2U7B3xa5VDL8/PthhTPNLyM5qAbqNZZ0YV464uWon/S8K6YGNmKQYw7OxShEU0zttAryqlUs7jTJGuFPh15gWWvOnOtCfzRBhQ1FOZM1oNwHqpIfQKBgQCzvqrR7o/iTg45Kys1ZTHTcStwomQANbA/BYHovh369OTuYDglXR4MuLYalq/4A3Noh8gMoZTW9Sg9CGbHXrC4aAva3Kg/tCv7CyjoQ/wNyKJuX/sYTKRPjbZ0eQzZuzDJLr4IJMjJrzfYfn5go+p+YtouY52xBz0/19kxOgDUawKBgQCHj7hirSpLepKSmzOd2stqa9DB4b+sDVwnxw/T06sERjTEHpPbq3OPtz0Jt0ggdXPNInvALR6VoHvA2yTqCdMJI4+h48WP486vURNhLb+z1bffg3Ec2871m/vR0+Gv4ay9TJ8ps2W2sxYUyTjtW22RZXZVrELUd1JZjgn8KSzCnQKBgD3v6r7yXMRXr1EFzhrVJwk8SwLCAoGL/pKI3E4ODRioAKcfotlFMBCkKaQZ3sMwtTkE6OtpVneH/PijB3+V4oF44PTm6lchR7J3Ev6ORrGdPFOaYVTrPAdpxsB14fa5KUN6BuOZgVL2POEuHXBBq5EnkRVBIFqbKwDv6RisaxLHAoGBANDuPAZXMT/ASK7fwrvED/PvBT8h0/6x87diuazkOx8jiMmyVth0GFL9zyII6pnHrIqqaQTaDZweNZvnhMZgBz8lP1PnrgAEaZwjqh01E6+JVlkezGFUgFYmRzqtwetIlBIH9JNNLkNQaIpMf1PJh5XWEmcY555M9/2jvDXMYBeG
            -----END RSA PRIVATE KEY-----
            EOD;
        }
        public function encriptar($text){
            openssl_public_encrypt($text, $encryptedData, $this->publicKey);
            return base64_encode($encryptedData) . PHP_EOL;
        }
        public function desencriptar($hast){
            try {
                // Intenta desencriptar los datos
                openssl_private_decrypt(base64_decode($hast), $decryptedData, $this->privateKey);
                return $decryptedData . PHP_EOL;
            } catch (Exception $e) {
                // Captura cualquier excepción que ocurra durante la desencriptación y maneja el error de manera controlada
                throw new Exception("Error al desencriptar los datos: " . $e->getMessage());
            }
            
        }
    }