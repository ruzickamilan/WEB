<?php

class NakupKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Nákup";
        
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