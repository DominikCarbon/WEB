<?php
session_start();

//recuperer les données du formulaire
$login = isset($_POST["LoginA"])? $_POST["LoginA"] : "";
$mdp = isset($_POST["mdpA"])? $_POST["mdpA"] : "";

if(isset($_POST['button']))
{  
    if($login=="667")
    {
        $_SESSION['id']="667";
        $serveur = array(
        "667" => "12345",
        "666" => "6789",
        );

        $connexion = false;
        for ($i = 0; $i < count($serveur); $i++) {
            if ($serveur[$login] == $mdp){
            $connexion = true;
            break;}
        }

        if ($connexion) {
            if (isset($_POST['button'])) {
                echo "login successfull !";
                header("Location: homeAdmin.php?id=".$_SESSION['id']);
            }
        }
        else
        {
            $msg= "Identifiants erronés";
        }
    }
    else if($login=="666")
    {
        $_SESSION['id']="666";
        $serveur = array(
        "667" => "12345",
        "666" => "6789",
        );

        $connexion = false;
        for ($i = 0; $i < count($serveur); $i++) {
            if ($serveur[$login] == $mdp){
            $connexion = true;
            break;}
        }

        if ($connexion) {
            if (isset($_POST['button'])) {
                echo "login successfull !";
                header("Location: homeAdmin.php?id=".$_SESSION['id']);
            }
        }
        else
        {
            $msg= "Identifiants erronés";
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Page de connexion Admin</title>
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
        
        <center><h1>Connexion Administrateur</h1>
        <img src="LogoEE.png" alt="Logo Ebay ECE" title="Vous aimez notre Logo ?<br/> Cliquez pour le voir en grand !" width="200px" height="200px">
        <div id=connexion>
        <table>
        <tr>
        <td><label><b>Nom d'utilisateur</b></label></td>
        </tr>
        <tr>
        <td><input type="text" name="LoginA" placeholder=" Entrez votre Login" required></td><br/>
        </tr>
        <tr>
        <td><label><b>Mot de passe</b></label></td>
        </tr>
        <tr>
        <td><input type="password" name="mdpA" placeholder=" mot de passe" required></td><br/>
        </tr>
        <!--<tr>
        <td> &nbsp; </td>
        </tr>-->
        <tr>
        <td colspan="2" align="center"><input type="submit" name="button" value="Valider"></td><br/>
        </tr>
        </table>
        </div>
        </center>

    </form>
    
    <?php
    if(isset($msg))
    {
        echo '<br/><font color="red">'.$msg.'</font>';
    }?>

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
