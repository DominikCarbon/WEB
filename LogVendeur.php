<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');

    if(isset($_POST['button']))  //ON VALIDE TOUTES SES INFOS
        {echo "ok";
        $mail = htmlspecialchars($_POST['LoginC']);
        $mdp = sha1($_POST['mdpC']);
         
        $maillength = strlen($mail); //Taille du pseudo
         
         if($maillength <= 255)   //Si elle correspond 
         {
                 $recherche = $bdd->prepare("SELECT * FROM vendeur WHERE mail = ? AND mdp = ?");
                 $recherche->execute(array($mail,$mdp));
                 $vendeurexiste = $recherche->rowCount();
                 if($vendeurexiste==1)
                 {
                     $infovendeur = $recherche->fetch();
                     $_SESSION['id']=$infovendeur['id'];
                     $_SESSION['mail']=$infovendeur['mail'];
                     $_SESSION['mdp']=$infovendeur['mdp'];
                     $_SESSION['nom']=$infovendeur['nom'];
                     $_SESSION['prenom']=$infovendeur['prenom'];
                     
                     header('Location:Vendeur.php?id='.$_SESSION['id']); // On redirige l'e client vers la page, mais dans sa propre session
                 }
                 else
                 {
                     echo "Mauvais identifiant ou mot de passe";
                 }
         }
         else    // Si elle est trop grande
         {
             echo "pseudo trop long";
         }
        }
		
		echo "<hr>";
?>