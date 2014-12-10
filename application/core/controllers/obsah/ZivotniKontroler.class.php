<?php

class ZivotniKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Životní pojištění";
        
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