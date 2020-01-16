<?php 
class maClasse {
    private static $instance;
    public static function getInstance() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }
    public function __clone()
    {      
        trigger_error('Le clônage n\'est pas autorisé.', E_USER_ERROR);    
    }
    public function maMethode()
    {
        echo 'Tout  fonctionne';
    }
}
maClasse::getInstance()->maMethode();
?> 