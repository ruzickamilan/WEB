<?php

class DbSoukromeZpravy extends Db {
    private $db;
    
    public function DbSoukromeZpravy() {
        $this->db = new Db();
        $this->db->GetConnection();
        $this->db->Connect();
    }
    
    public function vypisZprav($id) {
        $columns = "t1.id, DATE_FORMAT(t1.cas, '%d.%m.%Y') AS 'cas', DATE_FORMAT(t1.cas, '%H:%i %d.%m.%Y') AS 'cely_cas', t1.predmet, t1.text, t2.jmeno, t2.email";
        $where = array(
            array(
                'column' => "t1.uzivatel_id = t2.id AND t1.id IN (SELECT zprava_id FROM " . PRIJEMCE . " WHERE uzivatel_id = ".$id.")",
                'symbol' => "",
                'value' => ""
            )
        );
        $orderby = array(
            array(
                'column' => 'cely_cas',
                'sort' => 'DESC'
            )
        );
        
        $rows = $this->db->DBSelectAll(ZPRAVA . " t1 JOIN " . UZIVATEL . " t2", $columns, $where, "", $orderby);
        if ($rows) {
            return $rows;
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání zpráv!</div>';
        } 
    }
    
    public function nactiPrijemceUser() {
        $columns = "jmeno, email";
        $where = array(
                    array(
                        'column' => "typ_uctu = 'admin'",
                        'symbol' => "",
                        'value' => ""
                    )
                );
        
        $rows = $this->db->DBSelectAll(UZIVATEL, $columns, $where);
        if ($rows) {
            return $rows;
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání příjemců!</div>';
        } 
    }
    
    public function nactiPrijemceAdmin() {
        $columns = "jmeno, email";
        $where = array();
        
        $rows = $this->db->DBSelectAll(UZIVATEL, $columns, $where);
        if ($rows) {
            return $rows;
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání příjemců!</div>';
        } 
    }
    
    public function novaZprava($id_odesilatele, $email_prijemce, $predmet, $text) {
        $cas = date("Y-m-d H:i:s");
        $kod_zpravy = nahodny_retezec(20);
        $items = array(
            'id' => 0,
            'cas' => $cas,
            'predmet' => $predmet,
            'text' => $text,
            'kod_zpravy' => $kod_zpravy,
            'uzivatel_id' => $id_odesilatele
        );
        $result = $this->db->DBInsert(ZPRAVA, $items);
        if ($result) {
            $columns = "id";
            $where = array(array('column' => "email", 'symbol' => " = ", 'value' => "".$email_prijemce.""));
            $row1 = $this->db->DBSelectOne(UZIVATEL, $columns, $where);
            if ($row1) {
                $columns = "id";
                $where = array(array('column' => "kod_zpravy", 'symbol' => " = ", 'value' => "".$kod_zpravy.""));
                $row2 = $this->db->DBSelectOne(ZPRAVA, $columns, $where);
                if ($row2) {
                    $query = "UPDATE " . ZPRAVA . " SET kod_zpravy = 'odeslano' WHERE kod_zpravy = '" . $kod_zpravy . "';";
                    $this->db->DBUpdate($query);
                    $items = array(
                        'uzivatel_id' => $row1['id'],
                        'zprava_id' => $row2['id']
                    );
                    $vysledek = $this->db->DBInsert(PRIJEMCE, $items);
                    if ($vysledek) {
                        return '<div class="alert alert-success" role="alert">Zpráva byla úspěšně odeslána!</div>';
                    }
                    else {
                        return '<div class="alert alert-danger" role="alert">Nastala chyba při uložení detailů!</div>';
                    }
                }
                else {
                    return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání zprávy!</div>';
                }
            }
            else {
                return '<div class="alert alert-danger" role="alert">Nastala chyba při načítání příjemce!</div>';
            }
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba při ukládání zprávy!</div>';
        }
    }
    
    public function novaZpravaVsemUserum($id_odesilatele, $predmet, $text) {
        $columns = "email";
        $where = array(
                    array(
                        'column' => "typ_uctu = 'user'",
                        'symbol' => "",
                        'value' => ""
                    )
                );
        
        $rows = $this->db->DBSelectAll(UZIVATEL, $columns, $where);
        if ($rows) {
            for ($i = 0; $i < count($rows); $i++) {
                $this->novaZprava($id_odesilatele, $rows[$i]['email'], $predmet, $text);
            }
            return '<div class="alert alert-success" role="alert">Zprávy byly úspěšně odeslány!</div>';
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba!</div>';
        }
    }
    
    public function novaZpravaVsemAdminum($id_odesilatele, $predmet, $text) {
        $columns = "email";
        $where = array(
                    array(
                        'column' => "typ_uctu = 'admin'",
                        'symbol' => "",
                        'value' => ""
                    )
                );
        
        $rows = $this->db->DBSelectAll(UZIVATEL, $columns, $where);
        if ($rows) {
            for ($i = 0; $i < count($rows); $i++) {
                $this->novaZprava($id_odesilatele, $rows[$i]['email'], $predmet, $text);
            }
            return '<div class="alert alert-success" role="alert">Zprávy byly úspěšně odeslány!</div>';
        }
        else {
            return '<div class="alert alert-danger" role="alert">Nastala chyba!</div>';
        }
    }
    
    public function smazZpravy($ids) {
        $query1 = "DELETE FROM " . PRIJEMCE . " WHERE zprava_id IN (".$ids.");";
        $query2 = "DELETE FROM " . ZPRAVA . " WHERE id IN (".$ids.");";
        
        $result1 = $this->db->DBDelete($query1);
        $result2 = $this->db->DBDelete($query2);
        if ($result1 > 0 && $result2 > 0) {
            return '<div class="alert alert-success" role="alert">Zprávy byly úspěšně smazány!</div>';
        } else {
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }

    public function odpojDB() {
        $this->db->Disconnect();
    }
}

?>