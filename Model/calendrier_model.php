<?php
    require 'connexion_bdd.php';
    class calendrier{
        private $_id;
        public $_date;
        function AjouterCalendrier($date){
            $conn=new connexion();
            $connexion= $conn->getinstance();
            $calendrier= new calendrier();
            $calendrier->_date= date("Y-m-d");
            $requete= 'insert into calendrier (date) values ('.$calendrier->_date.');';
            $resultat= $connexion->query($requete);
            $date_result= $this->TrouverCalendrier($date);
            return $date_result;
        }
        function TrouverCalendrier($date){
            $conn=new connexion();
            $connexion= $conn->getinstance();
            $requete= 'select * from calendrier where date="'.$date.'";';
            $resultat= $connexion->query($requete);
            $data=$resultat->fetch();
            if($data == null){
                return null;
            }else
            {   
                $calendrier=new calendrier();
                $calendrier->_id=$data['id'];
                $calendrier->_date=$data['date'];
                return $calendrier;
            }
        }
    }
    
?>