<?php

$mysqli = new mysqli("localhost","root","","piscine");
			mysqli_set_charset($mysqli, "utf8");
if ($mysqli -> connect_errno) 
{
    $erreur= "Failed to connect to MySQL: " . $mysqli -> connect_error;
}
				//ERREUR DE CONNEXION 
else   //SI AUCUNE ERREUR
{
    if(isset($_POST['button']))  //ON VALIDE TOUTES SES INFOS
    {
        $mail = htmlspecialchars($_POST['mail']);
        $nom = htmlspecialchars($_POST['Nom']);
        $prenom = htmlspecialchars($_POST['Prenom']);
        $mdp = sha1($_POST['mdp']);
         
        $maillength = strlen($mail); //Taille du mail
         
         if($maillength <= 255)   //Si elle correspond 
         {
        
                 //header('Location:home.html');
                 $query = "INSERT INTO `vendeur`(`mail`, `mdp`, `nom`, `prenom`,`photo`,`fond`) VALUES ('". $mail ."', '". $mdp ."', '". $nom ."', '". $prenom ."','"."','"."');";
			
			if ($mysqli->query($query) === TRUE)
            {
					$erreur= "Ajouté avec succès";
                
                 //si le BDD existe, faire le traitement
                
                 $sql = "SELECT * FROM `vendeur`";
                $result = $mysqli -> query($sql);
                 while ($data = mysqli_fetch_assoc($result)) 
                 {
                    $id=$data['id'];
                     mkdir('vendeur/items/'.$id,0700,true);
                     header('Location:LogVendeur.html');
                 }//end while
            }//end if 
             else 
             {
                 $erreur= "Error: " . $query . "<br>";
             }
			$mysqli -> close();
         }
        else    // Si elle est trop grande
        {
             $erreur="pseudo trop long";
        }
        }
}
		
		echo "<hr>";
		


?>