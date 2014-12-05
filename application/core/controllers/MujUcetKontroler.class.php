<?php

class MujUcetKontroler extends Kontroler{
    public function zpracuj($URL) {
        $this->title = "Můj účet";
        
        $pohled = $this->getSablona($URL);
        $template_params = $this->getPole();
        
        if (isset($_REQUEST["logged"]) && Session::isPrihlasen()) {
            $this->info = "<div class='alert alert-success' role='alert'>Přihlášení proběhlo v pořádku!</div>";
        }
        
        if (Session::isPrihlasen()) {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            
            if (isset($_POST['jmeno']) && isset($_POST['telefon'])) {
                if (strlen($_POST['jmeno']) > 2) {
                    $id = Session::getId();
                    $jmeno = $_POST['jmeno'];
                    $telefon = $_POST['telefon'];
                    $uprava_udaju = new DbMujUcet;
                    $vysledek = $uprava_udaju->upravUzivatele($id, $jmeno, $telefon);
                    $this->info = $vysledek;
                }
                else {
                    $this->info = '<div class="alert alert-danger" role="alert">Nezadali jste jméno delší než 2 znaky, nebo máte heslo kratší než 6 znaků!</div>';
                }
            }
            
            $template_params = $this->getPole();
            $template_params['hodnost'] = ucwords(Session::getTypUctu());
            $template_params['jmeno'] = Session::getJmeno();
            $template_params['email'] = Session::getEmail();
            $template_params['telefon'] = Session::getTelefon();
            $template_params['autorizace'] = Session::getAutorizace();
        }
        else {
            $this->prihlaseni = getTlacitko();
        }
        
        return $pohled->render($template_params);
    }
}

?>