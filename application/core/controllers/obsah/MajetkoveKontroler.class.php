<?php

class MajetkoveKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Majetkové pojištění";
        
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