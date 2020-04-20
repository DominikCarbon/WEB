<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');

if(isset($_SESSION['id']))  //ON VALIDE TOUTES SES INFOS
{
        $recherche = $bdd->prepare('SELECT * FROM client WHERE id = ? ');
    $recherche->execute(array($_SESSION['id']));
    $infoclient = $recherche->fetch();
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
<style>
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
        line-height: 1.8;
        color: #f5f6f7;
    }
    p
    {
        /*font-size: 16px;*/
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
            
    .MonBouton
    {
        color:black; 
        border-radius: 15px 15px 15px 15px;
    }
            
    #profil
    {
        border: 1px solid black;
        width:300px;
        padding-left:0px;
        border-radius: 5px 5px 5px 5px;
        background-color: darkgrey;
        text-align: center;
    }
    </style>
	
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
    
    <div class="container-fluid bg-1 text-center">
   <?php
    if(!empty($infoclient['photo']))  // Si photo profil et fond
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
    <h2>Paiement de <?php echo $infoclient['prenom']; ?> </h2>
</div>

<?php

         
 $recherche = $bdd->prepare('SELECT COUNT(*) FROM code WHERE idC=:idClient');      // ON PREND SES INFOS
        $recherche->execute(array('idClient'=>$_SESSION['id']));         
         if($recherche->fetchColumn()==0)
         { ?>  
            
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
         }
         else
         {
             $erreur ='Votre carte est déjà enregistrée';
?>          
        </center>
</div>
<?php
         }	
 if(isset($erreur))
            {
                echo '<center><br/><font color="grey">'.$erreur.'</font><br/>
                <input type="submit" name="button" class="MonBouton" value="Confirmer la commande"></center>';
            }
        ?>

<br/><br/>

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
}
?>