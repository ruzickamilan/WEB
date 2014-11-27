<?php

class LoginKontroler extends Kontroler{
    public function zpracuj($URL) {
        $this->title = "Přihlášení";
        
        if (Session::isPrihlasen()) {
            Session::logout();
            //$this->prihlaseni = "Nejsi přihlášen";
        }
        else {
            Session::login();
            //$this->prihlaseni = "Jsi přihlášen";
        }
        
        $pohled = $this->getSablona($URL);
        return $pohled->render(array());
    }
}

?>