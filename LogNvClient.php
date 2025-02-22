<?php

$mysqli = new mysqli("localhost","root","","piscine");
			mysqli_set_charset($mysqli, "utf8");
if ($mysqli -> connect_errno) {
				echo "Failed to connect to MySQL: " . $mysqli -> connect_error;}
				//ERREUR DE CONNEXION 
else   //SI AUCUNE ERREUR
{
    if(isset($_POST['button']))  //ON VALIDE TOUTES SES INFOS
    {
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
			
			if ($mysqli->query($query) === TRUE)
            {
                header('Location:LogClient.php');
            } 
            else 
            {
                $erreur=  "Error: " . $query . "<br>";
            }
			$mysqli -> close();
            }
            else  // S'ils ne correspondent pas
            {
                $erreur= "Les mots de passe ne correspondent pas";
            }
             
        }
        else    // Si elle est trop grande
        {
            $erreur= "pseudo trop long";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Page de création de compte Client</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    
<style>
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
    
fieldset {
  margin-bottom: 15px;
  padding: 10px;
}
 
legend {
  padding: 0px 3px;
  font-weight: bold;
  font-variant: small-caps;
}
 
label {
  width: 110px;
  display: inline-block;
  vertical-align: top;
  margin: 6px;
}
 
em {
  font-weight: bold;
  font-style: normal;
  color: #f00;
}

input:hover{
    background-color: darkgray;
}
 
input:focus {
  background: #eaeaea;
}
 
input[type=submit] {
  width: 150px;
  padding: 10px;
}

input[type=submit]:hover {
    color:white;
    background-color: darkgray;
}

#n
{
    text-align: justify;
    width:170px;
}
    
input{
    margin-bottom: 7px;
    border-radius: 10px 10px;}
    

    h1{
        margin-bottom: 50px;
    }
    em
    {color: red;}

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
        <img src="LogoEE.png" alt="Logo Ebay ECE" title="Vous aimez notre Logo ? Cliquez pour le voir en grand !" width="200px" height="200px">
        <h1>Complétez vos informations personnelles</h1>
    </center>    
    </div>
    
    <center>
    <form action="" method="post" enctype="multipart/form-data">
        <p><i>Les champs marqués par un </i><em>*</em><i> sont </i><em>obligatoires</em></p>
        
        <fieldset>
        <legend>Identifiants</legend>
            <label id="n">Nom d'utilisateur(mail) <em>*</em></label>
            <input type="email" name="mail" placeholder="Entrez votre nom d'utilisateur" required><br/>
            <label>Mot de passe <em>*</em></label>
            <input type="password" name="mdp" placeholder="Entrez votre mot de passe" required><br/>
            <label>Mot de passe <em>*</em></label>
            <input type="password" name="mdpC" placeholder="Confirmez votre mot de passe" required><br/>
        </fieldset>
        
        <fieldset>
        <legend>Coordonnées</legend>
            <label>Nom <em>*</em></label>
            <input type="text" name="Nom" placeholder="Entrez votre Nom" required><br/>
            <label>Prénom <em>*</em></label>
            <input type="text" name="Prenom" placeholder="Entrez votre Prénom" required><br/>
            <label>Téléphone <em>*</em></label>
            <input type="text" name="Telephone" placeholder="Entrez votre Numéro Tél." required><br/>
        </fieldset>
        
        <fieldset>
            <legend>Adresse de Facturation / Livraison</legend>
            <label>Adresse <em>*</em></label>
            <input type="text" name="Adresse1" placeholder="Ligne d'adresse 1" required><br/>
            <label>Adresse </label>
            <input type="text" name="Adresse2" placeholder="Ligne d'adresse 2"><br/>
            <label>Ville <em>*</em></label>
            <input type="text" name="Ville" placeholder="Entrez votre Ville" required><br/>
            <label> Code Postal <em>*</em></label>
            <input type="number" name="Code" placeholder="Entrez le code postal" required><br/>
            <label>Pays <em>*</em></label>
            <input type="text" name="Pays" placeholder="Entrez votre Pays" required><br/>
        </fieldset>
        
        <?php
            if(isset($erreur))
            {
                echo '<br/><font color="red">'.$erreur.'</font>';
            }
        ?>
        
        <p><input type="submit" name="button" value="Valider"></p>
        

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