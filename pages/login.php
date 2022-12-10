<?php
    session_start();
    header("X-FRAME-OPTIONS: DENY");
    $pdo = new PDO('sqlite:../backend/data.db');
    $statement = $pdo->query("SELECT * FROM USERS");
    $_SESSION['isLog'] = false;
    if ($statement === FALSE){
        die('Erreur SQL');
    }

    $users = $statement->fetchAll();
    if(isset($_POST['envoie'])){
        if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
            $userName = htmlspecialchars($_POST['pseudo']);
            $userMdp = htmlspecialchars($_POST['mdp']);

            foreach ($users as $user) {
                if($user[1] == $userName && $user[2] == password_verify($userMdp, $user[2])) {
                    $_SESSION['pseudo'] = $userName;
                    $_SESSION['id'] = $user[0];
                    $_SESSION['isLog'] = true;
                    header('Location: ../index.php');
                }else {
                    echo "Nom d'utilisateur ou mot de passe incorrecte";
                }
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