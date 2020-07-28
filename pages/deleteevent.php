<?php
session_start();
 
$bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_cc256803d465131', 'bd60e8ee909b42', '2db04edd', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$deleteUser = $db->prepare("UPDATE `users` SET `deleted`= ('1') WHERE id = ?");
        $deleteEvent->execute(array($_SESSION['id']));
        header("Location: index.php");
?>

<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Your Profile' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>



<?php require('../assets/php/footer.php');?>
