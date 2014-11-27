<?php

    function printr($nadpis, $val= NULL) {
        echo "<hr><pre>";
        echo "<h2>" . $nadpis . "</h2>";
        print_r($val);
        echo "</pre><hr>";
    }
    
?>

