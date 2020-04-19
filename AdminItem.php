<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');  // J'UTILISE UN PDO CAR JE N4AI PAS  REUSSI AVEC MYSQLI

if (isset($_SESSION['id']))      // SI L'USER EST CONNECTE
{
    $pdoStat = $bdd->prepare("SELECT * FROM item WHERE idV=".$_SESSION['id']."");
    $executeIsOk = $pdoStat->execute();
    $items = $pdoStat->fetchAll();

    
?>


<html>
<head>
    <title>Admin SuperVendeur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!--<link rel="stylesheet" type="text/css" href="vendeur2.css">-->     // J'ai enlevé le .css pour pouvoir gérer l'image de fond ici
    
    
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
    
    /* UN PEU PLUS DESPACE */    
    .container
        {margin-top:50px;}

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
        color: black;
    }
    p
    {
        font-size: 16px;
    }
      
    .margin 
    {
        margin-bottom: 45px;
    }
        
     
    .bg-1
    { 
        background-color: cadetblue; /* Green */
        background-image: url(vendeur/fonds/fond.jpg);
        background-size: cover;
        color: #ffffff;
        padding-bottom: 20px;
        padding-top:100px;
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
        border-radius: 7px 7px 7px 7px;
        color:dimgrey;
    }    
        
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
        
        textarea {
        padding: 2px;
            border-radius:10px 10px;
    }   
 
    input[type=text] {
        width: 200px;
        padding: 2px;
    } 
    #Ajout
        {
            padding-top: 100px;
            background-color: gainsboro;
        }
            #item
    {
        border: 2px;
        border-color: darkgrey;
        border-radius: 10px 10px;
    }
    
</style>

</head>
    
<body>

<!-- barre de navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid" id="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" id="Logo" href="homeAdmin.php"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><?php echo '<a href="AdminVendeur.php?id='.$_SESSION['id'].'">Gérer les vendeurs</a>'; ?></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="Deco.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Photo de fond et profil -->

<div class="container-fluid bg-1 text-center" >
    <center>
    <h1> Items mis à la vente </h1>
    <h3> <?php echo $_SESSION['id'];?> </h3>
    </center>
</div>

    

<!-- Infos sur les items en vente -->
 <?php  foreach ($items as $item):?>
<div class="container" id="item">
	<div class="row">
		<div class="col-sm-2"><b>Article</b></div>
        <div class="col-sm-3"><b>Descritpion</b></div>
		<div class="col-sm-1"><b>Prix</b></div>
        <div class="col-sm-2"><b>Categorie</b></div>
        <div class="col-sm-2"><b>Achat</b></div>
		<div class="col-sm-2" align="center"><b>Supprimer</b></div>
	</div>
    
	<div class="row">

		<div class="col-sm-2"><img src="articles/<?php echo $item['photo'];"" ?>" width="100%"></div>
		<div class="col-sm-3"><p id="descritption"><?= $item['nom'] ?><p id="descritption"><?= $item['description'] ?></p></div>
		<div class="col-sm-1"><?= $item['prix'] ?> €</div>
        <div class="col-sm-2"><?= $item['categorie']?></div>
        <div class="col-sm-2"><?= $item['achat']?></div>
		<div class="col-sm-2" align="center"><p ><?php echo '<a href="supprimerV.php?id='.$_SESSION['id'].'"><span class="glyphicon glyphicon-trash" id="trash"></span></a>';?>
        </p></div>

    </div>
	
</div>
<?php endforeach ?>


<div class="row"  id="Ajout">   
        <div align="center">
        <?php echo '<a href="AdminNvItemAjoute.php?id='.$_SESSION['id'].'"><input type="button" name="button" id="MonBouton" value="Ajouter un Item"></a>'; ?>
        </div>
    
<br/>
<br/>
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
        <p>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="insta.png" alt="" title="C'est notre instagram !" width="50px" height="50px">&nbsp; &nbsp;<img src="fb.png" alt="" title=" C'est notre Facebook !" width="50px" height="50px">&nbsp; &nbsp;<img src="twitter.png" alt="" title=" C'est notre Twitter !" width="48px" height="48px"></p>
                </center>
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