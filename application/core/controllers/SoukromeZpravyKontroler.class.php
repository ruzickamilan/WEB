<?php

class SoukromeZpravyKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Soukromé zprávy";
        
        if (!Session::isPrihlasen()) {
            $this->prihlaseni = getTlacitko();
            $this->info = '<div class="alert alert-danger" role="alert">Sem může jen přihlášený (registrovaný) uživatel!</div>';
        }
        else {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            $pohled = $this->getSablona($URL);
            $template_params = $this->getPole();
            $zpravy = new DbSoukromeZpravy();
            
            if (isset($_POST['smaz']) && isset($_POST['smazat'])) {
                $prvky_ke_smazani = implode(", ", $_POST['smaz']);
                $vysledek = $zpravy->smazZpravy($prvky_ke_smazani);
                $this->info = $vysledek;
            }
            
            $vysledek = $zpravy->vypisZprav(Session::getId());
            $template_params['zpravy'] = $vysledek;
            
            $zpravy->odpojDB();
            return $pohled->render($template_params);
        } 
    }
}

?>