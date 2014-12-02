<?php

class ErrorKontroler extends Kontroler{
    public function zpracuj($URL) {
        $this->title = "Stránka nenalezena";
        
        if (!Session::isPrihlasen()) {
            $this->prihlaseni = getTlacitko();
        }
        else {
            $this->prihlaseni = getUzivatel(Session::getEmail());
        }
        
        return parent::zpracuj($URL);
    }
}

?>