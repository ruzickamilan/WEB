<?php

abstract class Kontroler {

    protected $title;
    protected $prihlaseni;
    protected $info;
    protected $params;

    protected function getSablona($URL) {
        $cestaSablony = POHLEDY;
        $cesta = $this->getPohled($URL);
        $loader = new Twig_Loader_Filesystem($cestaSablony);
        $twig = new Twig_Environment($loader);
        return $twig->loadTemplate($cesta);
    }

    protected function zpracuj($URL) {
        $template = $this->getSablona($URL);
        return $template->render(array());
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function getPrihlaseni() {
        return $this->prihlaseni;
    }
    
    public function getInfo() {
        return $this->info;
    }
    
    public function getPole() {
        return $this->params = Array();
    }

    public function getPohled($URL) {
        return $URL . '.inc.php';
    }

    public function presmeruj($URL) {
        header("Location: /" . PODSLOZKA . $URL);
        header("Connection: close");
        exit;
    }
}

?>