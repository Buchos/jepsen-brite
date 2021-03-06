<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<?php
if (isset($_GET['category'])) { ?>
    <section class="events-container">
    <?php
    // Show Events of certain category
    $response = $bdd->prepare('SELECT * FROM `events` WHERE `deleted` = 0 AND `category` = ? ORDER BY `date`');
    $response->execute(array($_GET['category']));
    $i = 0;
    while ($data = $response->fetch()) {
        // display event ONLY if date > today
        if ($data['date']>$today) {
            $i++;
            $dataForUsername = $bdd->prepare('SELECT * FROM `users` WHERE id =?');
            $dataForUsername->execute(array($data['username']));
            $rawusername = $dataForUsername->fetch();
            $username = $rawusername['username'];
            $description = $Parsedown->text($data['description']);
            echo '<article class="event-entry">
            <p class="event-cat">'. $data['category'] .'</p>
            <h3 class="event-title">' . $data['title'] . '</h3>
            <p class="event-date">' . $data['date'] .'</p>
            <p class="event-author"> Organized by ' . $username . '</p>
            <img class="ev-img-sm" src="' . $data['image'] . '" alt="Image not found">
            <p class="event-description">' . $description . '</p>
            <a href="event.php?id=' . $data['id'] . '">View</a>
            </article>';
        }
    }
    if ($i == 0) { ?>
        <article class="no-event">
            <p>There are no future events</p>
        </article>
    <?php }
    ?>
</section>
<?php } ?>

<?php require(PHP . '/footer.php');
