<?php

class App {
    
    private static $instance = null;
    private $smerovac = null;
    private $db = null;
    
    private function App() {
        $this->db = new Db();
        $this->smerovac = Smerovac::getInstance();
    }
    
    public function getConnectionDb() {
    	return $this->db->GetConnection();
    }
    
    public function connectDb() {
    	$this->db->Connect();
    }
    
    public function disconnectDb() {
    	$this->db->Disconnect();
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