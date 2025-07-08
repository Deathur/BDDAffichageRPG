<?php
$host = 'localhost';
$dbname = 'rpg';
$user = 'root';
$password = '';

//Connexion BDD
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Active les erreurs PDO en exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script>console.log('Connexion réussi !');</script>";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

//Requête SQL
$sql = "SELECT personnage.nom AS \"NomPersonnage\", surnom, level, classe.nom AS \"NomClasse\", arme.nom AS \"NomArme\"
        FROM personnage
        INNER JOIN classe ON personnage.idClasse = classe.idClasse
        INNER JOIN arme ON personnage.idArmeUtilise = arme.idArme;";

//Exécution
$req = $pdo->prepare($sql);
$req->execute();
$results = $req->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="titre">Liste de joueur</h1>
    <div class="gridPlayer">
    <?php

//Exploitation

foreach ($results as $key => $value) {
    echo "<div>";
    echo "Nom: ".$value["NomPersonnage"]."<br>";
    echo "Surnom: ".$value["surnom"]."<br>";
    echo "Niveau : ".$value["level"]."<br>";
    echo "Classe: ".$value["NomClasse"]."<br>";
    echo "Arme utilisé: ".$value["NomArme"];
    echo "</div>";
}
    ?>
    </div>
</body>
</html>