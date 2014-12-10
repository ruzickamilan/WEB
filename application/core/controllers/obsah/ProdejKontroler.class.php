<?php

class ProdejKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Prodej";
        
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