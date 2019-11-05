<?php 
    namespace Model;
    require 'connexion_bdd.php';
    class produit{
        private $_designation;
        private $_id;
        private $_lien;
        function __construct($id,$designation,$lien){
            $this->_id=$id;
            $this->_designation=$designation;
            $this->_lien=$lien;
        }

        function Trouver($id){
            $conn=new connexion();
            $connexion= $conn->getinstance();
            $requete= "select * from produit where id=".$id.";";
            $resultat= $connexion->query($requete);
            $data=$resultat->fetch();
            if($data == null){
                return 0;
            }else
            {
                $produit=new produit($id, $data['designation'], $data['lien']);
                return $produit;
            }

        }

        function AjouterProduit($designation, $image){
            if(isset($image) AND $image['error']==0){
                if($image['size'] >= 2000000){
                    return null; //1 pour fichier trop volumineux
                }else{
                        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                        $extension = strrchr($image['name'], '.');
                        if(in_array($extension, $extensions)){
                            $dossier = 'upload/';
                            $fichier = basename($image['name']);
                            move_uploaded_file($image['tmp_name'], $dossier . $fichier);
                            $this->_lien = $dossier . $fichier;
                        }else return null;
                    }
            }
            $this->_designation=$designation;
            $conn=new connexion();
            $connexion= $conn->getinstance();

        }
        
        function UpdateProduit($id,$designation){

        }

        function SupprimerProduit($id){
            $produit_supprimer= Trouver($id);
            if($produit_supprimer != NULL){
                unlink($produit_supprimer->_lien);
            }
            $conn=new connexion();
            $connexion= $conn->getinstance();
                        
        }
    }
?>