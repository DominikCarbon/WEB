<?php

$mysqli = new mysqli("localhost","root","","piscine");
			mysqli_set_charset($mysqli, "utf8");
if ($mysqli -> connect_errno) {
				echo "Failed to connect to MySQL: " . $mysqli -> connect_error;}
				//ERREUR DE CONNEXION 
else   //SI AUCUNE ERREUR
{
    if(isset($_POST['button']));  //ON VALIDE TOUTES SES INFOS
        {echo "ok";
        $mail = htmlspecialchars($_POST['mail']);
        $nom = htmlspecialchars($_POST['Nom']);
        $prenom = htmlspecialchars($_POST['Prenom']);
        $tel = htmlspecialchars($_POST['Telephone']);
        $adresse1 = htmlspecialchars($_POST['Adresse1']);
        $adresse2 = htmlspecialchars($_POST['Adresse2']);
        $ville = htmlspecialchars($_POST['Ville']);
        $code = htmlspecialchars($_POST['Code']);
        $pays = htmlspecialchars($_POST['Pays']);
        $mdp = sha1($_POST['mdp']);
        $mdpC = sha1($_POST['mdpC']);
         
        $maillength = strlen($mail); //Taille du pseudo
         
         if($maillength <= 255)   //Si elle correspond 
         {
             if($mdp == $mdpC)    // Si les mots de passe correspondent
             {
                 $query = "INSERT INTO `client`(`mail`, `mdp`, `nom`, `prenom`, `adresse1`, `adresse2`, `ville`,`pays`,`code`,`tel`,`photo`,`fond`) VALUES ('". $mail ."', '". $mdp ."', '". $nom ."', '". $prenom ."', '". $adresse1 ."', '". $adresse2 ."', '". $ville  ."', '". $pays ."' , '". $code ."' , '". $tel ."','"."','"."');";
			
			if ($mysqli->query($query) === TRUE) {
					echo "Added successfully";
                header('Location:LogClient.html');
				} 
				else {
					echo "Error: " . $query . "<br>";
				}
			$mysqli -> close();
             }
             else  // S'ils ne correspondent pas
             {
                 echo "Mot de passe ne correspond pas";
             }
             
         }
         else    // Si elle est trop grande
         {
             echo "pseudo trop long";
         }
        }
}
		
		echo "<hr>";
		


?>