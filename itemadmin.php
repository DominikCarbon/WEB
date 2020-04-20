<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');
$pdoStat = $bdd->prepare("SELECT * FROM item ");
$executeIsOk = $pdoStat->execute();
$items = $pdoStat->fetchAll();
    if(isset($_SESSION['id']))
    {
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Items</title>
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
            <?php echo'<li><a class="B" href="itemadmin.php">Gérer items</a></li>';?>
            <?php echo'<li><a class="B" href="AdminVendeur.php">Vendeurs</a></li>';?>
            <?php echo'<li><a class="B" href="AdminItem.php">Mes items</a></li>';?>
            
      </ul>
            
        <ul class="nav navbar-nav navbar-right">
            <li><a href="Deco.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter </a></li>
        </ul>
        </div>
    </div>
</nav>

   
    
    <div class="jumbotron" >
  <div class="container text-center" >
    <h1 >Ebay ECE</h1>      
    <p>Vente & Enchere d'objets de qualité</p>
  </div>
</div>


<div id="items">
    <div class="container">  
        <center><h1>Gérer les items</h1><input type="text" placeholder="rechercher un item.." name="search"/>&nbsp;<span class="glyphicon glyphicon-search"></span></center>
            <div class="row">
            <br/>

                <?php  foreach ($items as $item):?>
                <br/>
                <div class="container" id="item">
                    <div class="row" id="rang1">
                        <div class="col-sm-3" align="center"><b>Article</b></div>
                        <div class="col-sm-4" ><b>Descritpion</b></div>
                        <div class="col-sm-1"><b>Prix</b></div>
                        <div class="col-sm-2"><b>Achat</b></div>
                        <div class="col-sm-2" align="center"><b>Supprimer</b></div>
                    </div>

                    <div class="row" id="rang1">
                        <div class="col-sm-3"><img src="articles/<?php echo $item['photo'];"" ?>" width="100%"></div>
                        <div class="col-sm-4"><p id="descritption"><?= $item['nom'] ?></p><p id="descritption"><?= $item['description'] ?></p></div>
                        <div class="col-sm-1"><?= $item['prix'] ?> €</div>
                        <div class="col-sm-2"><?= $item['achat']?></div>
                        <div class="col-sm-2" align="center">      
                            <?php echo '<a href="supprimer.php?id='.$_SESSION['id'].'&idI='.$item['id'].'"><span class="glyphicon glyphicon-trash" id="trash"></span></a>';?>
                        </div>
                    </div>
                </div>
   <?php endforeach ?>     
            </div>

        <div class="row">
            <br>
            <br>
            <div class="container" align="center">
              <ul class="pagination">
              <li class="active"><a href="#">1</a></li>
              <li ><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              </ul>
              <br/>
            </div>
        </div>
    </div>
</div>

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
<?php
    }
else
{
    header('Location:home.php');
}
?>