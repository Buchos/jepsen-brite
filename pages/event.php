<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<?php
$response = $bdd->prepare('SELECT * FROM `events` WHERE `id` = ?');
$response->execute(array($_GET['id']));
$comments = $bdd->prepare('SELECT * FROM `comments` WHERE `event` = ?');
$comments->execute(array($_GET['id']));
$emails = $bdd->prepare('SELECT * FROM `users` WHERE `id` = ?')
?>

<section class="events-container">

<!--    VIEW EVENT>>>    -->
<?php
$data = $response->fetch();
$dataForUsername = $bdd->prepare('SELECT * FROM `users` WHERE id =?');
$dataForUsername->execute(array($data['username']));
$rawusername = $dataForUsername->fetch();
$username = $rawusername['username'];
$description = $Parsedown->text($data['description']);
$eventAuthor = $data['username'];
echo '<article class="event-entry">
    <p class="event-cat">'. $data['category'] .'</p>
    <h3 class="event-title">' . $data['title'] . '</h3>
    <p class="event-date">' . $data['date'] .'</p>
    <p class="event-author"> Organized by ' . $username . '</p>
    <img class="ev-img" src="' . $stupidroot . $data['image'] . '" alt="Image not found">
    <p class="event-description">' . $description . '</p>';
?>
        
<!--    FIN DE : VIEW EVENT-->

<!--    DELETE/EDIT EVENT>>> -->
<?php if (isset($_SESSION['id']) and ($_SESSION['id'] == $eventAuthor)) {
    echo '<form action="editevent.php" method="POST">
    <input class="hidden" type="number" name="edit_id" value="' . $_GET['id'] . '" />
    <input type="submit" value="Edit Event" />
</form>' . '<form action="deleteevent.php" method="POST">
        <input class="hidden" type="number" name="delete_id" value="' . $_GET['id'] . '" />
        <input type="submit" value="Delete Event" />
    </form>';
} ?>
<!--    <<<DELETE EDIT EVENT -->

</article>

<!--    ADD COMMENT>>> -->
<?php if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    ?>
<div>
    <h2>Leave a comment</h2>
    <form action="addcomment.php" method="POST">
        <input type="text" name="comment" required>
        <input class="hidden" type="text" name="username" value="<?=$user?>">
        <input class="hidden" type="number" name="event" value="<?=$_GET['id']?>">
        <input type="submit" value="Post comment">
    </form>
</div>
<?php }; ?>
<!--    <<<ADD COMMENT -->

<!-- COMMENTS>>> -->
<div>
    <h3>Comments :</h3>
<?php
while ($data2 = $comments->fetch()) {
    $emails->execute(array($data2['username']));
    $emailraw = $emails->fetch();
    $email = $emailraw['mail'];
    $size = 50;
    $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . "&s=" . $size;
    ?>
    <img class="gravatar" src="<?php echo $grav_url; ?>" alt="" />
    <p><?=$data2['comment']?> - <i><?=$username?></i></p>
<?php } ?>
</div>
<!--    <<<COMMENTS -->

</section>

<?php require(PHP . '/footer.php'); ?>