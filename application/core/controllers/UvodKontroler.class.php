
<?php

class UvodKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Úvod";
        return parent::zpracuj($URL);
    }
}

?>