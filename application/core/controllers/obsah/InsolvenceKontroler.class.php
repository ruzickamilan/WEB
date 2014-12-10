<?php

class InsolvenceKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Insolvence";
        
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