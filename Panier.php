<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');  
if(isset($_SESSION['id']))
{
    $rechercheitem = $bdd->prepare('SELECT * FROM item WHERE id = ? ');      // ON PREND SES INFOS
    $rechercheitem->execute(array($_GET['idI']));         
    $infoitem = $rechercheitem->fetch();  
    
    $mysqli = new mysqli("localhost","root","","piscine");
    mysqli_set_charset($mysqli, "utf8");
    if ($mysqli -> connect_errno) 
    {
        $erreur= "Failed to connect to MySQL: " . $mysqli -> connect_error;
    }
                        //ERREUR DE CONNEXION 
    else   //SI AUCUNE ERREUR
    {
        $recherchepanier = $bdd->prepare('SELECT * FROM panier WHERE id = ? ');      // ON PREND SES INFOS
        $recherchepanier->execute(array($_GET['idI']));         
        $infopanier = $recherchepanier->rowCount();
         if($infopanier==1)
         {
            
                        $query = "INSERT INTO `panier`(`idC`, `idI`,`categorie`,`achat`,`prix`,`description`,`photo`,`nom`) VALUES ('". $_SESSION['id'] ."', '". $infoitem['id'] ."','". $infoitem['categorie'] ."', '". $infoitem['achat'] ."','". $infoitem['prix'] ."', '". $infoitem['description'] ."','". $infoitem['photo'] ."','". $infoitem['nom']."');";

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
         else
         {
             $erreur="Cet item est déjà dans le panier";
         }
    }

    
    $recherche = $bdd->prepare('SELECT * FROM client WHERE id = ? ');      // ON PREND SES INFOS
    $recherche->execute(array($_SESSION['id']));         
    $infoclient = $recherche->fetch();                                     // ON PREND SES INFOS
    
    $items = $bdd->prepare('SELECT * FROM panier WHERE idC= ?');
    $items->execute(array($_SESSION['id'])); 
    
    $total = $bdd->prepare('SELECT SUM(Prix) AS Somme FROM panier WHERE idC = ?');
    $total->execute(array($_SESSION['id']));
    $afficher = $total->fetch();
    

?>
<!DOCTYPE html>
<html>
<head>
	<title>Panier</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>   
        
    /*-- BARRE DE NAVIGATION --*/   
    /* Remove the navbar's default margin-bottom and rounded borders */ 
        
    #item
    {
        border: 2px;
        border-color: darkgrey;
        border-radius: 10px 10px;
    }
    .navbar 
    {
      margin-bottom: 0px;
      border-radius: 0;
    }
    .navbar-brand
    {   background-image: url(PETIT_LogoEEBlanc.png);
        align-items: center;
    }
        
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
        
   <?php
    if(!empty($infovendeur['fond']))    // SI IL Y A UN FOND ON LE MET EN IMAGE DE FOND
    {
    ?>
    .bg-1 
    { 
        background-image: url(vendeur/fonds/<?php echo $infovendeur['fond'];?>);
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
        background-image: url(vendeur/fonds/fond.jpg);
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
    #item
    {
        padding-top:100px; 
        background-color: gainsboro;
    }
</style>


 
  
  <script type="text/javascript">  
  	function totalimmediat() {   
  		num1 = document.getElementById("prix1").value;
     	//num2 = document.getElementById("prix2").value;
     	qt1  = document.getElementById("QTT1").value;
     	//qt2  = document.getElementById("QTT2").value;          
     	document.getElementById("total-immediat").innerHTML = Number(num1)*Number(qt1); //+ Number(num2)*Number(qt2);  
     }
     function totalenchere() {   
  		num2 = document.getElementById("prix2").value;
     	//num2 = document.getElementById("prix2").value;
     	qt2  = document.getElementById("QTT2").value;
     	//qt2  = document.getElementById("QTT2").value;          
     	document.getElementById("total-enchere").innerHTML = Number(num1)*Number(qt1); //+ Number(num2)*Number(qt2);  
     }
     function totalmoffre() {   
  		num3 = document.getElementById("prix3").value;
     	//num2 = document.getElementById("prix2").value;
     	qt3  = document.getElementById("QTT3").value;
     	//qt2  = document.getElementById("QTT2").value;          
     	document.getElementById("total-moffre").innerHTML = Number(num1)*Number(qt1); //+ Number(num2)*Number(qt2);  
     }
  </script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" id="Logo" href="home.html"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav"> 
        <li>
        <?php
            if(isset($_SESSION['id']))
            {
        ?>
                <a class="B" href="Client2.php">Votre Compte</a>
         <?php
            }
            else
            {
        ?>
                <a class="B" href="LogClient.php">Votre Compte</a>
        <?php
            }
        ?>
            
        </li>
      </ul>
            
        <ul class="nav navbar-nav navbar-right">
            <li><a href="LogAdmin.php"><span class="glyphicon glyphicon-log-in"></span> Login Administrateur</a></li>
        </ul>
        </div>
    </div>
</nav>

    <div id="item">
<div class="container-fluid bg-1 text-center" >
    <center>
    <h1> Votre panier </h1>
    </center>
</div>
    
    
    
<?php
    
        while($item = $items->fetch())
        {
        ?>
<div class="container">
	<div class="row">
		<div class="col-sm-2"><b>Article</b></div>
        <div class="col-sm-3"><b>Descritpion</b></div>
		<div class="col-sm-1"><b>Prix</b></div>
        <div class="col-sm-2"><b>Categorie</b></div>
        <div class="col-sm-2"><b>Achat</b></div>
		<div class="col-sm-2" align="center"><b>Supprimer</b></div>
	</div>
    
	<div class="row">

		<div class="col-sm-2">
            <?php
            if(!empty($item['photo']))
            {
            ?>
                <img src="articles/<?php echo $item['photo'];"" ?>" width="100%">
            <?php
            }
            else
            {
            ?>
                <p>aucune image pour cet article</p>
            <?php
            }
            ?>
            
        
        </div>
		<div class="col-sm-3"><p id="descritption"><?= $item['nom'] ?><p id="descritption"><?= $item['description'] ?></p></div>
		<div class="col-sm-1"><?= $item['prix'] ?> €</div>
        <div class="col-sm-2"><?= $item['categorie']?></div>
        <div class="col-sm-2"><?= $item['achat']?></div>
		<div class="col-sm-2" align="center"><p ><?php echo '<a href="supprimerPanier?idI='.$item['id'].'.php"><span class="glyphicon glyphicon-trash" id="trash"></span></a>';?>
        </p></div>

    </div>
	
</div>
        <?php
        }

        if(!empty($afficher['Somme']))
        {
        ?>

        <div class="row">   
        <div align="center">
         <h2>
                    Prix total : <b>
                    <?php echo $afficher['Somme']; ?> €</b></h2>    
            
       <form action="paiment.php" method="post">
           <input type="button" name="button" id="MonBouton" value="Procéder au Paiement">
        </form>
        </div>
    
        <?php
        }
        ?>
<br/>
<br/>
    </div>    
 </div>   

<footer class="page-footer">
<div class="container">
    <div class="row">
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
    <img src="PETIT_LogoEBAYECE.png" alt="Notre logo !"/></div>
</div>
</footer>
</body>
</html>

<?php
}
?>