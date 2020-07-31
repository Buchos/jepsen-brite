<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Adding Comment' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

<?php
$addComment = $bdd->prepare("INSERT INTO `comments`(username, event, comment) VALUES(:username, :event, :comment)");
$addComment->execute(array(
    'username' => $_POST['username'],
    'event' => $_POST['event'],
    'comment' => $_POST['comment'],
));
$eventID = $_POST['event'];
header("Location: event.php?id=$eventID");
?>

<?php require('../assets/php/footer.php');
