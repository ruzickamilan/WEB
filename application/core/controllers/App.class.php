<?php

class App {
    
    private static $instance = null;
    private $smerovac = null;
    
    private function App() {
        $this->smerovac = Smerovac::getInstance();
    }
    
    public function getSmerovac(){
        return $this->smerovac;
    }

    public static function getInstance(){
        if (isset($instance)){
            return $instance;
        }
        else {
            $instance = new App();
            return $instance;
        }
    }
}

?>