<?php
    if(isset($_GET['id_produit'])){
        //liste des mouvements
        include 'Controller/mouvement_controller.php';
        $mouvement=new mouvement_controlleur();
        $listes=$mouvement->ListerMouvement($_GET['id_produit']);
        echo $listes;
    }
    else if(isset($_POST['id_produit']) && isset($_POST['quantite']) && isset($_POST['type']) && isset($_POST['date'])){
        //ajouter mouvement
    } 
    else if(isset($_POST['id']) && isset($_POST['quantite']) && isset($_POST['type'])){
        //modifier mouvement
    }
    else if(isset($_POST['id_mouvement'])){
        //supprimer mouvement
    }
    else if(isset($_POST['designation']) && isset($_FILES['image'])){
        //ajouter produit
    }
    else if(isset($_POST['id_produit']) && isset($_POST['designation'])){
        //modifier produit
    }
    else if(isset($_POST['id_produit_supprimer'])){
        //supprimer produit
    }
    else {//recuperer tous les produits
        include 'Controller/produit_controller.php';
        $produit=new produit_controlleur();
        $resultat=$produit->lister_produit();
        echo $resultat;
    }
        
?>
