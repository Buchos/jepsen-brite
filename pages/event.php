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
	<img class="ev-img" src="' . $data['image'] . '" alt="Image not found">
	<p class="event-description">' . $description . '</p>';

    // PARTICIPER A L'EVENEMENT >>>
    // Affichage du bouton pour participer uniquement si l'utilisateur est connecté
    if (isset($_SESSION['id'])) {
        echo
            "<form method='POST'>
				<input type='submit' name='participation' value='Je participe !'>
				<br>
			</form>"
        ;

        // En appuyant sur le bouton, vérification si l'utilisateur participe déjà, sinon inscription de la participation dans la base de données
        if (isset($_POST['participation'])) {
            $participant = $_SESSION['id'];
            $event_id = $_GET['id'];

            $prepare_checking = $bdd -> prepare('SELECT COUNT(*) AS count FROM participants WHERE user = ? AND event = ?');
            $prepare_checking -> execute(array($participant, $event_id));
            $row = $prepare_checking -> fetch();
            $entry = $row['count'];
            
            if ($entry == 0) {
                $insert_participant = $bdd -> prepare('INSERT INTO participants(user, event) VALUES (?, ?)');
                $insert_participant -> execute(array($participant, $event_id));
                echo "Votre participation a été prise en compte !";
            } else {
                echo "Vous participez déjà à cet événement !";
            }
        }
    }
    // <<< PARTICIPER A L'EVENEMENT
?>
<!--    FIN DE : VIEW EVENT-->



<!--    DELETE/EDIT EVENT>>> -->
<!-- Vérif si loggué comme admin ou créateur de l'évent -->
<?php if (isset($_SESSION['username']) and $_SESSION['username'] == 'admin') {
    echo '<form action="editevent.php" method="POST">
    <input class="hidden" type="number" name="edit_id" value="' . $_GET['id'] . '" />
    <input type="submit" value="Edit Event as Admin" />
</form> <br>' . '<form action="deleteevent.php" method="POST">
        <input class="hidden" type="number" name="delete_id" value="' . $_GET['id'] . '" />
        <input type="submit" value="Delete Event as Admin" />
    </form>';
} elseif (isset($_SESSION['id']) and ($_SESSION['id'] == $eventAuthor)) {
    echo '<form action="editevent.php" method="POST">
    <input class="hidden" type="number" name="edit_id" value="' . $_GET['id'] . '" />
    <input type="submit" value="Edit Event" />
</form> <br>' . '<form action="deleteevent.php" method="POST">
        <input class="hidden" type="number" name="delete_id" value="' . $_GET['id'] . '" />
        <input type="submit" value="Delete Event" />
    </form>';
}?>


</article>

<!-- DISPLAY PARTICIPANTS >>> -->
<?php
    // Requête pour récupérer les participants d'un événement et les afficher
    $getting_participants = $bdd -> prepare('SELECT username FROM participants, users WHERE event = ? AND user = users.id');
    $getting_participants -> execute(array($_GET['id']));
?>

<div>
	<h2>
		Participants
	</h2>

	<div>
		<ul>
			<?php
                while ($display_participants = $getting_participants -> fetch(PDO::FETCH_ASSOC)) {
                    foreach ($display_participants as $one_participant) {
                        echo
                            '<li>'.$one_participant.'</li>
							<br>'
                        ;
                    }
                }
            ?>
		</ul>
	</div>
</div>
<!-- <<< DISPLAY PARTICIPANTS -->

<!--    ADD COMMENT>>> -->
<?php if (isset($_SESSION['id'])) {
                $user = $_SESSION['id']; ?>
<div>
	<h2>Leave a comment</h2>
	<form action="addcomment.php" method="POST">
		<input type="text" name="comment" required>
		<input class="hidden" type="text" name="username" value="<?=$user?>">
		<input class="hidden" type="number" name="event" value="<?=$_GET['id']?>">
		<input type="submit" value="Post comment">
	</form>
</div>
<?php
            }; ?>

<!-- COMMENTS>>> -->
<div>
	<h3>Comments :</h3>
<?php
while ($data2 = $comments->fetch()) {
                $findCommentUsername = $bdd->prepare('SELECT * FROM `users` WHERE id =? AND deleted = 0');
                $dataForUsername->execute(array($data2['username']));
                $commentUsername = $dataForUsername->fetch();
                $commentAuthor = $commentUsername['username'];
                $emails->execute(array($data2['username']));
                $emailraw = $emails->fetch();
                $email = $emailraw['mail'];
                $size = 50;
                $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . "&s=" . $size; ?>
    <img class="gravatar" src="<?php echo $grav_url; ?>" alt="" />
    <p><?=$data2['comment']?> - <i><?=$commentAuthor?></i></p>
    <?php if ($_SESSION['username'] == 'admin') {
                    echo '<form action="deletecomment.php" method="POST">
        <input class="hidden" type="number" name="delete_id" value="' . $_GET['id'] . '" />
        <input type="submit" value="Delete Comment as Admin" />
    </form>
    <br>';
                } ?>
<?php
            }
    ?>
    
</div>
<!--    <<<COMMENTS -->

</section>

<?php require(PHP . '/footer.php'); ?>