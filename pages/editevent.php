<?php require_once('../assets/php/initialize.php') ?>
<?php
if (isset($_POST['id'])) {
    $reqevent = $bdd->prepare("SELECT * FROM events WHERE id = ?");
    $reqevent->execute(array($_POST['id']));
    $event = $reqevent->fetch();
    if (isset($_POST['newtitle']) and !empty($_POST['newtitle']) and $_POST['newtitle'] != $event['title']) {
        $newtitle = htmlspecialchars($_POST['newtitle']);
        $inserttitle = $bdd->prepare("UPDATE events SET title = ? WHERE id = ?");
        $inserttitle->execute(array($newtitle, $_POST['id']));
        header('Location: event.php?id='.$_POST['id']);
    }
   
    if (isset($_POST['newpassword1']) and !empty($_POST['newpassword1']) and isset($_POST['newpassword2']) and !empty($_POST['newpassword2'])) {
        $password1 = sha1($_POST['newpassword1']);
        $password2 = sha1($_POST['newpassword2']);
        if ($password1 == $password2) {
            $insertmdp = $bdd->prepare("UPDATE events SET password = ? WHERE id = ?");
            $insertmdp->execute(array($password1, $_SESSION['id']));
            header('Location: profile.php?id='.$_SESSION['id']);
        } else {
            $msg = "Vos deux mdp ne correspondent pas !";
        }
    } ?>
<?php $page_title = 'Edit Your Profile' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

      <div align="center">
         <h2>Edition de mon profil</h2>
         <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Mail :</label>
               <?php echo $event['mail']; ?> <br /><br>
               <label>event name :</label>
               <input type="text" name="newtitle" placeholder="event name" value="<?php echo $event['title']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="newpassword1" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="newpassword2" placeholder="Confirmation du mot de passe" /><br /><br />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if (isset($msg)) {
        echo $msg;
    } ?>
         </div>
      </div>
      <?php require('../assets/php/footer.php'); ?>
<?php
} else {
        header("Location: login.php");
    }
?>