<?php session_start(); ?>
<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<?php
$response = $bdd->prepare('SELECT * FROM `events` WHERE `id` = ?');
$response->execute(array($_GET['id']));
$comments = $bdd->prepare('SELECT * FROM `comments` WHERE `event` = ?');
$comments->execute(array($_GET['id']));
?>

<section class="events-container">

<!--    VIEW EVENT    -->
<?php
while ($data = $response->fetch()) {
    echo '<article class="event-entry">
        <p class="event-cat">'. $data['category'] .'</p>
        <h3 class="event-title">' . $data['title'] . '</h3>
        <p class="event-date">' . $data['date'] .'</p>
        <p class="event-author"> Organized by ' . $data['username'] . '</p>
        <img src="" alt="Here will be the image ">' . $data['image'] . '
        <p class="event-description">' . $data['description'] . '</p>
        
    </article>';
} ?>
<!--    FIN DE : VIEW EVENT-->


<!-- PARTIE COMMENTAIRES -->
    <!--    GRAVATAR-->
<?php
$email = "arti.pelmeni@gmail.com";
$size = 50;
$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . "&s=" . $size;
?>

<div>
    <h3>Comments :</h3>
    <img class="gravatar" src="<?php echo $grav_url; ?>" alt="" />
<?php
while ($data2 = $comments->fetch()) {
    echo '<p>' . $data2['comment'] . ' - <i>' . $data2['username'] . '</i></p>';
}
?>
</div>
<!--    FIN DE : COMMENTAIRES -->

</section>

<?php require(PHP . '/footer.php'); ?>