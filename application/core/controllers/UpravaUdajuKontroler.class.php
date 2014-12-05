<?php

class UpravaUdajuKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Úprava osobních údajů";
        
        if (!Session::isPrihlasen()) {
            $this->prihlaseni = getTlacitko();
            $this->info = '<div class="alert alert-danger" role="alert">Sem může jen přihlášený (registrovaný) uživatel!</div>';
        }
        else {
            $pohled = $this->getSablona($URL);
            $template_params = $this->getPole();
            $template_params['jmeno'] = Session::getJmenoDis();
            $template_params['telefon'] = Session::getTelefonDis();
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            return $pohled->render($template_params);
        } 
    }
}

?>