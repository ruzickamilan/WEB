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
    
    public function zmenAutorizacniKod($id, $hash) {
        $query = "UPDATE " . UZIVATEL . " SET autorizace = '".$hash."' WHERE id = " . $id . ";";
        
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            $this->db->Disconnect();
            return '<div class="alert alert-success" role="alert">Email byl odeslán!</div>';
        } else {
            $this->db->Disconnect();
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba!</div>';
        }
    }
    
    public function resetujHeslo($email) {
        $nahodne_heslo = nahodny_retezec(10);
        $heslo = md5(sha1($nahodne_heslo));
        $query = "UPDATE " . UZIVATEL . " SET heslo = '".$heslo."' WHERE email = '" . $email . "';";
        
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            $this->db->Disconnect();
            $text_emailu = "Dobrý den, zasíláme Vám nové heslo k Vašemu účtu u nás na webu. Doporučujeme si jej v co nejbližší době změnit v nabídce \"Můj účet\". Vaše heslo:\n\n\n".$nahodne_heslo."";   
            //mail($email, "Heslo k Vašemu účtu", $text_emailu, "MIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\nContent-Transfer-Encoding: 8bit" . "\r\n" . "From: " . "quatrofin.cz" . "<info@quatrofin.cz>");
            return '<div class="alert alert-success" role="alert">Na tvůj email bylo odesláno nové heslo, co nejdříve si ho změň v nabídce "Můj účet"!</div>';
        } else {
            $this->db->Disconnect();
            return '<div class="alert alert-danger" role="alert">Na tento email se u nás ještě nikdo neregistroval. <a href="?page=registrace">Registruj se</a>.</div>';
        }
    }
    
    public function zmenHeslo($puvodni, $nove) {
        $query = "UPDATE " . UZIVATEL . " SET heslo = '".$nove."' WHERE heslo = '" . $puvodni . "';";
        
        $result = $this->db->DBUpdate($query);
        if ($result == 1) {
            $this->db->Disconnect();
            return '<div class="alert alert-success" role="alert">Heslo bylo úspěšně změněno!</div>';
        } else {
            $this->db->Disconnect();
            return '<div class="alert alert-danger" role="alert">Někde nastala chyba! Zřejmě jste zadal(a) špatné původní heslo.</div>';
        }
    }
}

?>