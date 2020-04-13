<?php
//recuperer les données venant de la page HTML Connexion
$login = isset($_POST["LoginC"])? $_POST["LoginC"] : "";
$mdp = isset($_POST["mdpC"])? $_POST["mdpC"] : "";


$serveur = array(
    "dodo" => "12345",
    "mehdi" => "6789",
);

$connexion = false;
for ($i = 0; $i < count($serveur); $i++) {
    if ($serveur[$login] == $mdp){
    $connexion = true;
    break;}
}


if ($connexion) {
    if (isset($_POST['button'])) {
        echo "Login successfull !";
        header("Location: home.html");
    }
    if (isset($_POST['button2']))
    {
        echo "Login NOUVEAU successfull !";
        header("Location: vendeur.html");
    }
}
else
{
    echo "Vous n'etes pas dans le serveur";
}

?>