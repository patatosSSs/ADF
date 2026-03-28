<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription reussite</title>
    <link rel="stylesheet" href="stylesADF/styles_traitement.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>
<body>
    <?php
$host = 'localhost';
$dbname = 'utilisateur';
$user = 'root';
$pass = ''; 

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $creneau = $_POST['creneau'];

    $sql = "INSERT INTO utilisateurs(prenom,email,nom,creneau) VALUES ('$prenom','$email','$nom','$creneau')";
    $result = $bdd ->exec($sql);
}

$reponse = $bdd->query("SELECT nom, email FROM utilisateurs");


while ($donnees = $reponse->fetch()) {
    echo "<div class='emails'>".htmlspecialchars($donnees['email'])."</div>";
    $email .= htmlspecialchars($donnees['email']);
}
$reponse->closeCursor();

var_dump($email);

?>
<main>
    <div class="case">
        <h1>Inscription reussite</h1>
        <a href="#"><div class="lien">Revenir au site</div></a>
    </div>
</main>
</body>
</html>
