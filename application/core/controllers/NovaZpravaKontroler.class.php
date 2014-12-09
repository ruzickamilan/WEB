<?php

class NovaZpravaKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Nová zpráva";
        
        if (!Session::isPrihlasen()) {
            $this->prihlaseni = getTlacitko();
            $this->info = '<div class="alert alert-danger" role="alert">Sem může jen přihlášený (registrovaný) uživatel!</div>';
        }
        else {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            $pohled = $this->getSablona($URL);
            $nova_zprava = new DbSoukromeZpravy();
            $select = "";
            if (isset($_REQUEST["reakce"])) {
                $select = $_REQUEST["reakce"];
            }
            
            if (Session::getTypUctu() == "user") {
                $vysledek = $nova_zprava->nactiPrijemceUser();
                $template_params = $this->getPole();
                $template_params['sel'] = $select;
                $template_params['prijemci'] = $vysledek;
            }
            else if (Session::getTypUctu() == "admin") {
                $vysledek = $nova_zprava->nactiPrijemceAdmin();
                $template_params = $this->getPole();
                $template_params['sel'] = $select;
                $template_params['prijemci'] = $vysledek;
                $template_params['admin'] = true;
            }
                
            if (isset($_POST['prijemce']) && isset($_POST['predmet']) && isset($_POST['text_zpravy'])) {
                if ($_POST['prijemce'] != "Poslat všem uživatelům" && $_POST['prijemce'] != "Poslat všem adminům") {
                    $pole = explode(" ", $_POST['prijemce']);
                    $email = substr($pole[count($pole)-1] , 1, -1);
                    $vysledek = $nova_zprava->novaZprava(Session::getId(), $email, $_POST['predmet'], $_POST['text_zpravy']);
                    $this->info = $vysledek;
                }
                else if ($_POST['prijemce'] == "Poslat všem uživatelům") {
                    $vysledek = $nova_zprava->novaZpravaVsemUserum(Session::getId(), $_POST['predmet'], $_POST['text_zpravy']);
                    $this->info = $vysledek;
                }
                else if ($_POST['prijemce'] == "Poslat všem adminům") {
                    $vysledek = $nova_zprava->novaZpravaVsemAdminum(Session::getId(), $_POST['predmet'], $_POST['text_zpravy']);
                    $this->info = $vysledek;
                }
            }
            
            $nova_zprava->odpojDB();
            return $pohled->render($template_params);
        } 
    }
}

?>