<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');
if (isset($_SESSION['id']))
{
    $recherche = $bdd->prepare('SELECT * FROM vendeur WHERE id = ? ');
    $recherche->execute(array($_SESSION['id']));
    $infovendeur = $recherche->fetch();


    if(isset($_FILES['photo']))    // SI ON APPUIE SUR MODIFIER LA PHOTO
    {
      $extension = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));  // ON MET L4EXTENSION AU FORMAT
      $chemin= "vendeur/photos/".$_SESSION['id'].".".$extension;   // CHEMIN POUR LA PHOTO APPELEE "ID.EXTENSION"
      $deplacement=move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);   //  ON DEPLACE LA PHOTO DANS LE DOSSIER
      if($deplacement)    // SI LE DEPLACEMENT FONCTIONNE
      {
          $updatephoto=$bdd->prepare('UPDATE vendeur SET photo =:photo WHERE id =:id');   // REQUETE EN SQL POUR INSERER LA PHOTO
          $updatephoto->execute(array('photo' => $_SESSION['id'].".".$extension, 'id' => $_SESSION['id'] ));

          header('Location:Vendeur.php?id='.$_SESSION['id']);
      }
      else
      {
        $erreur="erreur déplacement d'image";
      }
    }
    if(isset($_FILES['fond']))    // SI ON APPUIE SUR MODIFIER LA PHOTO
    {
      $extension = strtolower(substr(strrchr($_FILES['fond']['name'], '.'), 1));  // ON MET L4EXTENSION AU FORMAT
      $chemin= "vendeur/fonds/".$_SESSION['id'].".".$extension;   // CHEMIN POUR LA PHOTO APPELEE "ID.EXTENSION"
      $deplacement=move_uploaded_file($_FILES['fond']['tmp_name'], $chemin);   //  ON DEPLACE LA PHOTO DANS LE DOSSIER
      if($deplacement)    // SI LE DEPLACEMENT FONCTIONNE
      {
          $updatephoto=$bdd->prepare('UPDATE vendeur SET fond =:fond WHERE id =:id');   // REQUETE EN SQL POUR INSERER LA PHOTO
          $updatephoto->execute(array('fond' => $_SESSION['id'].".".$extension, 'id' => $_SESSION['id'] ));
          
          header('Location:Vendeur.php?id='.$_SESSION['id'] );
      }
      else
      {
        $erreur="erreur déplacement d'image";
      }
    }
?>
<html>
<head>
  <title>Vendeur</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!--<link rel="stylesheet" type="text/css" href="Vendeur.css">-->
    
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

<!-- Navbar -->
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
            <li><?php echo '<a href="Vendeur.php?id='.$_SESSION['id'].'">Mon Profil</a>'; ?></li>
            <?php
            }
            else
            {
            ?>
            <li><a class="B" href="Logvendeur.html">Mon Profil</a></li>
            <?php
            }
            ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php
    if(isset($_SESSION['id']) AND $infovendeur['id']==$_SESSION['id'])
    {
    ?>
    <li><a href="Deco.php"><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
    <?php
    }
        ?>
        <li><a href="LogAdmin.html"><span class="glyphicon glyphicon-log-in"></span> Login Administrateur</a></li>
        <li><a href="#"> Mes items en vente </a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- First Container -->
<div class="container-fluid bg-1 text-center">
 <?php
    if(!empty($infovendeur['photo']))  // Si photo profil et fond
    {
    ?>
    <img src="vendeur/photos/<?php echo $infovendeur['photo'];?>" class="img-responsive img-circle" style="display:inline" alt="Votre photo de profil !" width="100" height="100">
    <?php
    }
    else{      // SI AUCUNE PHOTO
    ?>
    <img src="Vendeur.png" class="img-responsive img-circle margin" style="display:inline" alt="Votre photo de profil !" width="350" height="350">
    <?php
    }
    ?>
    <h3>Profil de <?php echo $infovendeur['nom']; ?> </h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
    <h3 class="margin">Mon profil</h3>
    <center>
    <p id="profil">Profil de <?php echo $infovendeur['prenom'] ." ". $infovendeur['nom']; ?> </p>
        </center>
    <p> Vous pouvez maintenant personnaliser votre profil </p>
    <form method="post" enctype="multipart/form-data">
        <center>
        <b>Choisir une photo de profil</b>
        <p><input type="file" accept="image/*" name="photo"> </p>
        <input type="submit" class=MonBouton name ="photo" value="envoyer">
        </center>
        
        <center>
        <b>Choisir une photo de couverture</b>
        <p><input type="file" accept="image/*" name="fond"></p>
        <input type="submit" class="MonBouton" name ="fond" value="envoyer">
        </center>      
    </form>
<?php
    if(isset($erreur))
    {
        echo '<font color="red">'.$erreur."</font>";
    }
?>
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
  header('location:home.html');
}
?>