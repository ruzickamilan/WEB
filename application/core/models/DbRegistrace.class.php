<?php

class DbRegistrace extends Db {
    private $db;
    
    public function DbRegistrace() {
        $this->db = new Db();
        $this->db->GetConnection();
        $this->db->Connect();
    }
    
    public function vlozUzivatele($email, $heslo) {
        $items = array(
            'id' => 0,
            'jmeno' => '',
            'email' => $email,
            'heslo' => $heslo,
            'telefon' => 0,
            'typ_uctu' => 'user',
            'autorizace' => false,
            'ban' => false
        );
        $result = $this->db->DBInsert(UZIVATEL, $items);
        if ($result) {
            return '<div class="alert alert-success" role="alert">Registrace proběhla v pořádku! Na uvedený email byl odeslán autorizační odkaz.</div>';
        }
        else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
        $this->db->Disconnect();
    }
}

?>