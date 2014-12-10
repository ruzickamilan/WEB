<?php

class OddluzeniKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Oddlužení";
        
        if (!Session::isPrihlasen()) {
            $this->prihlaseni = getTlacitko();
        }
        else {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
        }
        
        return parent::zpracuj($URL);
    }
}

?>