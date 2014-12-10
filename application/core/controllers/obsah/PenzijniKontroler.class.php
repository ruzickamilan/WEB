<?php

class PenzijniKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Penzijní pojištění";
        
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