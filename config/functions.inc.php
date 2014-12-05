<?php

    function printr($nadpis, $val= NULL) {
        echo "<hr><pre>";
        echo "<h2>" . $nadpis . "</h2>";
        print_r($val);
        echo "</pre><hr>";
    }
    
    function getTlacitko() {
        return '<a href="?page=login"><span class="glyphicon glyphicon-log-in"></span> Přihlásit</a>';
    }
    
    function getUzivatelskeMenu($email) {
        return '<a class = "dropdown-toggle" href = "#" data-toggle = "dropdown" aria-expanded = "true">
                    <i style="color: red;" class = "glyphicon glyphicon-user"></i>&nbsp;
                    <i class = "fa fa-caret-down"></i>
                </a>
                <ul id="menuUzivatele" class = "dropdown-menu dropdown-user">
                    <li style="padding: 10px; color: black; text-align: center; font-weight: bold;"> '.$email.' </li>
                    <li style = "margin: 0 auto" class = "divider"></li>
                    <li><a href = "?page=muj_ucet"><i class = "glyphicon glyphicon-cog"></i> Můj účet</a></li>
                    <li><a href = "?page=soukrome_zpravy"><i class = "glyphicon glyphicon-envelope"></i> Soukromé zprávy</a></li>
                    <li><a style = "border-radius: 0 0 5px 5px;" href = "?page=uvod&amp;odhlaseni=true"><i class = "glyphicon glyphicon-log-out"></i> Odhlásit</a></li>
                </ul>
        ';
    }
    
    function nahodny_retezec($delka) {
        $znaky = '_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $hash = '';
        for ($i = 0; $i < $delka; $i++) {
          $hash .= substr($znaky, mt_rand(0, strlen($znaky) -1), 1);
        }
        return $hash;
    }
?>