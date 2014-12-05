<?php

class DbDiskuze extends Db {
    private $db;
    
    public function DbDiskuze() {
        $this->db = new Db();
        $this->db->GetConnection();
        $this->db->Connect();
    }
    
    public function vlozDotaz($jmeno, $text) {
        $cas = date("Y-m-d H:i:s");
        $items = array(
            'id' => 0,
            'jmeno' => $jmeno,
            'cas' => $cas,
            'text' => $text
        );
        $result = $this->db->DBInsert(DISKUZE, $items);
        if ($result) {
            return '<div class="alert alert-success" role="alert">Dotaz byl úspěšně přidán k ostatním!</div>';
        }
        else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }   
    public function vlozReakci($text, $id_diskuze, $id_uzivatele) {
        $cas = date("Y-m-d H:i:s");
        $items = array(
            'cas' => $cas,
            'text' => $text,
            'diskuze_id' => $id_diskuze,
            'uzivatel_id' => $id_uzivatele
        );
        $result = $this->db->DBInsert(ODPOVED, $items);
        if ($result) {
            return '<div class="alert alert-success" role="alert">Reakce byla úspěšně přidána!</div>';
        }
        else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }
    
    public function vypisDiskuzi() {
        $columns = "id, jmeno, DATE_FORMAT(cas, '%H:%i (%d.%m.%Y)') AS 'cas', text";
        $where = array();
        
        $rows = $this->db->DBSelectAll(DISKUZE, $columns, $where);
        if ($rows) {
            return $rows;
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání dotazů!</div>';
        }   
    }
    
    public function vypisOdpovedi() {
        $columns = "jmeno, DATE_FORMAT(cas, '%H:%i (%d.%m.%Y)') AS 'cely_cas', DATE_FORMAT(cas, '(%H:%i)') AS 'cas', text, diskuze_id, uzivatel_id";
        $where = array(
                    array(
                        'column' => "t1.id = t2.uzivatel_id order by t2.cas",
                        'symbol' => "",
                        'value' => ""
                    )
                );
        
        $rows = $this->db->DBSelectAll(UZIVATEL." t1 JOIN ".ODPOVED." t2", $columns, $where);
        if ($rows) {
            return $rows;
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání odpovědí na dotazy!</div>';
        }
    }
    
    public function odpojDB() {
        $this->db->Disconnect();
    }
}

?>