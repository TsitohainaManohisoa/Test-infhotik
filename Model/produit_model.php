<?php 
    require 'connexion_bdd.php';
    class produit{
        public $_designation;
        public $_id;
        public $_lien;
        public $_stock;

        function Trouver_Tous(){
            $conn=new connexion();
            $connexion= $conn->getinstance();
            $requete= "select produit.id, produit.designation, produit.lien, sum(mouvement.quantite) as stock from produit inner join mouvement on mouvement.id_produit=produit.id group by produit.id";
            $resultat= $connexion->query($requete);
            $i=0;
            while($data=$resultat->fetch()){
                $produit[$i]=new produit();
                $produit[$i]->_designation=$data['designation'];
                $produit[$i]->_id=$data['id'];
                $produit[$i]->_lien=$data['lien'];
                $produit[$i]->_stock=$data['stock'];
                $i++;
            }
            return $produit;
        }

        function Trouver($id){
            $conn=new connexion();
            $connexion= $conn->getinstance();
            $requete= "select * from produit where id=".$id.";";
            $resultat= $connexion->query($requete);
            $data=$resultat->fetch();
            if($data == null){
                return null;
            }else
            {   
                $produit=new produit();
                $produit->_id=$id;
                $produit->_designation=$data['designation'];
                $produit->_lien=$data['lien'];
                return $produit;
            }

        }

        function AjouterProduit($designation, $image){
            $conn=new connexion();
            $connexion= $conn->getinstance();
            $requete1="select count(id) from produit";
            $nombre= $connexion->query($requete1)->fetch();
            $produit=new produit();
            if(isset($image) AND $image['error']==0){
                if($image['size'] >= 20000000){
                    return null; //1 pour fichier trop volumineux
                }else{
                        $extensions = array('.png', '.gif', '.jpg', '.jpeg', '.JPG');
                        $extension = strrchr($image['name'], '.');
                        if(in_array($extension, $extensions)){
                            $dossier = 'image/';
                            $fichier = basename($image['name']);
                            move_uploaded_file($image['tmp_name'], $dossier . $fichier);
                            $produit->_lien = $dossier . $fichier;
                        }else return 6;
                    }
            }
            $produit->_designation=$designation;
            $requete= 'insert into produit (designation, lien) values ("'.$produit->_designation.'" , "'.$produit->_lien.'");';
            $resultat= $connexion->query($requete);
            $produit->_id=$resultat->lastInsertId();
            return $produit;
        }
        
        function UpdateProduit($id,$designation){
            $conn=new connexion();
            $connexion= $conn->getinstance();
            $requete= 'update produit set designation = "'.$designation.'" where id='.$id.';';
            $update= $connexion->query($requete);
            $resultat=$this->Trouver($id);
            return $resultat; 
        }

        function SupprimerProduit($id){
            $produit_supprimer= $this->Trouver($id);
            if($produit_supprimer != NULL){
                if($produit_supprimer->_lien!= NULL){
                    unlink($produit_supprimer->_lien);
                }
                $conn=new connexion();
                $connexion= $conn->getinstance();
                $requete='delete from produit where id='.$id.';';
                $resultat= $connexion->query($requete);
                return 1;
                }
            else return null;
        }
    }
?>