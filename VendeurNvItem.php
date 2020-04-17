<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');  // J'UTILISE UN PDO CAR JE N'AI PAS  REUSSI AVEC MYSQLI

if (isset($_SESSION['id']))      // SI L'USER EST CONNECTE
{
    $recherche = $bdd->prepare('SELECT * FROM vendeur WHERE id = ? ');      // ON PREND SES INFOS
    $recherche->execute(array($_GET['id']));         
    $infovendeur = $recherche->fetch();                                     // ON PREND SES INFOS
    
    if(isset($_POST['bouton']))      // SI JE VALIDE LES INFOS DE L'ITEM
    {
        $nom = htmlspecialchars($_POST['Nom']);
        $desc = htmlspecialchars($_POST['Desc']);
        $cate = htmlspecialchars($_POST['Cate']);
        $achat = htmlspecialchars($_POST['Achat']);
        $prix = htmlspecialchars($_POST['Prix']);
        
        $ajout = $bdd->prepare('INSERT INTO item(nom, description, categorie, achat, prix) VALUES5(?,?,?,?,?)');
        $ajout->execute(array($nom,$desc,$cate,$achat,$prix));
        header('Location:VendeurNvItemAjoute.php?id='.$_SESSION['id']);
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
        background-image: url(vendeur/fonds/<?php echo $infovendeur['fond'];?>);
        background-size: cover;
        color: #ffffff;
        padding-bottom: 20px;
        padding-top:150px;
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
    <h3 class="margin">Ajouter un item destiné à la vente</h3>
    <center>
        <hr/>
        
    <form method="post" <?php echo 'action="VendeurNvItemAjoute.php?id='.$_SESSION['id'].'"'; ?> enctype="multipart/form-data">
	<table>
		<tr>
			<td colspan="3" align="left"><b>Nom de l'item:</b></td>
			<td colspan="3" align="left"><input type="text" name ="Nom" placeholder="Entrez le nom" required></td>
		</tr>
        <tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="3" align="left"><b>Description(état):</b></td>
            <td colspan="3" align="left"><textarea name="Desc" placeholder="Etat de l'item" required></textarea></td>
		</tr>
        <tr><td>&nbsp;</td></tr>
		<tr>
            <td colspan="6" align="center"><b>Quelle est sa catégorie? :</b>&nbsp;</td>
		</tr>
        <tr>
            <td colspan="2" align="left"><input type="radio" name="Cate" value="Feraille ou tresor" required>&nbsp;Feraille ou trésor</td>
            <td colspan="2" align="center"><input type="radio" name="Cate" value="Bon pour le musee">&nbsp;Bon pour le musée</td>
            <td colspan="2" align="right"><input type="radio" name="Cate" value="Accessoire VIP">&nbsp;Accessoire VIP</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
		<tr>
            <td colspan="6" align="center"><b>Comment comptez vous le vendre? :</b>&nbsp;</td>
		</tr>
        <tr>
            <td colspan="2" align="left"><input type="radio" name="Achat" value="Enchere" required>&nbsp;Enchère</td>
            <td colspan="2" align="center"><input type="radio" name="Achat" value="Achat immediat">&nbsp;Achat immédiat</td>
            <td colspan="2" align="right"><input type="radio" name="Achat" value="Meilleure offre">&nbsp;Meilleure offre</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
        <td colspan="2" align="left"><b>Choisir une photo</b></td>
        <td colspan="8" align="right"><input type="file" accept="image/*" name="Photo" required></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan="3" align="center"><b>Le prix:</b></td>
            <td colspan="3"><input type="number" name ="Prix" placeholder="Prix" required></td>
        </tr>
            <tr><td>&nbsp;</td></tr>
        <tr><td colspan="6" align="center"><input type="submit" class="MonBouton" name="bouton" value="Enregistrez ces données"></td></tr>

	</table>
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