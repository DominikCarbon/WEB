<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');  // J'UTILISE UN PDO CAR JE N4AI PAS  REUSSI AVEC MYSQLI

if (isset($_SESSION['id']))      // SI L'USER EST CONNECTE
{
    $recherche = $bdd->prepare('SELECT * FROM vendeur WHERE id =? ');      // ON PREND SES INFOS
    $recherche->execute(array($_GET['id']));         
    $infovendeur = $recherche->fetch();  
    
    $pdoStat = $bdd->prepare("DELETE FROM item WHERE idV=".$_SESSION['id']." LIMIT 1");

    //$pdoStat=binvalue($_GET['id']),PDO::PARAM_INT);

    $deleteIsOk= $pdoStat->execute();

    if ($deleteIsOk) {
        $message="L'item est bien suprimé.";
    }
    else
        {$message="echec de la suppresion de l'item";}


?>


 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Achat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="achat.css">
<style type="text/css">
  <style type="text/css">
   #MonBouton
    {
        color:black; 
        border-radius: 15px 15px 15px 15px;
        padding:4px;
    }
        
    #MonBouton:hover
    {
        color:whitesmoke; 
        border-radius: 15px 15px 15px 15px;
        padding:4px;
        background-color: darkgray;
    }
</style>
</style>
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" id="Logo" href="home.html"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="categorie.html">Catégorie<span class="icon-bar"></span></a>
            <ul class="dropdown-menu">
                <li id="F"><a href="categorie.html" id="Fer"><strong>Feraille ou Trésor</strong></a></li>
                <li id="M"><a href="categorie.html" id="Mus"><strong>Bon pour le Musée</strong></a></li>
                <li id="V"><a href="categorie.html" id="Vip"><strong>Accessoire VIP</strong></a></li> 
            </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="achat.html">Achat<span class="icon-bar"></span></a>
            <ul class="dropdown-menu">
                <li><a href="enchere.php">Encheres</a></li>
                <li><a href="achatimmediat.php">Achetez-le Maintenant</a></li>
                <li><a href="meilleureoffre.php">Meilleure offre</a></li> 
            </ul>
            </li>
            <li><a class="B" href="LogVendeur.html">Vendre</a></li>
            <li><a class="B" href="LogClient.html">Votre Compte</a></li>
      </ul>
            
        <ul class="nav navbar-nav navbar-right">
            <li><a href="LogAdmin.html"><span class="glyphicon glyphicon-user"></span> Login Administrateur</a></li>
            <li><a href="panier.html"><span class="glyphicon glyphicon-shopping-cart"></span> Panier</a></li>
        </ul>
        </div>
    </div>
</nav>
    
    <div class="jumbotron" >
  <div class="container text-center" >
    <h1 >Trouvez votre bonheur</h1>      
    <p>Vente & Enchere d'objets de qualité</p>
  </div>
</div>


<div class="container">  
    <center><h1>Confirmation de Suppression</h1></center>

   

        
        <div align="center">
        <?php echo '<a href="itemadmin.php?id='.$_SESSION['id'].'"><input type="button" name="button" id="MonBouton" value="Retour"></a>'; ?>
        </div>

      
</div>

<br>
<br><br>






<!-- Footer -->
<footer class="page-footer">
<div class="container">
    <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <h5 class="text-uppercase font-weight-bold">Qui sommes-nous?</h5><br/>
        <p>On est une société indépendante. <br/> Ce qu'on te propose c'est de trouver des articles inédits le plus simplement possible, et au meilleur prix. <br/> Tu peux aussi te faire de l'argent en vendant tes propres objets</p>
        <p>Bon, du coup on te laisse, Enjoy !</p>
        </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <center>
    <h5 class="text-uppercase font-weight-bold">Suivez-nous sur les réseaux !</h5><br/>
    <p>&nbsp; &nbsp;<img src="insta.png" alt="" title="C'est notre instagram !" width="50px" height="50px">&nbsp; &nbsp;<img src="fb.png" alt="" title=" C'est notre Facebook !" width="50px" height="50px">&nbsp; &nbsp;<img src="twitter.png" alt="" title=" C'est notre Twitter !" width="48px" height="48px"></p>
            </center>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-12">
    <center>
    <h5 class="text-uppercase font-weight-bold">Conçu par</h5><br/>
    <p>Dominik Carbon & Wachani Mehdi<br>
     Contact :<a href="mailto:dominik.carbon@edu.ece.fr"> dominik.carbon@edu.ece.fr</a><br>
     Contact :<a href="mailto:mehdi.wachani@edu.ece.fr"> mehdi.wachani@edu.ece.fr</a><br>
     +33 6 47 28 02 76
    </p>
    </center>
    </div>
    </div>
    <div class="footer-copyright text-center">&copy; 2020 Copyright | Droit d'auteur: Ebay ECE<br/>
    <img src="PETIT_LogoEBAYECE.png" alt="Notre logo !"/></div>
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