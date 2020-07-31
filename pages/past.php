<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<section class="events-container">
    <?php
    $response = $bdd->query('SELECT * FROM `events` WHERE `deleted` = 0 ORDER BY `date` DESC');
    while ($data = $response->fetch()) {
        // display event ONLY if date > today
        if ($data['date']<$today) {
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
            <img class="ev-img-sm" src="' . $stupidroot . $data['image'] . '" alt="Image not found">
            <p class="event-description">' . $description . '</p>
            </article>';
        }
    }
    ?>
</section>

<?php require(PHP . '/footer.php');
?>
