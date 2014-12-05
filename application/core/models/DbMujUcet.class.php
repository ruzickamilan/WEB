<?php

class DbMujUcet extends Db {
    private $db;
    
    public function DbMujUcet() {
        $this->db = new Db();
        $this->db->GetConnection();
        $this->db->Connect();
    }
    
    public function upravUzivatele($id, $jmeno, $telefon) {
        $query = "UPDATE " . UZIVATEL . " SET jmeno = '".$jmeno."', telefon = '".$telefon."' WHERE id = ".$id.";";
        
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            Session::setTelefon($telefon);
            Session::setJmeno($jmeno);
            $this->db->Disconnect();
            return '<div class="alert alert-success" role="alert">Úprava údajů proběhla v pořádku!</div>';
        } else {
            $this->db->Disconnect();
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }
}

?>