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
        $description = $Parsedown->text($data['description']);
        echo '<article class="event-entry-index">
            <div class="event-cat"><p>'. $data['category'] .'</p></div>
            <h3 class="event-title">' . $data['title'] . '</h3>
            <div class="ev-d-a"><p class="event-date">' . $data['date'] .'</p>
            <p class="event-author"> - Organized by ' . $data['username'] . '</p></div>
            <img src="' . $data['image'] . '" alt="Here will be the image ">
            <p class="event-description">' . $description . '</p>
            <a href="pages/event.php?id=' . $data['id'] . '">View</a>
        </article>';
    }
}
?>
</section>

<?php require(PHP . '/footer.php');








//$currentPage = (int)($_GET['page'] ?? 1);
//if ($currentPage <= 0) {
//    echo ('Invalid page number');
//}
//$count = $bdd->query('SELECT COUNT(id) FROM events')->fetch(PDO::FETCH_NUM)[0];
//$perPage = 10;
//$pages = ceil($count / $perPage);
//if ($currentPage > $pages) {
//    echo ("This page doesn't exist");
//}
//$offset = $perPage * ($currentPage - 1);