<?php

class StavebniSporeniKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Stavební spoření";
        
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