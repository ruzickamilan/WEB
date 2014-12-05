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
                $recaptcha = $_POST['g-recaptcha-response'];
                if (!empty($recaptcha)) {
                    $userIP = $_SERVER["REMOTE_ADDR"];
                    $secretKey = "6Le8ov4SAAAAAONgF-Q8tR_vyAvPIBeqmCq_1Mqw";
                    $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptcha}&remoteip={$userIP}");

                    if(!strstr($request, "true")) {
                        $this->info = '<div class="alert alert-danger" role="alert">Neprošli jste kontrolou!</div>';
                    }
                    else {
                        $vysledek = $diskuze->vlozDotaz($jmeno, $text);
                        $this->info = $vysledek;
                    }
                } 
                else {
                    $this->info = '<div class="alert alert-danger" role="alert">Musíte povrdit, že nejste robot!</div>';
                }
            } 
            else {
                $jmeno = Session::getJmenoDis();
                $vysledek = $diskuze->vlozDotaz($jmeno, $text);
                $this->info = $vysledek;
            }
        }
        
        if (isset($_POST['text-reakce']) && Session::isPrihlasen() && Session::getAutorizaceDis() == 1) {
            $text = $_POST['text-reakce'];
            $id_diskuze = $_POST['id_diskuze'];
            $id_uzivatele = Session::getId();
            $vysledek = $diskuze->vlozReakci($text, $id_diskuze, $id_uzivatele);
            $this->info = $vysledek;
        }
        
        if (Session::isPrihlasen()) {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
            $template_params['jmeno'] = "<span style='color: black;' class='form-control'>".Session::getJmenoDis()."</span>";
        }
        else {
            $this->prihlaseni = getTlacitko();
            $template_params['jmeno'] = '<input type="text" class="form-control" placeholder="Jméno uživatele" name="jmeno" value="">';
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