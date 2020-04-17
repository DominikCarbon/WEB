<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');

$pdoStat = $bdd->prepare("SELECT * FROM item WHERE achat= 'achatimmediat'");

$executeIsOk = $pdoStat->execute();

$items = $pdoStat->fetchAll();


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
                <li><a href="achat.html">Encheres</a></li>
                <li><a href="achat.html">Achetez-le Maintenant</a></li>
                <li><a href="achat.html">Meilleure offre</a></li> 
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
    <center><h1>Achat Immédiat</h1><input type="text" placeholder="rechercher un item.." name="search"/>&nbsp;<span class="glyphicon glyphicon-search"></span></center>
  <div class="row">
   

        <br/>

      <?php  foreach ($items as $item):?>
     
      <div class="panel panel-danger">
        <div class="panel-heading"><?= $item['categorie'] ?></div>
        <div class="panel-body"><img src="article/photo/<?php echo $items['photo'];?>" class="img-responsive img-circle" style="display:inline" alt="article" width="100" height="100">
    <?php</div>
        <div class="panel-footer" style="height: 100px;">&nbsp;&nbsp;<b>Description</b> :<br/><?= $item['description'] ?><br/>&nbsp;&nbsp;<b>Prix</b> :<br/> <?= $item['prix'] ?> €
        <br/>&nbsp;&nbsp;<b>Etat</b> :<br/>Neuf<h1 align="right"><a href="panier.html"><span class="glyphicon glyphicon-shopping-cart"></span></a></h1></div>
      </div>
  	  <?php endforeach ?>
     
</div>
</div>


<br/>
<div class="container" align="center">
  <ul class="pagination">
  <li class="active"><a href="#">1</a></li>
  <li ><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  </ul>
  
</div>

<!-- Footer -->
<footer class="page-footer">
<div class="container">
    <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
    <h5 class="text-uppercase font-weight-bold">Qui sommes-nous?</h5><br/>
    <p>Les meilleurs, déjà. En plus on t'aide à te faire des thunes<br/>Ouais tu peux nous remercier ouais <br/>maintenant khalass</p>
    <p>Tié la famille</p>
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
