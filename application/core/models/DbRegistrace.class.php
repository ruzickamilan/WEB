<?php

class DbRegistrace extends Db {
    private $db;
    
    public function DbRegistrace() {
        $this->db = new Db();
        $this->db->GetConnection();
        $this->db->Connect();
    }
    
    public function vlozUzivatele($jmeno, $email, $heslo, $autorizace) {
        $items = array(
            'id' => 0,
            'jmeno' => $jmeno,
            'email' => $email,
            'heslo' => $heslo,
            'telefon' => 0,
            'typ_uctu' => 'user',
            'autorizace' => $autorizace,
            'ban' => 0
        );
        $result = $this->db->DBInsert(UZIVATEL, $items);
        if ($result) {
            $this->db->Disconnect();
            return '<div class="alert alert-success" role="alert">Registrace proběhla v pořádku! Na uvedený email byl odeslán autorizační odkaz.</div>';
        }
        else {
            $this->db->Disconnect();
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba! Zřejmě je již pod tímto emailem někdo zaregistrován.</div>';
        }
    }
    
    public function autorizujUzivatele($autorizacni_hash) {
        $query = "UPDATE " . UZIVATEL . " SET autorizace = 1 WHERE autorizace = '" . $autorizacni_hash . "';";
        
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            $this->db->Disconnect();
            return '<div class="alert alert-success" role="alert">Autorizace proběhla v pořádku! Nyní se můžete přihlásit.</div>';
        } else {
            $this->db->Disconnect();
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba! Zřejmě špatný autorizační odkaz. Zkontrolujte jeho správnost a případně si z menu po přihlášení nechte zaslat nový autorizační odkaz.</div>';
        }
    }
}

?>