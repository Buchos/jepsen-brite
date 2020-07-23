<?php require_once('assets/php/initialize.php') ?>
<?php $page_title = 'JepsenBrite Homepage' ?>
<?php require('assets/php/header.php') ?>
<?php require('assets/php/nav.php')?>

<section class="events-container">
<?php
$bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_cc256803d465131', 'bd60e8ee909b42', '2db04edd', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$response = $bdd->query('SELECT * FROM `events` ORDER BY `date`');
while ($data = $response->fetch()) {
    // display event ONLY if date > today
    if ($data['date']>$today) {
        echo '<article class="event-entry">
            <h3 class="event-title">' . $data['title'] . '</h3>
            <p class="event-date">' . $data['date'] .'</p>
            <p class="event-author"> Organized by ' . $data['author'] . '</p>
            <img src="" alt="Here will be the image ">' . $data['image'] . '
            <p class="event-description">' . $data['description'] . '</p>
        </article>';
    }
}
?>
</section>

<?php require('assets/php/footer.php');