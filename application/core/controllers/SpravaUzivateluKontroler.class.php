<?php

class SpravaUzivateluKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Správa uživatelů";
        
        if (!Session::isPrihlasen()) {
            $this->prihlaseni = getTlacitko();
            $this->info = '<div class="alert alert-danger" role="alert">Sem může jen přihlášený (registrovaný) uživatel!</div>';
        }
        else {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            if (Session::getTypUctu() == "admin") {
                $sprava_uzivatelu = new DbSpravaUzivatelu();
                
                if (isset($_POST['povysit']) && isset($_POST['povysit_radio'])) {
                    $vysledek = $sprava_uzivatelu->povysUzivatele($_POST['povysit_radio'][0]);
                    $this->info = $vysledek;
                }
                if (isset($_POST['ban']) && isset($_POST['ban_radio'])) {
                    $vysledek = $sprava_uzivatelu->zablokujUzivatele($_POST['ban_radio'][0]);
                    $this->info = $vysledek;
                }
                if (isset($_POST['unban']) && isset($_POST['unban_radio'])) {
                    $vysledek = $sprava_uzivatelu->odblokujUzivatele($_POST['unban_radio'][0]);
                    $this->info = $vysledek;
                }
                
                $pohled = $this->getSablona($URL);
                $template_params = $this->getPole();
                $vysledek = $sprava_uzivatelu->vypisUzivatele();
                $template_params['uzivatele'] = $vysledek;
                $sprava_uzivatelu->odpojDB();
                return $pohled->render($template_params);
            }
            else {
                $this->info = '<div class="alert alert-danger" role="alert">Sem může jen admin!</div>';
            }
        } 
    }
}

?>