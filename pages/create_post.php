<?php session_start(); ?>

<?php
// Effectuer ici la requête qui insère le message 

try {
    $bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_cc256803d465131', 'bd60e8ee909b42', '2db04edd', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
};

$require = $bdd->prepare('INSERT INTO events(title, username, date, time, image , description, category) VALUES(:title, :username, :date, :time, :image , :description, :category)');
$require->execute(array(
    'title' => $_POST['title'],
    'username' => $_POST['username'],
    'date' => $_POST['date'],
    'time' => $_POST['time'],
    'image' => $_POST['image'],
    'description' => $_POST['description'],
    'category' =>  $_POST['category']
));


// Puis rediriger vers l'index.php comme ceci : 
header('Location: ../index.php');
?>