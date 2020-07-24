<?php require_once('assets/php/initialize.php') ?>
<!--$stupidroot corrects path for CSS file for index.php-->
<?php $stupidroot = ''; ?>
<?php $page_title = 'Homepage' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<section class="events-container">
<?php
$bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_cc256803d465131', 'bd60e8ee909b42', '2db04edd', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$response = $bdd->query('SELECT * FROM `events` ORDER BY `date`');
while ($data = $response->fetch()) {
    // display event ONLY if date > today
    if ($data['date']>=$today) {
        echo '<article class="event-entry">
            <div class="event-cat"><p>'. $data['category'] .'</p></div>
            <h3 class="event-title">' . $data['title'] . '</h3>
            <div class="ev-d-a"><p class="event-date">' . $data['date'] .'</p>
            <p class="event-author"> - Organized by ' . $data['author'] . '</p></div>
            <img src="" alt="Here will be the image ">' . $data['image'] . '
            <p class="event-description">' . $data['description'] . '</p>
        </article>';
    }
}
?>
</section>

<?php require(PHP . '/footer.php');