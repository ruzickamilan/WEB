<?php

class PritomnostKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Přítomnost";
        
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