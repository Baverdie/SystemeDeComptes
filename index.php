<?php
    session_start();
    header("X-FRAME-OPTIONS: DENY");
    $pdo = new PDO('sqlite:./backend/data.db');
    $statement = $pdo->query("SELECT * FROM USERS");
    if ($statement === FALSE){
        die('Erreur SQL');
    }

    if (isset($_SESSION['isLog']) && $_SESSION['isLog'] == true) {
        $pseudo = $_SESSION['pseudo'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>

        <title>Home</title>
        <link rel="shortcut icon" href="./src/img/home.png">
        <link rel="stylesheet" href="./src/css/default.css">
        <link rel="stylesheet" href="./src/css/index2.css">
    </head>
    <body>
        <div class="un">
            <h1 class="titleHero">Index</h1>
        </div>
        <?php
            if (isset($_SESSION['isLog']) && $_SESSION['isLog'] === true) {?>
                <div class="log">
                    <p class="userInfo">Connecter en tant que : <?php echo $pseudo ?></p>
                    <button name="deconnexion" id="deconnexion">Se deconnecter</button>
                </div><?php
            }elseif (!isset($_SESSION['isLog']) || $_SESSION['isLog'] == false) {?>
                <div class="log">
                    <button id="register">S'inscrire</button>
                    <button id="login">Se connecter</button>
                </div><?php
            }
        ?>
        <script src="./src/js/button.js"></script>
    </body>
</html>