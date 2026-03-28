<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADF:inscription</title>
    <link rel="stylesheet" href="../styles/styleinscrip.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php

    $email = "";
    $prenom = "";
    $nom = "";
    $message = "";
    $erreur = "";


    if (isset($_POST["clic"])) {
        try   // Connexion à la base de données
        {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $bdd = new PDO('mysql:host=localhost;dbname=utilisateur', 'root', '', $options);
        } catch (Exception $err) {
            die('Erreur connexion MySQL : ' . $err->getMessage());
        }


        if (!empty($_POST["email"]) || !empty($_POST["nom"]) || !empty($_POST["prenom"]) || !empty($_POST["creneau"]) || !empty($_POST["participer"])) {
            $email = $_POST["email"];
            $prenom = $_POST["prenom"];
            $nom = $_POST["nom"];
            $creneau = $_POST["creneau"];
            $participer = $_POST["participer"];
            $verif = $bdd->query("SELECT email FROM utilisateurs WHERE email = '$email'");
            $table = $verif->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($table)) {
                $erreur = "<div class ='erreur'>Cette adresse mail est déjà utilisée</div>";
            } else {
                $sql = "INSERT INTO utilisateurs(prenom,email,nom,creneau,participer) VALUES ('$prenom','$email','$nom','$creneau','$participer')";
                $result = $bdd->exec($sql);
                $message = "<div class = 'message'>Inscription reuissite</div>";
            }
            $bdd = null;
        }

    } else {
        $message = "<div class = 'message'>Veuillez remplir le formulaire</div>";
    }

    ?>



    <header>
        <div class="logo"><img src="image/abeille.png" alt="logo">
            <h1>ADF</h1>
        </div>
        <div class="nav"><a href="#">Accueil</a></div>
        <div class="nav"><a href="#">Qui sommes-nous ?</a></div>
        <div class="nav"><a href="#">Info</a></div>
        <div class="nav"><a href="#">Contact</a></div>
        <div class="inscrire"><a href="#">S'inscrire</a></div>
    </header>
    <main>
         <div class="resultat">
            <?= $message ?>
            <?= $erreur ?>
        </div>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Formulaire d'inscription</h1>
            <label class="champ">Votre Email
                <input type="email" name="email" placeholder="Email" value="<?= $email ?>" required>
            </label>
            <label class="champ">Votre Nom
                <input type="text" name="nom" placeholder="Nom" value="<?= $nom ?>" required>
            </label>
            <label class="champ">Votre Prénom
                <input type="text" name="prenom" placeholder="Prenom" value="<?= $prenom ?>" required>
            </label>
            <label class="champ">Choisissez un créneau
                <select name="creneau">
                    <option value="">Sélectionner</option>
                    <option value="Creneau1"
                    <?php
                    if ($creneau = "Creneau1"){
                        echo 'selected';
                    }
                    ?>>1</option>
                    <option value="Creneau2"
                    <?php
                    if ($creneau = "Creneau2"){
                        echo 'selected';
                    }
                    ?>>2</option>
                    <option value="Creneau3"
                    <?php
                    if ($creneau = "Creneau3"){
                        echo 'selected';
                    }
                    ?>>3</option>
                </select>
            </label>
            <label class="champ">Avez vous deja participer ?
                <select name="participer" value="<?= $participer ?>">
                    <option value="non">Non</option>
                    <option value="oui">Oui</option>
                </select>
            </label>
            <div class="style">
                <label class="sub">
                    <input type="submit" value="S'INSCRIRE" name="clic" class="envoi">
                </label>
            </div>
        </form>
    </main>
</body>

</html>