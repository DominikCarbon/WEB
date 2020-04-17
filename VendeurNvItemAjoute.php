<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');  // J'UTILISE UN PDO CAR JE N'AI PAS  REUSSI AVEC MYSQLI

if (isset($_SESSION['id']))      // SI L'USER EST CONNECTE
{
    $recherche = $bdd->prepare('SELECT * FROM vendeur WHERE id = ? ');      // ON PREND SES INFOS
    $recherche->execute(array($_GET['id']));         
    $infovendeur = $recherche->fetch();        // ON PREND SES INFOS
    
    if(isset($_POST['bouton']))
    {
    
        $nom = htmlspecialchars($_POST['Nom']);
        $desc = htmlspecialchars($_POST['Desc']);
        $cate = htmlspecialchars($_POST['Cate']);
        $achat = htmlspecialchars($_POST['Achat']);
        $prix = htmlspecialchars($_POST['Prix']);
    
        $mysqli = new mysqli("localhost","root","","piscine");
        mysqli_set_charset($mysqli, "utf8");
        if ($mysqli -> connect_errno) 
        {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        }		//ERREUR DE CONNEXION 
        else   //SI AUCUNE ERREUR
        {
            $query = "INSERT INTO `item`(`idV`, `nom`, `description`, `categorie`,`achat`,`prix`,`photo`) VALUES ('".$_SESSION['id']."', '". $nom ."', '". $desc ."', '". $cate ."', '". $achat ."','". $prix ."','"."');";

            if ($mysqli->query($query) === TRUE)
            {
                echo "Added successfully";
            }
            $rechercheitem = $bdd->prepare('SELECT * FROM item WHERE idV = ? AND  nom= ?');
            $rechercheitem->execute(array($_SESSION['id'],$nom));
            $itemexiste = $rechercheitem->rowCount();
            if($itemexiste==1)
            {
                $infoitem = $rechercheitem->fetch();
                
                
                if(isset($_FILES['Photo']))    // SI ON APPUIE SUR MODIFIER LA PHOTO
                {
                    $Max = 216758;
                    if($_FILES['Photo']['size'] <= $Max)
                    {
                        $extensionitem = strtolower(substr(strrchr($_FILES['Photo']['name'], '.'), 1));  // ON MET L'EXTENSION AU FORMAT
                        $cheminitem= "vendeur/items/".$_SESSION['id']."/".$infoitem['id'].".".$extensionitem;   // CHEMIN POUR LA PHOTO APPELEE "ID.EXTENSION"
                        $deplacementphoto=move_uploaded_file($_FILES['Photo']['tmp_name'], $cheminitem);   //  ON DEPLACE LA PHOTO DANS LE DOSSIER
                        if($deplacementphoto)    // SI LE DEPLACEMENT FONCTIONNE
                        {
                            $updatephoto=$bdd->prepare('UPDATE item SET photo =:photo WHERE id =:id');   // REQUETE EN SQL POUR INSERER LA PHOTO
                            $updatephoto->execute(array('photo' => $infoitem['id'].".".$extensionitem, 'id' => $infoitem['id'] ));
                        }
                    }
                    else echo"";
                }
            }
            else
            {
                echo "Problème avec l'item";
            }    
        }
        //$ajout = "INSERT INTO `item`(`idV`, `nom`, `description`, `categorie`, `achat`, `prix`, `photo`) VALUES('". $_SESSION['id'] ."', '". $nom."', '". $desc."','".$cate ."', '". $achat. "', '". $prix ."', '"."')";
        //$ajout->execute(array($_SESSION['id'],$nom,$desc,$cate,$achat,$prix));
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
        padding-top:230px;
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
        
        .MonBouton
    {
        color:black; 
        border-radius: 15px 15px 15px 15px;
        padding:4px;
    }
        textarea {
        padding: 2px;
            border-radius:10px 10px;
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
            <li><a href="Deco.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
        <?php
        }
        ?>
            <li><a href="LogAdmin.html"><span class="glyphicon glyphicon-user"></span> Login Administrateur</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Photo de fond et profil -->
<div class="container-fluid bg-1 text-center">
    <h1> Items à mettre en vente </h1>
    <h3> <?php echo $infovendeur['prenom'] ." ". $infovendeur['nom']; ?> </h3>
</div>
    

<!-- Infos et édition profil -->
<div class="container-fluid bg-2 text-center">
    <h3 class="margin">Vous avez fait le plus dur !</h3>
    <center>
        <p>l'item est mis en vente</p>
        <form method="post" <?php echo 'action="VendeurItem.php?id='.$_SESSION['id'].';' ?> enctype="multipart/form-data">
        <input type="submit" name="bt" value="Retourner voir mes items"/>
        </form>
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