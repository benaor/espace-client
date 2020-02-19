<?php

function inscription(){
    
    //on se connecte a la base de données
    $bdd = new PDO('mysql:host=localhost:3308;dbname=cloud','root','');

    //si on clique sur le bouton "je m'inscris"
    if(   isset(   $_POST['inscription']   )   ){

        $nom         = htmlspecialchars($_POST['name']);
        $prenom      = htmlspecialchars($_POST['firstName']);
        $tel         = htmlspecialchars($_POST['phone']);
        $mail        = htmlspecialchars($_POST['mail']);
        $mail2       = htmlspecialchars($_POST['mail2']);
        $naissance   = htmlspecialchars($_POST['naissance']);
        $identifiant = htmlspecialchars($_POST['user']);
        $mdp         = sha1($_POST['password']);
        $mdp2        = sha1($_POST['password2']);


        //On verifie que tous les champs soient rempli 
        if(   !empty($_POST['name']) &&    !empty($_POST['firstName']) &&    !empty($_POST['phone']) &&    !empty($_POST['mail']) &&    !empty($_POST['mail2']) &&    !empty($_POST['naissance']) &&    !empty($_POST['user']) &&    !empty($_POST['password']) &&    !empty($_POST['password2'])  ){

            //On verifie la longueur de l'identifiant 
            if(strlen($identifiant) <= 16){         

                //on verifie que les mots de passe sont identiques
                if($_POST['password'] == $_POST['password2'] ){
               
                    //On verifie la longueur du mdp
                    if(strlen($_POST['password']) <= 16){

                        //on verifie que les deux mails sont identiques
                        if($mail == $mail2){
                            
                            //On verifie la validité de l'adresse mail
                            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){

                                //On verifie que l'identifiant ne soit pas deja utilisé
                                $reqid = $bdd->prepare("SELECT * FROM membres WHERE identifiant_membre = ?");
                                $reqid->execute(array($identifiant));
                                $idexist = $reqid->rowCount();

                                if($idexist == 0){
                                    
                                    //on insert les données dans la table "user"
                                    $insertmbr = $bdd->prepare("INSERT INTO membres(nom_membre, prenom_membre, tel_membre, mail_membre, naissance_membre, identifiant_membre, mdp_membre) VALUES(?,?,?,?,?,?,?)");
                                    $insertmbr->execute(array($nom, $prenom, $tel, $mail, $naissance, $identifiant, $mdp));
                                
                                    //On redirige automatiquement vers index.php et on crée un dossier au nom de l'user
                                    $structure = "fichier_client/".$identifiant;
                                    mkdir($structure, 0777, TRUE);
                                    header('location: index.php');
                                    }

                                    else{
                                        //si l'email est deja utilisé 
                                        $erreur = "Cet email est déjà utilisé";
                                    }


                            }
                            else{
                                //si l'email n'est pas valide
                                $erreur = "l'adresse email n'est pas valide";
                            }

                        }

                        else{
                            //si les mails ne sont pas identiques
                            $erreur = "les deux mails sont differents";
                        }
                    }

                    else{
                        //Si l'identifiant est trop long
                        $erreur = "Le mdp est trop long";
                    }
                }
                else{
                    //si les mdps sont differents
                    $erreur = "les deux mdp ne correspondent pas";
                }

            }
            else{
                //Si l'identifiant est trop long
                $erreur = "L'identifiant est trop long";
            }
        }
        else{
            //si tous les champs ne sont pas rempli
            $erreur = "Tous les champs doivent être rempli";
        }

    }


}

function connexion(){
     //on se connecte a la base de données
     $bdd = new PDO('mysql:host=localhost:3308;dbname=cloud','root','');

     //lorsqu'on clique sur submit
     if(   isset(   $_POST['connexion'])   ){
 
         //On recupère dans une variable l'identifiant et le mdp, et on securise (eviter l'injection SQL + chiffrage du mdp)
         $user = htmlspecialchars($_POST['user']);
         $password    = sha1($_POST['password']);
 
         //On verifie que les champs soient rempli
         if(  !empty($_POST['user'])   &&   !empty($_POST['password'])  ){
 
             // On compare l'identifiant et le mdp saisi avec ceux de la base de données
             $reqidentification = $bdd->query("SELECT * FROM membres WHERE identifiant_membre = '$user' AND mdp_membre = '$password'");
             $tableau = $reqidentification->fetch(PDO::FETCH_ASSOC);
 
             if(is_array($tableau)){
                 $_SESSION['user']=$tableau['prenom_membre'];
                 $_SESSION['identifiant'] = $tableau['identifiant_membre'];
                 echo "redirection vers votre espace membre";
                 header('location:espace.php');
             }
 
             else{
                 $erreur = "identifiant incorrect";
             }
 
         }
 
         else{
             //si les champs ne sont pas tous rempli
             $erreur = "tous les champs doivent être rempli";
         }
     }
}

function creeDossier(){

    //Quand new_dossier est submit
    if(isset($_POST['new_dossier'])){

        //On verifie que new_dossier contient quelque chose
        if(!empty($_POST['new_dossier'])){


         
            //On sécurise le contenu pour eviter les injection de script
            $nomNewDossier = htmlspecialchars($_POST['new_dossier']);
            $identifiant   = htmlspecialchars($_SESSION['identifiant']);

            //On crée le nouveau dossier dans le dossier perso de l'utilisateur
            $structure = "fichier_client/".$identifiant."/".$nomNewDossier;
            mkdir($structure, 0777, TRUE);
        }

        else{
        echo "Le champs ne doit pas être vide";
        }

    }

}

?>