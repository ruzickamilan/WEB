<?php

class Session {
    public static function login() {
        $_SESSION['prihlasen'] = 1;
    }
    
    public static function logout() {
        unset($_SESSION['prihlasen']);
        unset($_SESSION['uzivatel']);
    }
    
    public static function isPrihlasen() {
        if (isset($_SESSION['prihlasen'])) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public static function pamatujUzivatele($jmeno, $email, $telefon, $typ_uctu, $autorizace) {
        $_SESSION['uzivatel'] = array($jmeno, $email, $telefon, $typ_uctu, $autorizace);
    }
    
    public static function getJmeno() {
        return $_SESSION['uzivatel'][0];
    }
    public static function getEmail() {
        return $_SESSION['uzivatel'][1];
    }
    public static function getTelefon() {
        return $_SESSION['uzivatel'][2];
    }
    public static function getTypUctu() {
        return $_SESSION['uzivatel'][3];
    }
    public static function getAutorizace() {
        return $_SESSION['uzivatel'][4];
    }
}

?>
