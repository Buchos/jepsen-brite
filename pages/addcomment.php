<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Adding Comment' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

<?php
$addComment = $bdd->prepare("INSERT INTO `comments`(username, event, comment) VALUES(:username, :event, :comment)");
$addComment->execute(array(
    'username' => $_POST['username'],
    'event' => $_SESSION['author'],
    'comment' => $_POST['comment'],
));
header("Location: ../index.php?id=");
?>

<?php require('../assets/php/footer.php');
