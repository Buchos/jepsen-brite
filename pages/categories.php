<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<!--<h2>Upcoming Events by Categories</h2>-->
<!--<ul>-->
<!--    --><?php
//    $categories = $bdd->query('SELECT * FROM `categories`');
//    while ($cats = $categories->fetch()) {
//        $catname = $cats['name'];
//        $catcount = $bdd->prepare('SELECT COUNT(*) AS catcount FROM `events` WHERE `category`= ? AND `date` >= ?');
//        $catcount->execute(array($catname, $today));
//        $numbofcat = $catcount->fetch();
//        echo '<a href="http://becode.local/jepsen-brite/pages/categories.php?category=' . $catname . '"><li>' . $catname . ' - (' . $numbofcat[0] . ')' .'</li></a>';
//    }
//    ?>
<!--</ul>-->
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
    if($i == 0) { ?>
        <article class="no-event">
            <p>There are no future events</p>
        </article>
    <?php }
    ?>
</section>
<?php } ?>

<?php require(PHP . '/footer.php');