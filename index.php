<?php
    // NASTAVENI WEBU
    require 'config/config.inc.php';

    // START APLIKACE
    $app = App::getInstance();
    
    // SMEROVAC A KONTROLER
    $smerovac = $app->getSmerovac();
    $smerovac->zpracuj($_REQUEST["page"]);
    $kontrolerTrida = $smerovac->getKontroler();
    $kontroler = new $kontrolerTrida;
    $pohled = $kontroler->zpracuj($smerovac->getCesta());
    
    // SABLONA
    $loader = new Twig_Loader_Filesystem(SABLONA);
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate('sablona.php');

    // NACTE HLAVNI SABLONU
    $template_params = $kontroler->getPole();
    $template_params['title'] = "Quatrofin - " . $kontroler->getTitle();
    $template_params['prihlaseni'] = $kontroler->getPrihlaseni();
    $template_params['info'] = $kontroler->getInfo();
    $template_params['obsah'] = $pohled;
  
    echo $template->render($template_params);
    
?>