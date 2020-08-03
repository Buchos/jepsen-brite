<!--
    a faire : cookie qui retient le pseudo du dernier message validé et l'assigne en "value" de l'input "pseudo" 
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP2 - minichat</title>
</head>
<body>
 
<form action="minichat_post.php" method="post">
<p>
pseudo :
<input type="text" name="pseudo" value="" /> <br/>
message :
<input type="text" name="message" /> <br/>
 
<input type="submit" value="Valider" /> <br/>
<input type="button" value="Actualiser" Onclick="javascript:window.history.go(0)">
</p>
 
</header>
 
<section>
 
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', 'sqlPASS3', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM TP2_minichat ORDER BY id DESC ');
while ($donnees = $reponse->fetch()) {
    ?>
<p>
<strong> <?php echo htmlspecialchars($donnees['pseudo']) ; ?> </strong> :  <?php echo htmlspecialchars($donnees['message']) ; ?> <br/>
</p>
<?php
}
$reponse->closeCursor();
?>
 
</section>
 
</form>
</body>
 
</html>