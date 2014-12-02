<?php

class LoginKontroler extends Kontroler{
    public function zpracuj($URL) {
        $this->title = "Přihlášení";
        
        if (isset($_POST['email']) && isset($_POST['heslo'])) {
            $email = $_POST['email'];
            $heslo = md5(sha1($_POST['heslo']));
            $prihlaseni = new DbLogin();
            $vysledek = $prihlaseni->najdiUzivatele($email, $heslo);
            $this->info = $vysledek;
        }
        
        if (Session::isPrihlasen()) {
            $this->prihlaseni = getUzivatel(Session::getEmail());
        }
        else {
            $this->prihlaseni = getTlacitko();
        }
        
        $pohled = $this->getSablona($URL);
        return $pohled->render(array());
    }
}

?>