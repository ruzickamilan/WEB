<?php

class LoginKontroler extends Kontroler{
    public function zpracuj($URL) {
        $this->title = "Přihlášení";
        
        if (isset($_POST['email']) && isset($_POST['heslo'])) {
            $email = strtolower($_POST['email']);
            $heslo = md5(sha1($_POST['heslo']));
            $prihlaseni = new DbLogin();
            $vysledek = $prihlaseni->najdiUzivatele($email, $heslo);
            if ($vysledek != "OK") {
                $this->info = $vysledek;
            }
            else {
                echo "<script type = 'text/javascript'>setTimeout(\"location.href='?page=muj_ucet&logged';\", 0);</script>";
            }
        }
        
        if (Session::isPrihlasen()) {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
        }
        else {
            $this->prihlaseni = getTlacitko();
        }
        
        $pohled = $this->getSablona($URL);
        return $pohled->render(array());
    }
}

?>