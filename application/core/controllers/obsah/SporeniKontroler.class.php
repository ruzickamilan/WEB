<?php

class SporeniKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Spoření";
        
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