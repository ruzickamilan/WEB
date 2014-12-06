<?php

class DbSpravaUzivatelu extends Db {
    private $db;
    
    public function DbSpravaUzivatelu() {
        $this->db = new Db();
        $this->db->GetConnection();
        $this->db->Connect();
    }
    
    public function vypisUzivatele() {
        $columns = "*";
        $where = array();
        $orderby = array(
            array(
                'column' => 'typ_uctu',
                'sort' => ''
            ),
            array(
                'column' => 'id',
                'sort' => ''
            )
        );
        
        $rows = $this->db->DBSelectAll(UZIVATEL, $columns, $where, "", $orderby);
        if ($rows) {
            return $rows;
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání uživatelů!</div>';
        }   
    }
    
    public function povysUzivatele($id) {
        $query = "UPDATE " . UZIVATEL . " SET typ_uctu = 'admin' WHERE id = ".$id.";";
        
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            return '<div class="alert alert-success" role="alert">Uživatel s ID '.$id.' byl úspěšně povýšen!</div>';
        } else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }
    
    public function zablokujUzivatele($id) {
        $query = "UPDATE " . UZIVATEL . " SET ban = 1 WHERE id = ".$id.";";
        
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            return '<div class="alert alert-success" role="alert">Uživatel s ID '.$id.' byl úspěšně zablokován!</div>';
        } else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }
    
    public function odblokujUzivatele($id) {
        $query = "UPDATE " . UZIVATEL . " SET ban = 0 WHERE id = ".$id.";";
        
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            return '<div class="alert alert-success" role="alert">Uživatel s ID '.$id.' byl úspěšně odblokován!</div>';
        } else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }
    
    public function odpojDB() {
        $this->db->Disconnect();
    }
}

?>