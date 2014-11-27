<?php

class Smerovac extends Kontroler {

    private static $instance = null;
    private $kontroler;
    private $cesta;

    public function getKontroler() {
        return $this->kontroler;
    }

    public function getCesta() {
        return $this->cesta;
    }

    public function zpracuj($URL) {
        
        $naparsovanaURL = parse_url($URL);
        $poleURL = explode("/", $naparsovanaURL['path']);
        
        $tridaKontroleru = $this->getKontrolerJmeno(($poleURL[0])) . 'Kontroler';
        
        if (file_exists(KONTROLERY . $tridaKontroleru . '.class.php')) {
            
            if ($tridaKontroleru == "Kontroler") {
                $this->presmeruj("?page=uvod");
            } 
            else {
                $this->kontroler = $tridaKontroleru;
                $this->cesta = implode("/", $naparsovanaURL);
            }
        } 
        else {
            $this->presmeruj("?page=error");
        }
    }

    private function getKontrolerJmeno($text) {
        $jmeno = ucwords($text);
        return $jmeno;
    }

    public static function getInstance() {
        if (isset($instance)) {
            return $instance;
        } 
        else {
            $instance = new Smerovac();
            return $instance;
        }
    }
}

?>