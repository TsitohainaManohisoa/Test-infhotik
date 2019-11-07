<?php
    require 'Model/mouvement_model.php';
    class mouvement_controlleur{
        
        function ListerMouvement($idprod){
            header("Content-Type: application/json");
            $mouvement = new mouvement();
            $resultat=$mouvement->ListerMouvement($idprod);
            return json_encode($resultat);
        }

        function AjouterMouvement($idprod, $quantite, $type, $date){
            header("Content-Type: application/json");
            $mouvement = new mouvement();
            $type=(int)$type;
            if($type == 1){//1 pour achat
                $quantite=$quantite; 
            }else{// else pour vente
                $quantite=(int)$quantite*(-1);
            }
            $mouvement= $mouvement->AjouterMouvement($idprod, $quantite, $date);
            return json_encode($mouvement);
        }

        function ModifierMouvement($id,$quantite, $type){
            header("Content-Type: application/json");
            if($type == 1){//1 pour achat
                $quantite=$quantite; 
            }else{// else pour vente
                $quantite=(int)$quantite*(-1);
            }
            $mouvement = new mouvement();
            $mouvement = $mouvement->ModifierMouvement($id,$quantite);
            return json_encode ($mouvement);
        }
        
        function SupprimerMouvement($id){
            header("Content-Type: application/json");
            $mouvement = new mouvement();
            $resultat = $mouvement->SupprimerMouvement($id);
            return json_encode($resultat);
        }
    }
?>