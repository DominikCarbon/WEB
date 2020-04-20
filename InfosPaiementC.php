<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');  // J'UTILISE UN PDO CAR JE N4AI PAS  REUSSI AVEC MYSQLI

if (isset($_SESSION['id']))      // SI L'USER EST CONNECTE
{
    $recherche = $bdd->prepare('SELECT * FROM client WHERE id = ? ');      // ON PREND SES INFOS
    $recherche->execute(array($_GET['id']));         
    $infoclient = $recherche->fetch();                                     // ON PREND SES INFOS
    
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
            $num = htmlspecialchars($_POST['num']);
            $nom = htmlspecialchars($_POST['nom']);
            $carte = htmlspecialchars($_POST['carte']);
            $ccv=htmlspecialchars($_POST['ccv']);

            $queryp = "INSERT INTO `code`(`idC`, `nom`, `numero`, `ccv`, `type`) VALUES ('". $_SESSION['id'] ."', '". $nom ."', '". $num ."','". $ccv ."', '". $carte ."');";

                if ($mysqli->query($queryp) === TRUE)
                {   
                    header('Location:Client2.php');
                }//end if 
                else 
                {
                    $erreur= "Error: " . $queryp . "<br>";
                }
                $mysqli -> close();

        }
    }
?>


<html>
<head>
    <title>Client</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!--<link rel="stylesheet" type="text/css" href="Client2.css">-->     // J'ai enlevé le .css pour pouvoir gérer l'image de fond ici
    
    
    <style>   
        
    /*-- BARRE DE NAVIGATION --*/   
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar 
    {
      margin-bottom: 0px;
      border-radius: 0;
    }
    .navbar-brand
    {   background-image: url(PETIT_LogoEEBlanc.png);
        align-items: center;
    }

    .page-footer 
    {
         background-color: #222;
         color: #ccc;
         padding: 30px 0 10px;
    }
    .footer-copyright 
    {
         color: #666;
         padding: 40px 0;
    }

    body 
    {
        font: 20px Montserrat, sans-serif;
        line-height: 1.8;
        color: #f5f6f7;
    }
    p
    {
        font-size: 16px;
    }
      
    .margin 
    {
        margin-bottom: 45px;
    }
        
    <?php
    if(!empty($infoclient['fond']))    // SI IL Y A UN FOND ON LE MET EN IMAGE DE FOND
    {
    ?>
    .bg-1 
    { 
        background-image: url(client/fonds/<?php echo $infoclient['fond'];?>);
        background-size: cover;
        color: #ffffff;
        padding-bottom: 20px;
        padding-top:200px;
    }
        
    <?php 
    }
    else                // SI AUCUN FOND ON MET LE FOND DE BASE
    {
    ?>      
    .bg-1
    { 
        background-color: cadetblue; /* Green */
        background-image: url(client/fonds/fond.jpg);
        background-size: cover;
        color: #ffffff;
        padding-bottom: 20px;
        padding-top:100px;
    }   
    <?php
    }
    ?>
    
    .bg-2 
    { 
        background-color: #474e5d; /* Dark Blue */
        color: #ffffff;
        padding-bottom: 30px;  
    }

    #Logo
    {
        margin-right:10px;
        margin-left:10px;
        width:42px;
        height:53px;
        }

    #fond
    {
        color:black;
    }
        
    input{
        border-radius: 7px 7px;
        color:dimgrey;
    }    
        
        .MonBouton
    {
        color:black; 
        border-radius: 15px 15px 15px 15px;
    }
        
    input[type=number] {
        width: 100px;
        padding: 2px;
    } 
    input[type=date] {
        width: 160px;
        padding: 2px;
    }   
 
input[type=text] {
  width: 200px;
  padding: 2px;
}    
</style>

</head>
    
<body>

<!-- barre de navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid" id="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" id="Logo" href="home.html"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <?php
            if(isset($_SESSION['id']))
            {
            ?>
                <li><?php echo '<a href="Client2.php">Mon Profil</a>'; ?></li>
            <?php
            }
            else
            {
            ?>
            <li><a class="B" href="Logclient.php">Mon Profil</a></li>
            <?php
            }
            ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
        <?php
        if(isset($_SESSION['id']) AND $infoclient['id']==$_SESSION['id'])
        {
        ?>
            <li><a href="Deco.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
        <?php
        }
        ?>
            <li><a href="LogAdmin.php"><span class="glyphicon glyphicon-user"></span> Login Administrateur</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Mon Panier</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Photo de fond et profil -->
<div class="container-fluid bg-1 text-center">
    <?php
    if(!empty($infoclient['photo']))  // Si photo profil 
    {
    ?>
    <img src="client/photos/<?php echo $infoclient['photo'];?>" class="img-responsive img-circle" style="display:inline" alt="Votre photo de profil !" width="100" height="100">
    <?php
    }
    else{      // SI AUCUNE PHOTO
    ?>
    <img src="Vendeur.png" class="img-responsive img-circle margin" style="display:inline" alt="Votre photo de profil !" width="350" height="350">
    <?php
    }
    ?>
    <h3> <?php echo $infoclient['prenom'] ." ". $infoclient['nom']; ?> </h3>
    <p>Informations de paiement</p>
</div>
    

<!-- Infos et édition profil -->
<div class="container-fluid bg-2 text-center">
    <center>
        <br/>
    <form method="post" action="">
	<table>
		<tr>
			<td colspan="3" align="center">Nom sur la carte:</td>
			<td colspan="3" align="center"><input type="text" name ="nom" placeholder="Nom du porteur"></td>
		</tr>
        <tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="3" align="center">Numéro de carte :</td>
			<td colspan="3" align="center"><input type="text" name ="num" placeholder="Numéro de carte"></td>
		</tr>
        <tr><td>&nbsp;</td></tr>
		<tr>
            <td colspan="3" align="center">&nbsp;CCV : </td>
            <td colspan="3" align="center"><input type="number" name ="ccv" placeholder="CCV"></td>
		</tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan="6" align="center">Type de carte</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan="2" align="left"><input type="radio" name="carte" value="MasterCard" required>&nbsp;<img src="mastercard.png" width="70px" height="40px"></td>
            <td colspan="2" align="center"><input type="radio" name="carte" value="Visa">&nbsp;<img src="visa.png" width="70px" height="70px"></td>
            <td colspan="2" align="right"><input type="radio" name="carte" value="American Express">&nbsp;<img src="americanexpress.png" width="70px" height="40px"></td>
        </tr>
        <tr><td colspan="6"><hr/></td></tr>
        <tr>
        <td colspan="6" align="center"><input type="submit" name="button" class="MonBouton" value="Enregistrez vos données"></td>
        </tr>
	</table>
</form>
        <?php
            if(isset($erreur))
            {
                echo '<br/><font color="red">'.$erreur.'</font>';
            }
        ?>
        </center>
</div>


<!-- Footer -->
<footer class="page-footer">
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
        <h5 class="text-uppercase font-weight-bold">Qui sommes-nous?</h5><br/>
        <p>Les meilleurs, déjà.En plus on t'aide à te faire des thunes<br/>Ouais tu peux nous remercier ouais <br/>maintenant khalass</p>
        <p>Tié la famille</p>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-12">
        <h5 class="text-uppercase font-weight-bold">Suivez-nous sur les réseaux !</h5><br/>
        <p>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="insta.png" alt="" title="C'est notre instagram !" width="50px" height="50px">&nbsp; &nbsp;<img src="fb.png" alt="" title=" C'est notre Facebook !" width="50px" height="50px">&nbsp; &nbsp;<img src="twitter.png" alt="" title=" C'est notre Twitter !" width="48px" height="48px"></p>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-12">
        <h5 class="text-uppercase font-weight-bold">Conçu par</h5><br/>
        <p>
        Dominik Carbon & Wachani Mehdi<br>
        Contact :<a href="mailto:dominik.carbon@edu.ece.fr"> dominik.carbon@edu.ece.fr</a><br>
        Contact :<a href="mailto:mehdi.wachani@edu.ece.fr"> mehdi.wachani@edu.ece.fr</a><br>
        +33 6 47 28 02 76</p>
        </div>
     </div>

    <div class="footer-copyright text-center">&copy; 2020 Copyright | Droit d'auteur: Ebay ECE<br/>
    <img src="PETIT_LogoEBAYECE.png" alt="Notre logo !"/>
    </div>
</div>
</footer>

</body>
    
</html>

<?php //   SI L'USER N'EST PAS CONNECTE
}
else
{
  header('location:home.html');     // REDIRECTION PAGE D'ACCEUIL
}
?>