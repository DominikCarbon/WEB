<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');

if(isset($_POST['button']))  //ON VALIDE TOUTES SES INFOS
{

?>
<!DOCTYPE html>
<html>
<head>
	<title>Paiement</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="paiment.css">
	
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" id="Logo" href="home.php"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégorie<span class="icon-bar"></span></a>
            <ul class="dropdown-menu">
                <li id="F"><a href="feraille_ou_tresor.php" id="Fer"><strong>Feraille ou Trésor</strong></a></li>
                <li id="M"><a href="Bon_pour-le-musee.php" id="Mus"><strong>Bon pour le Musée</strong></a></li>
                
                <?php echo '<li id="V"><a href="Accessoire_VIP.php" id="Vip"><strong>Accessoire VIP</strong></a></li>'; ?>
            </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Achat<span class="icon-bar"></span></a>
            <ul class="dropdown-menu">
                <li><a href="enchere.php">Encheres</a></li>
                <li><a href="achatimmediat.php">Achetez-le Maintenant</a></li>
                <li><a href="meilleureoffre.php">Meilleure offre</a></li> 
            </ul>
            </li>
            <li><a class="B" href="LogVendeur.php">Vendre</a></li>
            <li><a class="B" href="LogClient.php">Votre Compte</a></li>
      </ul>
            
        <ul class="nav navbar-nav navbar-right">
            <li><a href="LogAdmin.php"><span class="glyphicon glyphicon-user"></span> Login Administrateur</a></li>
            <li><a href="Deco.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
            <li><?php
                if(isset($_SESSION['id']))
                {
                     echo '<a class="B" href="panier2.php"><span class="glyphicon glyphicon-shopping-cart"></span>   Panier</a>';
                }
                else
                {
                    echo '<a class="B" href="LogClient.php"><span class="glyphicon glyphicon-shopping-cart"></span>   Panier</a>';
                }
                 ?></li>
        </ul>
        </div>
    </div>
</nav>

<?php

         $recherche = $bdd->prepare("SELECT * FROM code WHERE idC = ?");
         $recherche->execute(array($_SESSION['id']));
         $code = $recherche->rowCount();
         if($code==1)
         {
             $code = $recherche->fetch();
            echo '<p>Votre carte est déjà enregistrée</p>';
                     
         }
         else
         {
?>  
<div class="container-fluid bg-2 text-center">
    <center>
        <h1>Veuillez entrer vos informations bancaires</h1>
        <br/>
    <form method="post" action="Commande.php">
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
        <td colspan="6" align="center"><input type="submit" name="button" class="MonBouton" value="Confirmer la commande"></td>
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
<?php
         }		
		echo "<hr>";
?>


<footer class="page-footer">
<div class="container">
    <div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12">
    <h5 class="text-uppercase font-weight-bold">Qui sommes-nous?</h5><br/>
    <p>Les meilleurs, déjà. En plus on t'aide à te faire des thunes<br/>Ouais tu peux nous remercier ouais <br/>maintenant khalass</p>
    <p>Tié la famille</p>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
    <h5 class="text-uppercase font-weight-bold">Suivez-nous sur les réseaux !</h5><br/>
    <p>&nbsp; &nbsp;<img src="insta.png" alt="" title="C'est notre instagram !" width="50px" height="50px">&nbsp; &nbsp;<img src="fb.png" alt="" title=" C'est notre Facebook !" width="50px" height="50px">&nbsp; &nbsp;<img src="twitter.png" alt="" title=" C'est notre Twitter !" width="48px" height="48px"></p>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-12">
    <h5 class="text-uppercase font-weight-bold">Conçu par</h5><br/>
    <p>Dominik Carbon & Wachani Mehdi<br>
     Contact :<a href="mailto:dominik.carbon@edu.ece.fr"> dominik.carbon@edu.ece.fr</a><br>
     Contact :<a href="mailto:mehdi.wachani@edu.ece.fr"> mehdi.wachani@edu.ece.fr</a><br>
     +33 6 47 28 02 76
    </p>
    </div>
    </div>
    <div class="footer-copyright text-center">&copy; 2020 Copyright | Droit d'auteur: Ebay ECE<br/>
    <img src="PETIT_LogoEBAYECE.png" alt="Notre logo !"/></div>
</div>
</footer>

</body>
</html>

<?php
}
else
{
    echo 'Erreur de connexion';
?>