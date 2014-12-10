<?php

class PodnikatelskeZameryKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Podnikatelské záměry";
        
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