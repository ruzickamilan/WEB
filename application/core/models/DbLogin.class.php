<?php

class DbLogin extends Db {
    private $db;
    
    public function DbLogin() {
        $this->db = new Db();
        $this->db->GetConnection();
        $this->db->Connect();
    }
    
    public function najdiUzivatele($email, $heslo) {
        $columns = "jmeno, email, telefon, typ_uctu, autorizace, ban";
        $where = array(
                    array(
                        'column' => "email",
                        'symbol' => " = ",
                        'value' => "".$email.""
                    ),
                    array (
                        'column' => "heslo",
                        'symbol' => " = ",
                        'value' => "".$heslo.""
                    )
                );
        
        $row = $this->db->DBSelectOne(UZIVATEL, $columns, $where);
        if ($row) {
            if ($row['ban'] == 0) {
                Session::login();
                Session::pamatujUzivatele($row['jmeno'], $row['email'], $row['telefon'], $row['typ_uctu'], $row['autorizace']);
                return "<div class='alert alert-success' role='alert'>Přihlášení proběhlo v pořádku! Pokud neproběhne přesměrování <a href='?page=muj_ucet'>klikněte sem</a>.</div>
                        <script type = 'text/javascript'>setTimeout(\"location.href='?page=muj_ucet';\", 1500);</script>    
                       ";
            }
            else {
                return '<div class="alert alert-danger" role="alert">Tento účet byl zablokován z důvodu nevhodného chování na serveru!</div>';
            }
        }
        else {
            return '<div class="alert alert-danger" role="alert">Neplatný uživatel! Zkontroluj si své přihlašovací údaje.<br /><a href="?page=zapomenute_heslo">Zapomněl(a) jsem heslo</a></div>';
        }
        $this->db->Disconnect();
    }
}

