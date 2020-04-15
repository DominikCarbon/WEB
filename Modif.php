
<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=piscine', 'root', '');
if (isset($_SESSION['id']))
{
    $recherche = $bdd->prepare('SELECT * FROM client WHERE id = ? ');
    $recherche->execute(array($_SESSION['id']));
    $infoclient = $recherche->fetch();


    if(isset($_FILES['photo']))    // SI ON APPUIE SUR MODIFIER LA PHOTO
    {
      $extension = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));  // ON MET L4EXTENSION AU FORMAT
      $chemin= "client/photos/".$_SESSION['id'].".".$extension;   // CHEMIN POUR LA PHOTO APPELEE "ID.EXTENSION"
      $deplacement=move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);   //  ON DEPLACE LA PHOTO DANS LE DOSSIER
      if($deplacement)    // SI LE DEPLACEMENT FONCTIONNE
      {
          $updatephoto=$bdd->prepare('UPDATE client SET photo =:photo WHERE id =:id');   // REQUETE EN SQL POUR INSERER LA PHOTO
          $updatephoto->execute(array('photo' => $_SESSION['id'].".".$extension, 'id' => $_SESSION['id'] ));

          header('Location:Client2.php?id='.$_SESSION['id']);
      }
      else
      {
        echo "erreur deplacement";
      }
    }
    if(isset($_FILES['fond']))    // SI ON APPUIE SUR MODIFIER LA PHOTO
    {
      $extension = strtolower(substr(strrchr($_FILES['fond']['name'], '.'), 1));  // ON MET L4EXTENSION AU FORMAT
      $chemin= "client/fonds/".$_SESSION['id'].".".$extension;   // CHEMIN POUR LA PHOTO APPELEE "ID.EXTENSION"
      $deplacement=move_uploaded_file($_FILES['fond']['tmp_name'], $chemin);   //  ON DEPLACE LA PHOTO DANS LE DOSSIER
      if($deplacement)    // SI LE DEPLACEMENT FONCTIONNE
      {
          $updatephoto=$bdd->prepare('UPDATE client SET fond =:fond WHERE id =:id');   // REQUETE EN SQL POUR INSERER LA PHOTO
          $updatephoto->execute(array('fond' => $_SESSION['id'].".".$extension, 'id' => $_SESSION['id'] ));

          header('Location:Client2.php?id='.$_SESSION['id']);
      }
      else
      {
        echo "erreur deplacement";
      }
    }
?>
<html>
<head>
  <title>Client</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="Vendeur.css">

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
      <li><a class="B" href="LogClient.html">Mon Profil</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php
    if(isset($_SESSION['id']) AND $infoclient['id']==$_SESSION['id'])
    {
    ?>
    <li><a href="Deco.php"><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
    <?php
    }
        ?>
        <li><a href="LogAdmin.html"><span class="glyphicon glyphicon-log-in"></span> Login Administrateur</a></li>
        <li><a href="#"> Mes items dans le panier </a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <img src="Vendeur.png" class="img-responsive img-circle margin" style="display:inline" alt="Votre photo de profil !" width="350" height="350">
    <h3>Profil de <?php echo $infoclient['nom']; ?> </h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <h3 class="margin">Mon profil</h3>
    <p>Profil de <?php echo $infoclient['prenom'] ." ". $infoclient['nom']; ?> </p>
  <p> Vous pouvez maintenant personnaliser votre profil </p>
    <form method="post" enctype="multipart/form-data">
      <center>
      <p><input type="file" accept="image/*" name="photo"> choisir une photo de profil</p>
      <input type="submit" name ="photo" value="envoyer">
        </center>
        
        <center>
      <p><input type="file" accept="image/*" name="fond"> choisir une photo de couverture</p>
      <input type="submit" name ="fond" value="envoyer">
        </center>      
</form>
</div>


<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>EBAY ECE</p> 
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