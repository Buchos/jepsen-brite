<?php require_once('../assets/php/initialize.php') ?>
<?php
$deleteEvent = $bdd->prepare("UPDATE events SET deleted = 1 WHERE id = ?");
        $deleteEvent->execute(array($_GET['id']));
        header("Location: profile.php");
?>

<?php $page_title = 'Your Profile' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>



<?php require('../assets/php/footer.php');?>
