<?php

class AdministrativniSluzbyKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Administrativní služby";
        
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