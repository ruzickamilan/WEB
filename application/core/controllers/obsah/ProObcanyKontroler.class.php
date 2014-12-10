<?php

class ProObcanyKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Pro občany";
        
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