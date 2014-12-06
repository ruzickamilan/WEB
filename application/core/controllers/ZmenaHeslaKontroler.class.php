<?php

class ZmenaHeslaKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Změna hesla";
        
        if (!Session::isPrihlasen()) {
            $this->prihlaseni = getTlacitko();
            $this->info = '<div class="alert alert-danger" role="alert">Sem může jen přihlášený (registrovaný) uživatel!</div>';
        }
        else {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            $pohled = $this->getSablona($URL);
            $template_params = $this->getPole();
            
            if (isset($_POST['heslo0']) && isset($_POST['heslo1']) && isset($_POST['heslo2'])) {
                if (($_POST['heslo1'] == $_POST['heslo2']) && (strlen($_POST['heslo1']) >= 5)) {
                    $zmena_hesla = new DbRegistrace();
                    $vysledek = $zmena_hesla->zmenHeslo(md5(sha1($_POST['heslo0'])), md5(sha1($_POST['heslo1'])));
                    $this->info = $vysledek;
                }
                else {
                    $this->info = '<div class="alert alert-danger" role="alert">Zadaná hesla se neshodují, nebo máte nové heslo kratší než 6 znaků!</div>';
                }
            }
            
            return $pohled->render($template_params);
        }
    }
}

?>