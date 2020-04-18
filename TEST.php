<!DOCTYPE html>
<html>
<head>
<title>TP7: Introduction au Framework Bootstrap</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Lien avec bootstrap-->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <!--Lien avec TP7.css-->
    <link rel="stylesheet" type="text/css" href="TEST.css">
    
    <!--Script Java pour le header-->
    <script type="text/javascript">
     $(document).ready(function(){
     $('.header').height($(window).height());
     });
    </script>
</head>
<body>
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
    
    <header class="page-header header container-fluid">   
    <div class="overlay"></div>
    <div class="description">
    <center>
    <h1> Vos items mis à la vente </h1>
    <h3> <?php echo $infovendeur['prenom'] ." ". $infovendeur['nom']; ?> </h3>
    </center>
    </div>
    </header>
    
    <div class="container features">
         <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-12">
         <h3 class="feature-title">Lorem ipsum</h3>
         <img src="column1.jpg" class="img-fluid">
         <p>
         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante
         luctus eu. Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.
         </p>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12">
         <h3 class="feature-title">Lorem ipsum</h3>
         <img src="column2.jpg" class="img-fluid">
         <p>
         Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque interdum quam odio, quis placerat ante
         luctus eu. Sed aliquet dolor id sapien rutrum, id vulputate quam iaculis.
         </p>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12">
            <h3 class="feature-title">Entrer en contact!</h3>
            <div class="form-group">
             <input type="text" class="form-control" placeholder="Votre nom:" name="">
            </div>
            <div class="form-group">
             <input type="email" class="form-control" placeholder="Courriel:" name="email">
            </div>
            <div class="form-group">
             <textarea class="form-control" rows="4">Vos commentaires</textarea>
            </div>
            <input type="submit" class="btn btn-secondary btn-block" value="Envoyer" name="">
         </div>
        </div>
    </div>
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