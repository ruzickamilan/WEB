
<?php

class UvodKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Úvod";
        
        if (isset($_REQUEST["odhlaseni"])) {
            if ($_REQUEST["odhlaseni"] == "true") {
                Session::logout();
                $this->info = '<div class="alert alert-success" role="alert">Odhlášení proběhlo úspěšně!</div>';
            }
        }
        
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