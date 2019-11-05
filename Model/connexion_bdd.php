<?php
    class Connexion
    {
        private $_connexion;
        private static $_host='localhost';
        private static $_dbname='gestion_commande';
        private static $_dbpwd='';
        private static $_dbuser='root';
        public function __construct() {
            try {
                $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
                $this->_connexion = new PDO('mysql:host=localhost;dbname=gestion_commande', 'root', '', $pdo_options);
            } catch (PDOException $e) {
                $this->_connexion = NULL;
            }
        }

        public function getinstance( ) {
            return $this->_connexion;
        }
    }
    
?>