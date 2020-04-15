<?php
session_start();
/*
$mysqli = new mysqli("localhost","root","","piscine");
			mysqli_set_charset($mysqli, "utf8");
if ($mysqli -> connect_errno) {
				echo "Failed to connect to MySQL: " . $mysqli -> connect_error;}
				//ERREUR DE CONNEXION 
else   //SI AUCUNE ERREUR
{ */

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');

    if(isset($_POST['button']))  //ON VALIDE TOUTES SES INFOS
        {echo "ok";
        $mail = htmlspecialchars($_POST['LoginC']);
        $mdpC = sha1($_POST['mdpC']);
         
        $maillength = strlen($mail); //Taille du pseudo
         
         if($maillength <= 255)   //Si elle correspond 
         {
                 $recherche = $bdd->prepare("SELECT * FROM client WHERE mail = ? AND mdp = ?");
                 $recherche->execute(array($mail,$mdpC));
                 $clientexiste = $recherche->rowCount();
                 if($clientexiste==1)
                 {
                     $infoclient = $recherche->fetch();
                     $_SESSION['id']=$infoclient['id'];
                     $_SESSION['mail']=$infoclient['mail'];
                     $_SESSION['mdp']=$infoclient['mdp'];
                     $_SESSION['nom']=$infoclient['nom'];
                     $_SESSION['prenom']=$infoclient['prenom'];
                     $_SESSION['ville']=$infoclient['ville'];
                     
                     header('Location:Client2.php?id='.$_SESSION['id']); // On redirige l'e client vers la page, mais dans sa propre session
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