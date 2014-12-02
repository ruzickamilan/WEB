<?php

class RegistraceKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Registrace";
        
        if (!Session::isPrihlasen()) {
           $this->prihlaseni = getTlacitko();
        }
        else {
            $this->prihlaseni = getUzivatel(Session::getEmail());
        }
        
        if (isset($_POST['email']) && isset($_POST['heslo1']) && isset($_POST['heslo2'])) {
            if ($_POST['heslo1'] == $_POST['heslo2']) {
                $email = $_POST['email'];
                $heslo = md5(sha1($_POST['heslo1']));
                $registrace = new DbRegistrace();
                $vysledek = $registrace->vlozUzivatele($email, $heslo);
                $this->info = $vysledek;
            }
            else {
                $this->info = '<div class="alert alert-danger" role="alert">Zadaná hesla se neshodují!</div>';
            }
        }
        
        $pohled = $this->getSablona($URL);
        return $pohled->render(array());
    }
}

?>