<?php

class PravniServisKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Právní servis";
        
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