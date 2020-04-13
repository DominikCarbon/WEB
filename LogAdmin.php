<?php
//recuperer les données venant de la page HTML Connexion
$login = isset($_POST["LoginA"])? $_POST["LoginA"] : "";
$mdp = isset($_POST["mdpA"])? $_POST["mdpA"] : "";

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
        /*if($login == "" || $mdp == "")
        {
            echo "Erreur : Ce(s) champ(s) est(sont) vide(s) <br>"; 
            if($login == "")
            {
                echo " Login";
            }
            if($mdp == "")
            {
                echo " Mot de passe";
            }
        }
        else
        {
            echo "Login successfull !";
        }*/
        echo "login successfull !";
        header("Location: home.html");
    }
}
else
{
    echo "Identifiants erronés";
}

?>