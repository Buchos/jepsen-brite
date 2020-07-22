<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

<ul>
    <?php
    $bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_cc256803d465131', 'bd60e8ee909b42', '2db04edd', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $categories = $bdd->query('SELECT * FROM `categories`');
    while ($cats = $categories->fetch()) {
        echo '<li>' . $cats['Name'] .'</li>';
    }
    ?>
</ul>
<!--<section class="events-container">-->
<!--    --><?php
//    // Show Events of certain category
//    $response = $bdd->prepare('SELECT * FROM `events` WHERE `category` = ? ORDER BY `date`');
//    $response->execute(array($_GET['category']));
//    while ($data = $response->fetch()) {
//        // display event ONLY if date > today
//        if ($data['date']>$today) {
//            echo '<article class="event-entry">
//        <h3 class="event-title">' . $data['title'] . '</h3>
//        <p class="event-date">' . $data['date'] .'</p>
//        <p class="event-author"> Organized by ' . $data['author'] . '</p>
//        <img src="" alt="Here will be the image ">' . $data['image'] . '
//        <p class="event-description">' . $data['description'] . '</p>
//    </article>';
//        }
//    }
//    ?>
<!--</section>-->

<?php require('../assets/php/footer.php');