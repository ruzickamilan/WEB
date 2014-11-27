<?php

class ErrorKontroler extends Kontroler{
    public function zpracuj($URL) {
        $this->title = "Stránka nenalezena";
        return parent::zpracuj($URL);
    }
}

?>