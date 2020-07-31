<?php require_once('../assets/php/initialize.php') ?>
<?php
var_dump($_POST['title']);
var_dump($_POST['username']);
var_dump($_POST['date']);
var_dump($_POST['time']);
var_dump($_POST['image']);
var_dump($_POST['description']);
var_dump($_POST['category']);
var_dump($_POST['id']);

//$edit = $bdd->prepare('UPDATE events SET (title, username, date, time, image , description, category) VALUES(:title, :username, :date, :time, :image , :description, :category)');
$edit = $bdd->prepare('UPDATE `events` SET `title`= ?,`username`= ?,`date`= ?,`time`= ?,`image`= ?,`description`= ?,`category`= ? WHERE `id` = ?');
$edit->execute(array($_POST['title'],$_POST['username'],$_POST['date'],$_POST['time'],$_POST['image'],$_POST['description'],$_POST['category'],$_POST['id']));
header('Location: event.php?id=' . $_POST['id']);