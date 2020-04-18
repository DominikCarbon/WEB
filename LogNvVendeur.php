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
                
                 /*$sql = "SELECT * FROM `vendeur`";
                $result = $mysqli -> query($sql);
                 while ($data = mysqli_fetch_assoc($result)) 
                 {
                    $id=$data['id'];
                     mkdir('vendeur/items/'.$id,0700,true);*/
                     header('Location:LogVendeur.html');
                // }//end while
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
<!DOCTYPE html>
<html lang="en">
<head>
<title>Page de création de compte Vendeur</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="LogNvClient.css"/>

<style>
    body{
        background-color : white;}
    input
    {
        margin-bottom: 7px;
        border-radius: 10px 10px; 
    }
    
    input:hover{
        color:white;
        background-color: darkgray;
    }
    
    input[type=number] {
  width: 200px;
  padding: 2px;
}     

input[type=password] {
  width: 200px;
  padding: 2px;
}     

input[type=email] {
  width: 200px;
  padding: 2px;
} 
    
input[type=text] {
  width: 200px;
  padding: 2px;
}  
    
    #informations
    {
        background-color: whitesmoke;
        border:  1px groove grey;
        border-radius: 10px;
        margin-left: 100px;
        margin-right: 100px;
        padding-top: 0px;
        padding-bottom: 20px;
    }
    h1{
        margin-bottom: 50px;
    }
    em
    {
        color: red;
    }
    .container-fluid
    {

        padding-top:50px;
        background-color:lightgrey;
    }
    
    #logo
    {
        background-color:lightgrey;
        padding-bottom: 30px;
        margin-bottom: 10px;
    }
</style>
    
</head>
<body>
    <div id="logo">
    <center>
    <img src="LogoEE.png" alt="Logo Ebay ECE" title="Vous aimez notre Logo ?<br/> Cliquez pour le voir en grand !" width="200px" height="200px">
    <h1>Complétez vos informations personnelles</h1>
    </center>
    </div>
    <center>
    <form action="" method="post" enctype="multipart/form-data">
        <p><i>Les champs marqués par un </i><em>*</em><i> sont </i><em>obligatoires</em></p>
        
        <fieldset>
        <legend>Coordonnées</legend>
        <label>Nom <em>*</em></label>
        <input type="text" name="Nom" placeholder="Entrez votre Nom" required><br/>
        <label><b>Prénom</b><em>*</em></label>
        <input type="text" name="Prenom" placeholder="Entrez votre Prénom" required><br/>
        <label><b>Mail</b><em>*</em></label>
        <input type="email" name="mail" placeholder="Entrez votre Mail" required><br/>
        <label><b>Pseudo</b><em>*</em></label>
        <input type="text" name="mdp" placeholder="Entrez un Pseudo" required="">
        <br/>
        <hr/>
        <p><input type="submit" name="button" value="Valider"></p>
        </fieldset>
    </form>
    </center>
        
<hr/>
<footer class="container-fluid text-center">
  <p><small>
		Conçu par: Dominik Carbon & Wachani Mehdi<br>
		Contact :<a href="mailto:dominik.carbon@edu.ece.fr"> dominik.carbon@edu.ece.fr</a><br/>
      Contact :<a href="mailto:dominik.carbon@edu.ece.fr"> mehdi.wachani@edu.ece.fr</a><br/>
		Copyright &copy; 2020
	</small></p>
</footer>

</body>
</html>