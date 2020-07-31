<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Deleting Event' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

<?php
$deleteEvent = $bdd->prepare("UPDATE `events` SET `deleted` = 1 WHERE `id` = ?");
$deleteEvent->execute(array($_POST['delete_id']));
header("Location: ../index.php");
?>

<?php require('../assets/php/footer.php');
