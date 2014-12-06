<?php

class ZapomenuteHesloKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Zapomenuté heslo";
        
        if (!Session::isPrihlasen()) {
            $this->prihlaseni = getTlacitko();
            if (isset($_POST['email'])) {
                $zapomenute_heslo = new DbRegistrace();
                $vysledek = $zapomenute_heslo->resetujHeslo($_POST['email']);
                $this->info = $vysledek;
            }
        }
        else {
            $this->info = "<div class='alert alert-success' role='alert'>Jsi přihlášen! Tato stránka neni pro tebe.</div>";
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
        }
        
        return parent::zpracuj($URL);
    }
}

?>