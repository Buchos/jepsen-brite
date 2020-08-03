<?php require_once('assets/php/initialize.php') ?>
<!--$stupidroot corrects path for CSS file for index.php-->
<?php $stupidroot = ''; ?>
<?php $page_title = 'Homepage' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<section class="events-container">
<?php
$response = $bdd->query("SELECT * FROM `events` WHERE deleted = 0 ORDER BY `date`");
while ($data = $response->fetch()) {
    // display event ONLY if date > today
    if ($data['date']>=$today) {
        $dataForUsername = $bdd->prepare('SELECT * FROM `users` WHERE id =?');
        $dataForUsername->execute(array($data['username']));
        $rawusername = $dataForUsername->fetch();
        $username = $rawusername['username'];
        $description = $Parsedown->text($data['description']);
        echo '<article class="event-entry-index">
            <div class="event-cat"><p>'. $data['category'] .'</p></div>
            <h3 class="event-title">' . $data['title'] . '</h3>
            <div class="ev-d-a"><p class="event-date">' . $data['date'] .'</p>
            <p class="event-author"> - Organized by ' . $username . '</p></div>
            <img class="ev-img-sm" src="' . $data['image'] . '" alt="Image not found">
            <p class="event-description">' . $description . '</p>
            <a href="pages/event.php?id=' . $data['id'] . '">View</a>
        </article>';
    }
}
?>
</section>

<?php require(PHP . '/footer.php');
