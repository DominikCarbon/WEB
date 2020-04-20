<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');

    if(isset($_POST['button']))  //ON VALIDE TOUTES SES INFOS
        {
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
                     
                    header('Location:Client2.php'); // On redirige le client vers la page, mais dans sa propre session
                }
                else
                {
                    $erreur= "Mauvais identifiant ou mot de passe";
                }
            }
            else    // Si elle est trop grande
            {
                $erreur= "pseudo trop long";
            }
        }
		
		echo "<hr>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Page de connexion Client</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
    body{
        background-color : white;}
    input{
        margin-bottom: 7px;}
    #connexion{
        background-color: whitesmoke;
        border:  1px groove grey;
        border-radius: 10px;
        margin-left: 500px;
        margin-right: 500px;
        padding-top: 0px;
        padding-bottom: 20px;}
    
</style>
    
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        
        <center><h1>Connexion Client</h1>
        <img src="LogoEE.png" alt="Logo Ebay ECE" title="Vous aimez notre Logo ? Cliquez pour le voir en grand !" width="200px" height="200px">
        <div id=connexion>
        <table>
        <tr>
        <td><label><b>Nom d'utilisateur (mail)</b></label></td>
        </tr>
        <tr>
        <td><input type="text" name="LoginC" placeholder="Entrez votre mail" required></td><br/>
        </tr>
        <tr>
        <td><label><b>Mot de passe</b></label></td>
        </tr>
        <tr>
        <td><input type="password" name="mdpC" placeholder="mot de passe" required></td><br/>
        </tr>
        <tr>
        <td> &nbsp; </td>
        </tr>
        <tr>
        <td colspan="2" align="center"><input type="submit" name="button" value="Valider"></td><br/>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td colspan="2"> Pas encore client chez nous?</td>
        </tr>
        <tr>
            <td colspan="2" align="center"> <a href="LogNvClient.php" alt="Créer mon compte" title="Cliquez ici pour vous créer un compte client !"> Je créé mon compte </a></td>
        </tr>
        </table>
        </div>
        <?php
            if(isset($erreur))
            {
                echo '<br/><font color="red">'.$erreur.'</font>';
            }
        ?>
        </center>

    </form>

<footer class="container-fluid text-center">
    <hr/>
  <p><small>
		Conçu par: Dominik Carbon & Wachani Mehdi<br>
		Contact :<a href="mailto:dominik.carbon@edu.ece.fr"> dominik.carbon@edu.ece.fr</a><br/>
		Copyright &copy; 2020
	</small></p>
</footer>

</body>
</html>
