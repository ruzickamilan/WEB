<?php

class NebankovniKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Nebankovní úvěr";
        
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