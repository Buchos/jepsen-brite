<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'LOG IN' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

<?php

if (isset($_POST['formconnexion'])) {
    $usernameconnect = htmlspecialchars($_POST['usernameconnect']);
    $mdpconnect = ($_POST['mdpconnect']);
    var_dump($usernameconnect);
    var_dump($mdpconnect);
    if (!empty($usernameconnect) and !empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $requser->execute(array($usernameconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if ($userexist == 1) {
             $userinfo = $requser->fetch();
             $_SESSION['id'] = $userinfo['id'];
             $_SESSION['username'] = $userinfo['username'];
             $_SESSION['mail'] = $userinfo['mail'];
             header("Location: profile.php?id=".$_SESSION['id']);
        } else {
            $erreur = "Mauvais mail ou mot de passe !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

<div align="center">
    <h2>Connexion</h2>
    <br /><br />
    <form method="POST" action="">
        <input type="text" name="usernameconnect" placeholder="Username" />
        <input type="password" name="mdpconnect" placeholder="Mot de passe" />
        <br /><br />
        <input type="submit" name="formconnexion" value="Se connecter !" />
    </form>
    <?php
    if (isset($erreur)) {
        echo '<span color="red">'.$erreur."</span>";
    }
    ?>
</div>

<?php require('../assets/php/footer.php');?>