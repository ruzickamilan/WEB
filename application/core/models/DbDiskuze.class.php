<?php

class DbDiskuze extends Db {
    private $db;
    
    public function DbDiskuze() {
        $this->db = new Db();
        $this->db->GetConnection();
        $this->db->Connect();
    }
    
    public function vlozDotaz($jmeno, $email, $text, $kontrola_emailu) {
        if ($kontrola_emailu == 0) {
            $cas = date("Y-m-d H:i:s");
            $items = array(
                'id' => 0,
                'jmeno' => $jmeno,
                'email' => $email,
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
        else {
            $columns = "jmeno";
            $where = array(array('column' => "email", 'symbol' => " = ", 'value' => "".$email.""));

            $row = $this->db->DBSelectOne(UZIVATEL, $columns, $where);
            if (!$row) {
                $this->vlozDotaz($jmeno, $email, $text, 0);
            }
            else {
                return '<div class="alert alert-danger" role="alert">Pod tímto emailem je již někdo registrován! Piště nové dotazy po přihlášení.</div>';
            }
        }
    }
    
    public function upravDotaz($id, $text, $email_editora) {
        $query = "UPDATE " . DISKUZE . " SET text = '" . $text ."' WHERE id = " . $id . " AND email = '" . $email_editora . "';";
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            return '<div class="alert alert-success" role="alert">Dotaz byl úspěšně upraven!</div>';
        } else {
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
        $columns = "id, jmeno, email, cas AS 'orig_cas', DATE_FORMAT(cas, '%H:%i (%d.%m.%Y)') AS 'cas', text";
        $where = array();
        $orderby = array(
            array(
                'column' => 'orig_cas',
                'sort' => 'DESC'
            )
        );
        
        $rows = $this->db->DBSelectAll(DISKUZE, $columns, $where, "", $orderby);
        if ($rows) {
            return $rows;
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání dotazů!</div>';
        }   
    }
    
    public function vypisOdpovedi() {
        $columns = "t2.id, jmeno, DATE_FORMAT(cas, '%H:%i (%d.%m.%Y)') AS 'cely_cas', DATE_FORMAT(cas, '(%H:%i)') AS 'cas', text, diskuze_id, uzivatel_id";
        $where = array(
                    array(
                        'column' => "t1.id = t2.uzivatel_id",
                        'symbol' => "",
                        'value' => ""
                    )
                );
        $orderby = array(
            array(
                'column' => 'id',
                'sort' => 'ASC'
            )
        );
        
        $rows = $this->db->DBSelectAll(UZIVATEL." t1 JOIN ".ODPOVED." t2", $columns, $where, "", $orderby);
        if ($rows) {
            return $rows;
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání odpovědí na dotazy!</div>';
        }
    }
    
    public function smazDotaz($id) {
        $query1 = "DELETE FROM " . ODPOVED . " WHERE diskuze_id = '".$id."';";
        $query2 = "DELETE FROM " . DISKUZE . " WHERE id = '".$id."';";
        
        $result1 = $this->db->DBDelete($query1);
        $result2 = $this->db->DBDelete($query2);
        if ($result1 >= 0 && $result2 == 1) {
            return '<div class="alert alert-success" role="alert">Dotaz byl úspěšně odebrán!</div>';
        } else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }

    public function smazOdpoved($id) {
        $query = "DELETE FROM " . ODPOVED . " WHERE id = '".$id."';";
        
        $result = $this->db->DBDelete($query);
        if ($result == 1) {
            return '<div class="alert alert-success" role="alert">Odpověd byla úspěšně odebrána!</div>';
        } else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }

    public function odpojDB() {
        $this->db->Disconnect();
    }
}

?>