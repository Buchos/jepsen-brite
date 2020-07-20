<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP2 - minichat</title>
</head>
<body>
 
 
<section>
 
<?php
try
{
$bdd = new PDO('mysql:host=jepsen-brite.sql;dbname=jepsen-brite', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT * FROM events ORDER BY id DESC ');
while ($donnees = $reponse->fetch())
{
?>
<p>
<strong> <?php echo htmlspecialchars($donnees['name']) ; ?> </strong> :  <?php echo htmlspecialchars($donnees['date']) ; ?> <br/>
</p>
<?php
}
$reponse->closeCursor();
?>
 
</section>
 
</form>
</body>
 
</html>