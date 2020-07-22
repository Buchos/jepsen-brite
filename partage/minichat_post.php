<?php
// Effectuer ici la requête qui insère le message

setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
try
{
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
};

$require = $bdd->prepare('INSERT INTO TP2_minichat(pseudo, message) VALUES(:pseudo,
:message)');
$require->execute(array(
'pseudo' => $_POST['pseudo'],
'message' => $_POST['message'],
));


// Puis rediriger vers minichat.php comme ceci :
header('Location: minichat.php');
?>