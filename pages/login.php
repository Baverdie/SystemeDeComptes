<?php
    $pdo = new PDO('sqlite:../backend/data.db');
    $statement = $pdo->query("SELECT * FROM USERS");
    if ($statement === FALSE){
        die('Erreur SQL');
    }

    $users = $statement->fetchAll();
    if(isset($_POST['envoie'])){
        if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
            $userName = htmlspecialchars($_POST['pseudo']);
            $userMdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            
            $verify = $pdo->prepare('SELECT * FROM USERS WHERE pseudo = ? AND mdp = ?');
            $verify->execute(array($pseudo, $mdp));

            if($verify->rowCount() > 0) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $verify->fetchAll()['id'];
                header('Location: ../index.php');
            }else {
                echo "Nom d'utilisateur ou mot de passe incorrecte";
            }
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
            <h1 class="titleHero">Se connecter</h1>
            <div class="deux">
                <form method="POST" action="">
                    <label for="pseudo">Nom d'utilistateur * : </label>
                    <input type="text" name="pseudo" class="inputForm" autocomplete="off">
                    <label for="mdp">Mot de passe * : </label>
                    <input type="password" name="mdp" class="inputForm" autocomplete="off">
                    <button name="envoie" id="sendForm">Connexion</button>
                </form>
            </div>
        </div>
    </body>
</html>