<?php require_once('assets/php/initialize.php') ?>
<?php $page_title = 'JepsenBrite Homepage' ?>
<?php require('assets/php/header.php') ?>

<?php
$today = date('Y-m-j');
$bdd = new PDO('mysql:host=localhost;dbname=jepsen-brite', 'root', 'sqlPASS3', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$response = $bdd->query('SELECT * FROM `events` ORDER BY `date`');
while ($data = $response->fetch()) {
    // display event ONLY if date > today
    if ($data['date']>$today) {
        echo '<article class="event-entry">
            <h3 class="event-title">' . $data['title'] . '</h3>
            <p class="event-date">' . $data['date'] .'</p>
            <p class="event-organizer"> Organized by ' . $data['organizer'] . '</p>
            <img src="" alt="Here will be the image ">' . $data['image'] . '
            <p class="event-description">' . $data['description'] . '</p>
        </article>';
    }
}
?>

<?php require('assets/php/footer.php');