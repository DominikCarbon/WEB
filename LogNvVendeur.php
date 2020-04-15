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
        $mdp = sha1($_POST['mdp']);
         
        $maillength = strlen($mail); //Taille du mail
         
         if($maillength <= 255)   //Si elle correspond 
         {
        
                 //header('Location:home.html');
                 $query = "INSERT INTO `vendeur`(`mail`, `mdp`, `nom`, `prenom`,`photo`,`fond`) VALUES ('". $mail ."', '". $mdp ."', '". $nom ."', '". $prenom ."','"."','"."');";
			
			if ($mysqli->query($query) === TRUE) {
					echo "Added successfully";
                header('Location:home.html');
				} 
				else {
					echo "Error: " . $query . "<br>";
				}
			$mysqli -> close();

         }
         else    // Si elle est trop grande
         {
             echo "pseudo trop long";
         }
        }
}
		
		echo "<hr>";
		


?>