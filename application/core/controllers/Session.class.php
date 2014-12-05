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
    
    public static function pamatujUzivatele($id, $jmeno, $email, $telefon, $typ_uctu, $autorizace) {
        $_SESSION['uzivatel'] = array($id, $jmeno, $email, $telefon, $typ_uctu, $autorizace);
    }
    
    public static function getId() {
        return $_SESSION['uzivatel'][0];
    }
    
    public static function getJmeno() {
        return $_SESSION['uzivatel'][1]." &nbsp;<a style='font-size: 12px;' href='?page=uprava_udaju'>(upravit)</a>";
    }
    
    public static function getJmenoDis() {
        return $_SESSION['uzivatel'][1];
    }
    
    public static function setJmeno($jmeno) {
        $_SESSION['uzivatel'][1] = $jmeno;
    }
    
    public static function getEmail() {
        return $_SESSION['uzivatel'][2];
    }
    
    public static function getTelefon() {
        if ($_SESSION['uzivatel'][3] == 0) {
            return "<span style='color: red;' class='glyphicon glyphicon-remove'></span> &nbsp;<a style='font-size: 12px;' href='?page=uprava_udaju'>(upravit)</a>";
        }
        else {
            return $_SESSION['uzivatel'][3]." &nbsp;<a style='font-size: 12px;' href='?page=uprava_udaju'>(upravit)</a>";
        }
    }
    
    public static function getTelefonDis() {
        if ($_SESSION['uzivatel'][3] == 0) {
            return "";
        }
        else {
            return $_SESSION['uzivatel'][3];
        }
    }
    
    public static function setTelefon($tel) {
        $_SESSION['uzivatel'][3] = $tel;
    }
    
    public static function getTypUctu() {
        return $_SESSION['uzivatel'][4];
    }
    
    public static function getAutorizace() {
        if ($_SESSION['uzivatel'][5] != 1) {
            return "<span style='color: red;' class='glyphicon glyphicon-remove'></span> &nbsp;<a style='font-size: 12px;' href='?page=muj_ucet&amp;autorizace'>(Znovu zaslat autorizační email)</a>";
        }
        else {
            return "<span style='color: green;' class='glyphicon glyphicon-ok'></span>";
        }
    }
    
    public static function getAutorizaceDis() {
        if ($_SESSION['uzivatel'][5] != 1) {
            return 0;
        }
        else {
            return 1;
        }
    }
}

?>
