<?php 
    include 'calendrier_model.php';
    class mouvement{
        public $_id;
        public $_quantite;
        public $_id_produit;
        public $_id_calendrier;

        function ListerMouvement($id_produit){
            $conn=new Connexion();
            $connexion= $conn->getinstance();
            $requete= 'select * from mouvement where id_produit='.$id_produit.';';
            $resultat= $connexion->query($requete);
            $i=0; $stock=0;
            while($data=$resultat->fetch()){
                $mouvement[$i]=new mouvement();
                $mouvement[$i]->_id=$data['id'];
                $mouvement[$i]->_quantite=$data['quantite'];
                $mouvement[$i]->_id_produit=$data['id_produit'];
                $mouvement[$i]->_id_calendrier=$data['id_calendrier'];
                $stock=$stock+(int)$data['quantite'];
                $i++;
            }
            $resultat_final['mouvement']=$mouvement;
            $resultat_final['stock']=$stock;
            return $resultat_final;
        }

        function AjouterMouvement($idprod, $quantite, $date){
            $conn=new Connexion();
            $connexion= $conn->getinstance();
            $mouvement=new mouvement();
            $mouvement->_id_produit=$idprod;
            $mouvement->_quantite=$quantite; 
            $calendrier=new calendrier();
            $calendrier = $calendrier->TrouverCalendrier($date);
            if($calendrier != null){
                $mouvement->_id_calendrier=$calendrier->_id;
            }else{
                $calendrier=new calendrier();
                $calendrier=$calendrier->AjouterCalendrier($date);
                $mouvement->_id_calendrier= $calendrier['id'];
            }
            $requete='insert into mouvement (quantite,id_produit,id_calendrier) values ('.(int)$mouvement->_quantite.','.(int)$mouvement->_id_produit.','.(int)$mouvement->_id_calendrier.');';
            $resultat= $connexion->query($requete);
            $mouvement->_id=$resultat->lastInsertId();
            return $mouvement;
        }

        function ModifierMouvement($id,$quantite){
            $mouvement=new mouvement();
            $mouvement->_id=$id;
            $mouvement->_quantite=$quantite; 
            $requete='update mouvement set quantite='.$mouvement->_quantite.' where id='.$mouvement->_id.';';
            $conn=new Connexion();
            $connexion= $conn->getinstance();
            $resultat= $connexion->query($requete);
            $mouvement=$this->TrouverMouvement($id);
            return $mouvement;
        }

        function TrouverMouvement($id){
            $conn=new Connexion();
            $connexion= $conn->getinstance();
            $requete= "select * from mouvement where id=".$id.";";
            $resultat= $connexion->query($requete);
            $data=$resultat->fetch();
            if($data == null){
                return null;
            }else
            {   
                $mouvement=new mouvement();
                $mouvement->_id=$id;
                $mouvement->_quantite=$data['quantite'];
                $mouvement->_id_produit=$data['id_produit'];
                $mouvement->_id_calendrier=$data['id_calendrier'];
                return $mouvement;
            }
        }

        function SupprimerMouvement($id){
            $mouvement_supprimer= $this->TrouverMouvement($id);
            if($mouvement_supprimer != NULL){
                $conn=new Connexion();
                $connexion= $conn->getinstance();
                $requete='delete from mouvement where id='.$id.';';
                $resultat= $connexion->query($requete);
                return 1;
                }
            else return null;
        }
    }
?>