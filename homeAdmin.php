<?php
session_start();
if (isset($_SESSION['id']))      // SI L'ADMIN EST CONNECTE
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ebay ECE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="home.css">
</head>
    
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" id="Logo" href="home.html"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li><a class="B" href="itemadmin.php">Items</a></li>
            <li><a class="B" href="AdminItem.php">Mes items</a></li>
            <li><a class="B" href="AdminVendeurs.html">Vendeurs</a></li>
      </ul>
            
        <ul class="nav navbar-nav navbar-right">
            <li><a href="Deco.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter </a></li>
        </ul>
        </div>
    </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
        <img src="fond%20d'ecran.jpg" alt="dali" height="600" width="1200" sizes="1200">
            <div class="carousel-caption">
            <h3>EBAY ECE</h3>
            <p>pour trouver votre bonheur</p>
            </div>      
        </div>

        <div class="item">
        <img src="banksy.jpg" alt="monroe" height="600" width="1200">
            <div class="carousel-caption">
            <h3>Digne d'un musée</h3>
            <p>L'art accessible pour tous</p>
            </div>      
        </div>
        
        <div class="item">
        <img src="vip.jpg" alt="" height="600" width="1200">
            <div class="carousel-caption">
            <h3>Des accessoires hors-norme</h3>
            <p> VIP only </p>
            </div>      
        </div>
        
        <div class="item">
        <img src="feraille.jpg" alt="" height="600" width="1200">
            <div class="carousel-caption">
            <h3>De la feraille digne de ce nom</h3>
            <p>Un trésor, peut-être ?</p>
            </div>      
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
    <h3>Que fait-on ?</h3><br>
    <div class="row">
        <div class="col-sm-4">
        <img src="Capture.png" class="img-responsive" style="width:100%" alt="vente exemple">
        <br/>
        <hr/>
        <p>Ebay ECE: La vente aux enchères en ligne  pour la communauté ECE Paris </p>
        </div>
        <div class="col-sm-4"> 
        <img src="relation.jpg" height="183px" alt="Image">
        <br/>
        <hr/>
        <p>Nous mettons en relation Acheteur et Vendeurs pour reunir les meilleures offres</p>    
        </div>
        <div class="col-sm-4">
        <div class="well">
        <p>" On peut réduire une oeuvre d'art à son seul prix, mais cela ne représentera jamais sa valeur réelle". Citation d'Isabelle Jarry</p>
        </div>
        <div class="well">
        <p>"L’art, c’est la création propre à l’homme. L’art est le produit nécessaire et fatal limitée, comme la nature est le produit nécessaire et fatal d’une intelligence finie. L’art est à l’homme ce que la nature est à Dieu". Citations de Victor Hugo </p>
        </div>
        </div>
    </div>
</div><br>

<footer class="page-footer">
<div class="container">
    <div class="col-lg-5 col-md-5 col-sm-12">
    <h5 class="text-uppercase font-weight-bold">Qui sommes-nous?</h5><br/>
    <p>On est une société indépendante. <br/> Ce qu'on te propose c'est de trouver des articles inédits le plus simplement possible, et au meilleur prix. <br/> Tu peux aussi te faire de l'argent en vendant tes propres objets</p>
    <p>Bon, du coup on te laisse, Enjoy !</p>
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
    <img src="PETIT_LogoEBAYECE.png" alt="Notre logo !"/>
</div>
</footer>
</body>
</html>
<?php
}
else
{
    header('Location:home.html');
}
?>
