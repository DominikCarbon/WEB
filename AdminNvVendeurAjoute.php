<?php
session_start();

if (isset($_SESSION['id']))      // SI L'USER EST CONNECTE
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
        if(isset($_POST['button']))  //ON VALIDE TOUTES SES INFOS
        {
            $mail = htmlspecialchars($_POST['mail']);
            $nom = htmlspecialchars($_POST['Nom']);
            $prenom = htmlspecialchars($_POST['Prenom']);
            $mdp = sha1($_POST['mdp']);

            $maillength = strlen($mail); //Taille du mail

            if($maillength <= 255)   //Si elle correspond 
            {

                //header('Location:home.html');
                 $query = "INSERT INTO `vendeur`(`mail`, `mdp`, `nom`, `prenom`,`photo`,`fond`) VALUES ('". $mail ."', '". $mdp ."', '". $nom ."', '". $prenom ."','"."','"."');";

                if ($mysqli->query($query) === TRUE)
                {
                        $bonnenouvelle= "Ajouté avec succès";
                }//end if 
                 else 
                 {
                     $erreur= "Error: " . $query . "<br>";
                 }
                 $mysqli -> close();
            }
            else    // Si elle est trop grande
            {
                 $erreur="Mail trop long";
            }
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
              
    .bg-1
    { 
        background-color: cadetblue; /* Green */
        background-image: url(vendeur/fonds/fond.jpg);
        background-size: cover;
        color: #ffffff;
        padding-bottom: 20px;
        padding-top:230px;
    }   

    
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
        
    input
    {
        border-radius: 7px 7px 7px 7px;
        color:dimgrey;
    }    
        
        .MonBouton
    {
        color:black; 
        border-radius: 15px 15px 15px 15px;
        padding:4px;
    }
    textarea {
        padding: 2px;
        border-radius:10px 10px;
        color:dimgray;
    } 
        
    input[type=number] {
        width: 100px;
        padding: 2px;
    } 
    input[type=date] {
        width: 160px;
        padding: 2px;
    }   
 
    input[type=text] {
        width: 200px;
        padding: 2px;
    }  
</style>

</head>
    
<body>

<!-- barre de navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid" id="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" id="Logo" href="home.html"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

          <ul class="nav navbar-nav navbar-right">
            <li><a href="Deco.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Photo de fond et profil -->
<div class="container-fluid bg-1 text-center">
    <h1> Items à mettre en vente </h1>
    <h3> <?php echo $_SESSION['id']; ?> </h3>
</div>
    

<!-- Infos et édition profil -->
<div class="container-fluid bg-2 text-center">
    <h3 class="margin">Ajouter un item destiné à la vente</h3>
    <center>
        
    <center>
    <form action="" method="post" enctype="multipart/form-data">
        <p><i>Les champs marqués par un </i><em>*</em><i> sont </i><em>obligatoires</em></p>
        
        <fieldset>
        <legend>Coordonnées</legend>
        <label>Nom <em>*</em></label>
        <input type="text" name="Nom" placeholder="Entrez votre Nom" required><br/>
        <label><b>Prénom</b><em>*</em></label>
        <input type="text" name="Prenom" placeholder="Entrez votre Prénom" required><br/>
        <label><b>Mail</b><em>*</em></label>
        <input type="email" name="mail" placeholder="Entrez votre Mail" required><br/>
        <label><b>Pseudo</b><em>*</em></label>
        <input type="text" name="mdp" placeholder="Entrez un Pseudo" required="">
        <br/>
        <p><input type="submit" name="button" value="Valider"></p>
        </fieldset>
    </form>
    </center>
        
<hr/>
<?php
    if(isset($erreur))    // Une erreur s'est produite on l'affiche
    {
        echo '<font color="red">'.$erreur."</font>";
    }
    if(isset($bonnenouvelle))    // Tout s'est bien passé, on le fait savoir a l'utilisateur
    {
        echo '<font color="grey">'.$bonnenouvelle."</font>";
?>
            <h3 class="margin">C'est bon !</h3>
    <center>
        <p>Votre vendeur peut mainteant se connecter à la plateforme</p>
        <?php echo '<a href="AdminVendeur.php"><input type="submit" name="bt" value="Retourner voir les vendeurs"/></a>'; ?>
</center>
<?php
    }
?>
    
    </center>

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