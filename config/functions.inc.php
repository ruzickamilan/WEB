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
    
    function getUzivatel($email) {
        return '<a class = "dropdown-toggle" href = "#" data-toggle = "dropdown" aria-expanded = "true">
                    <i style="color: red;" class = "fa fa-user fa-fw"></i>&nbsp;
                    <i class = "fa fa-caret-down"></i>
                </a>
                <ul id="menuUzivatele" class = "dropdown-menu dropdown-user">
                    <li style="padding: 10px; text-align: center; font-weight: bold;"> '.$email.' </li>
                    <li style = "margin: 0 auto" class = "divider"></li>
                    <li>
                        <a href = "?page=muj_ucet">
                        <i class = "fa fa-gear fa-fw"></i>
                           Můj účet
                        </a>
                    </li>
                    <li>
                        <a style = "border-radius: 0 0 5px 5px;" href = "?page=uvod&odhlaseni=true">
                        <i class = "fa fa-sign-out fa-fw"></i>
                            Odhlásit 
                        </a>
                    </li>
                </ul>
        ';
    }

?>

