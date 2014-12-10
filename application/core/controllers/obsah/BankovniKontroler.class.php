<?php

class BankovniKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Bankovní úvěr";
        
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