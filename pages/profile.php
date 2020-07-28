<?php require_once('../assets/php/initialize.php') ?>
<?php
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<?php $page_title = 'Your Profile' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

      <div align="center">
         <h2>Profil de <?php echo $userinfo['username']; ?></h2>
         <br /><br />
         username = <?php echo $userinfo['username']; ?>
         <br />
         Mail = <?php echo $userinfo['mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editprofile.php">Edit profile</a>
         <a href="logout.php">LOG OUT</a>
         <?php
         }
         ?>
      </div>
      
<?php require('../assets/php/footer.php');?>

<?php   
}
?>
