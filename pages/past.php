<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<h2>Past Events</h2>
<section class="events-container">
    <?php
    $response = $bdd->query('SELECT * FROM `events` WHERE `deleted` = 0 ORDER BY `date`');
    while ($data = $response->fetch()) {
        // display event ONLY if date > today
        if ($data['date']<$today) {
            echo '<article class="event-entry">
        <p class="event-cat">'. $data['category'] .'</p>
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

<?php require(PHP . '/footer.php');
?>
