<?php

class KontaktKontroler extends Kontroler{
    public function zpracuj($URL) {
        $this->title = "Kontakt";
        
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