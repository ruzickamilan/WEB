<?php

class MinulostKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Minulost";
        
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