<?php

class InvesticniPlanyKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Investiční plány";
        
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