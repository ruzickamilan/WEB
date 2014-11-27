<?php

class Session {
    public static function login() {
        $_SESSION['prihlasen'] = 1;
    }
    
    public static function logout() {
        unset($_SESSION['prihlasen']);
    }
    
    public static function isPrihlasen() {
        if (isset($_SESSION['prihlasen'])) {
            return true;
        }
        else {
            return false;
        }
    }
}

?>
