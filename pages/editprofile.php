<?php require_once('../assets/php/initialize.php') ?>
<?php 
if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newusername']) AND !empty($_POST['newusername']) AND $_POST['newusername'] != $user['username']) {
      $newusername = htmlspecialchars($_POST['newusername']);
      $insertusername = $bdd->prepare("UPDATE users SET username = ? WHERE id = ?");
      $insertusername->execute(array($newusername, $_SESSION['id']));
      header('Location: profile.php?id='.$_SESSION['id']);
   }
   
   if(isset($_POST['newpassword1']) AND !empty($_POST['newpassword1']) AND isset($_POST['newpassword2']) AND !empty($_POST['newpassword2'])) {
      $password1 = sha1($_POST['newpassword1']);
      $password2 = sha1($_POST['newpassword2']);
      if($password1 == $password2) {
         $insertmdp = $bdd->prepare("UPDATE users SET password = ? WHERE id = ?");
         $insertmdp->execute(array($password1, $_SESSION['id']));
         header('Location: profile.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<?php $page_title = 'Edit Your Profile' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

      <div align="center">
         <h2>Edition de mon profil</h2>
         <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Mail :</label>
               <?php echo $user['mail']; ?> <br /><br>
               <label>username :</label>
               <input type="text" name="newusername" placeholder="username" value="<?php echo $user['username']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="newpassword1" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="newpassword2" placeholder="Confirmation du mot de passe" /><br /><br />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
      <?php require('../assets/php/footer.php');?>
<?php   
}
else {
   header("Location: login.php");
}
?>