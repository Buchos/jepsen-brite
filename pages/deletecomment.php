<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Deleting Comment as Admin' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

<?php
$deleteEvent = $bdd->prepare("UPDATE `comments` SET `deleted` = 1 WHERE `id` = ?");
$deleteEvent->execute(array($_POST['delete_id']));
header("Location: event.php?id=$_POST[delete_id]");
?>

<?php require('../assets/php/footer.php');
