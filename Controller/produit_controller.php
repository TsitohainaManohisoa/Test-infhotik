<?php
    require 'Model/produit_model.php';
    class produit_controlleur{
        function lister_produit(){
            header("Content-Type: application/json");
            $produit=new produit();
            $resultat=$produit->Trouver_Tous();
            return json_encode($resultat);
        }
        function ajouter_produit($designation,$image){
            header("Content-Type: application/json");
            $produit=new produit();
            $resultat=$produit->AjouterProduit($designation,$image);
            return json_encode($resultat);
        }
        function update_produit($id, $designation){
            header("Content-Type: application/json");
            $produit=new produit();
            $resultat=$produit->UpdateProduit($id,$designation);
            return json_encode($resultat);
        }
        function supprimer_produit($id){
            header("Content-Type: application/json");
            $produit=new produit();
            $resultat=$produit->SupprimerProduit($id);
            return json_encode($resultat);
        }
    }
?>