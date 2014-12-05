<?php

class RegistraceKontroler extends Kontroler {
    public function zpracuj($URL) {
        $this->title = "Registrace";
        
        $pohled = $this->getSablona($URL);
        $template_params = $this->getPole();
        
        if (!Session::isPrihlasen()) {
           $this->prihlaseni = getTlacitko();
           $template_params['captcha'] = '<span class="col-sm-2 control-label">Ochrana proti spamu: <span style="color: red;">*</span></span><div class="col-sm-10"><div class="g-recaptcha" data-sitekey="6Le8ov4SAAAAAEJhUu4dhQT3aaneBS1ob7nNM-af"></div></div>';
        }
        else {
            $this->prihlaseni = getUzivatelskeMenu(Session::getEmail());
        }
        
        if (isset($_POST['jmeno']) && isset($_POST['email']) && isset($_POST['heslo1']) && isset($_POST['heslo2'])) {
            if ($_POST['heslo1'] == $_POST['heslo2']) {
                if ((strlen($_POST['jmeno']) > 2) && (strlen($_POST['heslo1']) > 5)) {
                    $recaptcha = $_POST['g-recaptcha-response'];
                    if (!empty($recaptcha)) {
                        $userIP = $_SERVER["REMOTE_ADDR"];
                        $secretKey = "6Le8ov4SAAAAAONgF-Q8tR_vyAvPIBeqmCq_1Mqw";
                        $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptcha}&remoteip={$userIP}");

                        if(!strstr($request, "true")) {
                            $this->info = '<div class="alert alert-danger" role="alert">Neprošli jste kontrolou!</div>';
                        }
                        else {
                            $jmeno = $_POST['jmeno'];
                            $email = strtolower($_POST['email']);
                            $heslo = md5(sha1($_POST['heslo1']));
                            $nahodny_retezec = nahodny_retezec(30);
                            $odkaz = "www.quatrofin.cz/?page=registrace&autorizace=".$nahodny_retezec;
                            $text_emailu = "Dobrý den, děkujeme Vám za registraci na našem webu! Pro dokončení registrace a pro autorizaci Vašeho účtu klikněte na níže uvedený odkaz.\n\n\n".$odkaz."";
                            //mail($email, "Dokončení registrace", $text_emailu, "MIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\nContent-Transfer-Encoding: 8bit" . "\r\n" . "From: " . "quatrofin.cz" . "<info@quatrofin.cz>");
                            $registrace = new DbRegistrace();
                            $vysledek = $registrace->vlozUzivatele($jmeno, $email, $heslo, $nahodny_retezec);
                            $this->info = $vysledek;
                        }
                    } 
                    else {
                        $this->info = '<div class="alert alert-danger" role="alert">Musíte povrdit, že nejste robot!</div>';
                    }
                }
                else {
                    $this->info = '<div class="alert alert-danger" role="alert">Nezadali jste jméno delší než 2 znaky, nebo máte heslo kratší než 6 znaků!</div>';
                }
            }
            else {
                $this->info = '<div class="alert alert-danger" role="alert">Zadaná hesla se neshodují!</div>';
            }
        }
        
        if (isset($_REQUEST["autorizace"])) {
            $hash = $_REQUEST["autorizace"];
            $autorizace = new DbRegistrace();
            $vysledek = $autorizace->autorizujUzivatele($hash);
            $this->info = $vysledek;
        }   
        
        return $pohled->render($template_params);
    }
}

?>