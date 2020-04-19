<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');

if(isset($_SESSION['id']))
{
$pdoStat = $bdd->prepare("SELECT * FROM item WHERE achat= 'Enchere'");

$executeIsOk = $pdoStat->execute();

$items = $pdoStat->fetchAll();
    if(isset($_POST['bouton']))
    {
            $mysqli = new mysqli("localhost","root","","piscine");
    mysqli_set_charset($mysqli, "utf8");
    if ($mysqli -> connect_errno) 
    {
        $erreur= "Failed to connect to MySQL: " . $mysqli -> connect_error;
    }
                        //ERREUR DE CONNEXION 
    else   //SI AUCUNE ERREUR
    {
            $query = "INSERT INTO `panier`(`idC`, `idI`,`categorie`,`achat`,`prix`,`description`,`photo`,`nom`) VALUES ('". $_SESSION['id'] ."', '". $_SESSION['iditem'] ."','". $_SESSION['categorie'] ."', '". $_SESSION['achat'] ."','". $_SESSION['prix'] ."', '". $_SESSION['description'] ."','". $_SESSION['photoitem'] ."','". $_SESSION['nom']."');";

                if ($mysqli->query($query) === TRUE)
                {   
                    $erreur="c'est good";
                }//end if 
                else 
                {
                    $erreur= "Error: " . $query . "<br>";
                }
                $mysqli -> close();
    }
    }

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
            <?php echo '<a class="navbar-brand" id="Logo" href="home.php"></a>'; ?>
            
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catégorie<span class="icon-bar"></span></a>
            <ul class="dropdown-menu">
                <li id="F"><?php echo '<a href="feraille_ou_tresor.php" id="Fer"><strong>Feraille ou Trésor</strong></a>';?></li>
                <li id="M"><?php echo '<a href="Bon_pour-le-musee.php" id="Mus"><strong>Bon pour le Musée</strong></a>';?>
                </li>
                <li id="V"><?php echo '<a href="Accessoire_VIP.php" id="Vip"><strong>Accessoire VIP</strong></a>';?></li>
            </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Achat<span class="icon-bar"></span></a>
            <ul class="dropdown-menu">
              <li><?php echo '<a href="enchere.php">Encheres</a>';?></li>
                <li><?php echo '<a href="achatimmediat.php">Achetez-le Maintenant</a>';?></li>
                <li><?php echo '<a href="meilleureoffre.php">Meilleure offre</a>';?></li> 
            </ul>
            </li>
            <li><a class="B" href="LogVendeur.php">Vendre</a></li>
            <li><?php
                if(isset($_SESSION['id']))
                {
                    echo '<a class="B" href="Client2.php">Votre Compte</a>';
                }
                else
                {
                    echo '<a class="B" href="LogClient.php">Votre compte</a>';
                }
            ?></li>
            
            
      </ul>
            
        <ul class="nav navbar-nav navbar-right">
            <li><a href="LogAdmin.php"><span class="glyphicon glyphicon-user"></span> Login Administrateur</a></li>
            <li><?php
                if(isset($_SESSION['id']))
                {
                    echo '<a class="B" href="panier.php"><span class="glyphicon glyphicon-shopping-cart"></span>   Panier</a>';
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
    
    <div class="jumbotron" >
  <div class="container text-center" >
    <h1 >Trouvez votre bonheur</h1>      
    <p>Vente & Enchere d'objets de qualité</p>
  </div>
</div>


<div id="items">
<div class="container">  
    <center><h1>Feraille ou trésor</h1><input type="text" placeholder="rechercher un item.." name="search"/>&nbsp;<span class="glyphicon glyphicon-search"></span></center>

    
    
    <div class="row">
        <br/>

       <?php  foreach ($items as $item):?>

<div class="container" id="item">
    
	<div class="row" id="rang1">
		<div class="col-sm-3" align="center"><b>Article</b></div>
        <div class="col-sm-4" ><b>Descritpion</b></div>
		<div class="col-sm-1"><b>Prix</b></div>
        <div class="col-sm-2"><b>Achat</b></div>
		<div class="col-sm-2" align="center"><b>Panier</b></div>
	</div>
    
	<div class="row" id="rang1">
		<div class="col-sm-3"><img src="articles/<?php echo $item['photo'];"" ?>" width="100%"></div>
		<div class="col-sm-4"><p id="descritption"><?= $item['nom'] ?></p><p id="descritption"><?= $item['description'] ?></p></div>
		<div class="col-sm-1"><?= $item['prix'] ?> €</div>
        <div class="col-sm-2"><?= $item['achat']?></div>
        <div class="col-sm-2" align="center"><p ><span class="glyphicon glyphicon-shopping-cart"></span>
        </p></div>
    </div>
	
</div>
</div>
<?php endforeach ?>
      
</div>
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
  
</div>
<br>
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
