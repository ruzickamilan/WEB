<?php

class MujUcetKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Můj účet";
        
        if (isset($_REQUEST["logged"]) && Session::isPrihlasen()) {
            $this->info = "<div class='alert alert-success' role='alert'>Přihlášení proběhlo v pořádku!</div>";
        }
        
        if (Session::isPrihlasen()) {
            $pohled = $this->getSablona($URL);
            $template_params = $this->getPole();
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            
            if (isset($_REQUEST["autorizace"])) {
                $nahodny_retezec = nahodny_retezec(30);
                $odkaz = "www.quatrofin.cz/?page=registrace&autorizace=".$nahodny_retezec;
                $text_emailu = "Dobrý den, žádali jste nás, abychom Vám znovu zaslali autorizační email. Pro autorizaci Vašeho účtu klikněte na níže uvedený odkaz.\n\n\n".$odkaz."";
                //mail(Session::getEmail(), "Autorizace účtu", $text_emailu, "MIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\nContent-Transfer-Encoding: 8bit" . "\r\n" . "From: " . "quatrofin.cz" . "<info@quatrofin.cz>");
                $registrace = new DbRegistrace();   
                $vysledek = $registrace->zmenAutorizacniKod(Session::getId(), $nahodny_retezec);
                $this->info = $vysledek;
            }
            
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
            
            $template_params['hodnost'] = ucwords(Session::getTypUctu());
            $template_params['jmeno'] = Session::getJmeno();
            $template_params['email'] = Session::getEmail();
            $template_params['telefon'] = Session::getTelefon();
            $template_params['autorizace'] = Session::getAutorizace();
            
            if (Session::getTypUctu() == "admin") {
                $template_params['menu_admina'] = "<a href='?page=sprava_uzivatelu'>Správa uživatelů</a>";
            }
            
            return $pohled->render($template_params);
        }
        else {
            $this->info = '<div class="alert alert-danger" role="alert">Sem může jen přihlášený (registrovaný) uživatel!</div>';
            $this->prihlaseni = getTlacitko();
        }
    }
}

?>