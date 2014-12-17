<?php

class DiskuzeKontroler extends Kontroler{
    public function zpracuj($URL) {
        $this->title = "Diskuze";
        
        $pohled = $this->getSablona($URL);
        $template_params = $this->getPole();
        $diskuze = new DbDiskuze();
        
        if (isset($_REQUEST["reakce"])) {            
            if (Session::isPrihlasen()) {
                if (Session::getAutorizaceDis() == 1) {
                    $id_diskuze = $_REQUEST["reakce"];
                    $template_params['id_diskuze'] = $id_diskuze;
                }
                else {
                    $this->info = '<div class="alert alert-danger" role="alert">Reagovat na dotazy může pouze autorizovaný uživatel!</div>';
                }
            }
            else {
                $this->info = '<div class="alert alert-danger" role="alert">Reagovat na dotazy může pouze přihlášený (registrovaný) uživatel!</div>';
            }
        }
        
        if (isset($_POST['text'])) {
            $jmeno = "";
            $text = $_POST['text'];
            if (!Session::isPrihlasen()) {
                $jmeno = $_POST['jmeno'];
                $email = strtolower($_POST['email']);
                $recaptcha = $_POST['g-recaptcha-response'];
                if (!empty($recaptcha)) {
                    $userIP = $_SERVER["REMOTE_ADDR"];
                    $secretKey = "6Le8ov4SAAAAAONgF-Q8tR_vyAvPIBeqmCq_1Mqw";
                    $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptcha}&remoteip={$userIP}");

                    if(!strstr($request, "true")) {
                        $this->info = '<div class="alert alert-danger" role="alert">Neprošli jste kontrolou!</div>';
                    }
                    else {
                        $vysledek = $diskuze->vlozDotaz($jmeno, $email, $text, 1);
                        $this->info = $vysledek;
                    }
                } 
                else {
                    $this->info = '<div class="alert alert-danger" role="alert">Musíte povrdit, že nejste robot!</div>';
                }
            } 
            else {
                $jmeno = Session::getJmenoDis();
                $email = Session::getEmail();
                $vysledek = $diskuze->vlozDotaz($jmeno, $email, $text, 0);
                $this->info = $vysledek;
            }
        }
        
        if (isset($_POST['text_reakce']) && Session::isPrihlasen() && Session::getAutorizaceDis() == 1) {
            $text = $_POST['text_reakce'];
            $id_diskuze = $_POST['id_diskuze'];
            $id_uzivatele = Session::getId();
            $vysledek = $diskuze->vlozReakci($text, $id_diskuze, $id_uzivatele);
            $this->info = $vysledek;
        }
        
        if (isset($_POST['text_upravy']) && Session::isPrihlasen()) {
            $text = $_POST['text_upravy'];
            $id_dotazu = $_POST['id_diskuze'];
            $email = Session::getEmail();
            $vysledek = $diskuze->upravDotaz($id_dotazu, $text, $email);
            $this->info = $vysledek;
        }
        
        if (Session::isPrihlasen()) {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            if (Session::getTypUctu() == 'admin') {
                $template_params['mazani'] = "<span style='color: red;' class='glyphicon glyphicon-remove'></span>";
                if (isset($_REQUEST["delDotaz"])) {
                    $vysledek = $diskuze->smazDotaz($_REQUEST["delDotaz"]);
                    $this->info = $vysledek;
                }
                if (isset($_REQUEST["delOdpoved"])) {
                    $vysledek = $diskuze->smazOdpoved($_REQUEST["delOdpoved"]);
                    $this->info = $vysledek;
                }
            }
            if (isset($_REQUEST["editDotaz"])) {
                $template_params['id_upravy'] = $_REQUEST["editDotaz"];
            }
            $template_params['jmeno'] = "<span style='color: black;' class='form-control'>".Session::getJmenoDis()."</span>";
            $template_params['email'] = "<span style='color: black;' class='form-control'>".Session::getEmail()."</span>";
            $template_params['email_edit'] = Session::getEmail();
        }
        else {
            $this->prihlaseni = getTlacitko();
            $template_params['jmeno'] = '<input type="text" class="form-control" placeholder="Jméno uživatele" name="jmeno" value="">';
            $template_params['email'] = '<input type="text" class="form-control" placeholder="Váš email (nebude zobrazen)" name="email" value="">';
            $template_params['captcha'] = '<span class="col-sm-2 control-label">Ochrana proti spamu: </span><div class="col-sm-10"><div class="g-recaptcha" data-sitekey="6Le8ov4SAAAAAEJhUu4dhQT3aaneBS1ob7nNM-af"></div></div>';
        }
        
        $vysledek1 = $diskuze->vypisDiskuzi();
        $template_params['diskuze'] = $vysledek1;
        $vysledek2 = $diskuze->vypisOdpovedi();
        $template_params['odpovedi'] = $vysledek2;
        
        $diskuze->odpojDB();
        return $pohled->render($template_params);
    }
}

?>