<?php
    $pdo = new PDO('sqlite:../backend/data.db');
    $statement = $pdo->query("SELECT * FROM USERS");
    if ($statement === FALSE){
        die('Erreur SQL');
    }

    $users = $statement->fetchAll();
    if(isset($_POST['envoie'])){
        if(!empty($_POST['infoName']) && !empty($_POST['firstname']) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])){
            $infoName = htmlspecialchars($_POST['infoName']);
            $infoFirstname = htmlspecialchars($_POST['firstname']);
            $infoEmail = htmlspecialchars($_POST['email']);
            $userName = htmlspecialchars($_POST['pseudo']);
            $userMdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            $sql = "INSERT INTO users(userName, userMdp, infoName, infoFirstname, infoEmail)VALUES(?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$userName, $userMdp, $infoName, $infoFirstname, $infoEmail]);
        }else{
            echo "Veuillez compléter tous les champs";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>

        <title>Home</title>
        <link rel="shortcut icon" href="../src/img/home.png">
        <link rel="stylesheet" href="../src/css/default.css">
        <link rel="stylesheet" href="../src/css/index.css">
    </head>
    <body>
        <div class="un">
            <h1 class="titleHero">S'inscrire</h1>
            <div class="deux">
                <form method="POST" action="">
                    <label for="infoName">Nom * : </label>
                    <input type="text" name="infoName" class="inputForm" autocomplete="off">
                    <label for="firstName">Prénom * : </label>
                    <input type="text" name="firstname" class="inputForm" autocomplete="off">
                    <label for="email">E-mail : </label>
                    <input type="text" name="email" class="inputForm" autocomplete="off">
                    <label for="pseudo">Nom d'utilistateur * : </label>
                    <input type="text" name="pseudo" class="inputForm" autocomplete="off">
                    <label for="mdp">Mot de passe * : </label>
                    <input type="password" name="mdp" class="inputForm" autocomplete="off">
                    <button name="envoie" id="sendForm">Envoyer</button>
                </form>
            </div>
        </div>
    </body>
</html>