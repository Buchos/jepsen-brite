<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Create user' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>
<?php

if (isset($_POST['forminscription'])) {
    $username = htmlspecialchars($_POST['username']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);
    if (!empty($_POST['username']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['password']) and !empty($_POST['password2'])) {
        $usernamelength = strlen($username);
        if ($usernamelength <= 255) {
            if ($mail == $mail2) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if (1) { // REMPLACER 1 PAR $mailexist == 0 pour activer la condition
                        if ($password == $password2) {
                            $insertmbr = $bdd->prepare("INSERT INTO users(username, password, mail) VALUES(?, ?, ?)");
                            $insertmbr->execute(array($username, $password, $mail));
                            $erreur = "Votre compte a bien été créé ! <a href=\"login.php\">Me connecter</a>";
                        } else {
                            $erreur = "Vos mots de passes ne correspondent pas !";
                        }
                    } else {
                        $erreur = "Adresse mail déjà utilisée !";
                    }
                } else {
                    $erreur = "Votre adresse mail n'est pas valide !";
                }
            } else {
                $erreur = "Vos adresses mail ne correspondent pas !";
            }
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>



<div align="center">
    <h2>Inscription</h2>
    <br /><br />
    <form method="POST" action="">
        <table>
            <tr>
                <td align="right">
                    <label for="username">Pseudo :</label>
                </td>
                <td>
                    <input type="text" placeholder="Votre pseudo" id="username" name="username" value="<?php if(isset($username)) { echo $username; } ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="mail">Mail :</label>
                </td>
                <td>
                    <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="mail2">Confirmation du mail :</label>
                </td>
                <td>
                    <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="password">Mot de passe :</label>
                </td>
                <td>
                    <input type="password" placeholder="Votre mot de passe" id="password" name="password" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="password2">Confirmation du mot de passe :</label>
                </td>
                <td>
                    <input type="password" placeholder="Confirmez votre mdp" id="password2" name="password2" />
                </td>
            </tr>
            <tr>
                <td></td>
                    <td align="center">
                <br />
                    <input type="submit" name="forminscription" value="Je m'inscris" />
                </td>
            </tr>
        </table>
    </form>
    <?php if (isset($erreur)) {
        echo '<span color="red">'.$erreur."</span>";
    } ?>
</div>

<?php require('../assets/php/footer.php');
