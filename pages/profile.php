<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Your Profile' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>
<?php
if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
	$getid = intval($_SESSION['id']);
	$requser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch(); ?>

<?php // GRAVATAR
	$email = $userinfo['mail'];
	$size = 150;
	$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . "&s=" . $size;
?>

<div style="display: grid; grid-template-columns: 1fr 1fr; margin: auto; text-align: left;">
	<div>
		<img class="gravatar" src="<?php echo $grav_url; ?>" alt="" />
	
		<h2>
			<?php echo $userinfo['username']; ?>
		</h2>
	
		<p>
			username = <?php echo $userinfo['username']; ?>
		</p>
	
		<p>
			E-mail = <?php echo $userinfo['mail']; ?>
		</p>
	
		<?php
			if (isset($_SESSION['id']) and $userinfo['id'] == $_SESSION['id'])
			{
		?>
	
		<p>
			<a href="editprofile.php">Edit profile</a>
		</p>
		<p>
			<a href="logout.php">LOG OUT</a>
		</p>
	
		<form action="deleteuser.php" method="post">
			<input type="submit" value="SUPPRIMER VOTRE PROFIL" />
		</form>
		<?php
			};
		?>
	</div>

	<div>
		<div style="text-align: left;">
			Vous êtes inscrits aux événements à venir suivants :
			<ul>
				<?php
					$rows = $bdd -> prepare('SELECT COUNT(*) FROM participants, events WHERE user = ? AND event = events.id AND deleted = 0 AND date >= NOW()');
					$rows -> execute(array($_SESSION['id']));

					if ($rows -> fetchColumn() > 0)
					{
						$get_future_events = $bdd -> prepare('SELECT events.id, title, date FROM participants, events WHERE user = ? AND event = events.id AND deleted = 0 AND date >= NOW() ORDER BY date ASC');
						$get_future_events -> execute(array($_SESSION['id']));
					
						while (($future_events_results = $get_future_events -> fetch(PDO::FETCH_ASSOC)) !== false)
						{
							echo
								'<li>
									<a href="event.php?id='.$future_events_results['id'].'">'.$future_events_results['title'].'</a>
								</li>'
							;
						}
					}
					else
					{
						echo
							'Vous n\'êtes inscrit à aucun événement à venir.
							<br>
							Jetez un oeil sur notre <a href=\'../index.php\'>calendrier des événements</a>.'
						;
					}
				?>
			</ul>
		</div>

		<div style="text-align: left;">
			Vous avez participé aux événements passés suivants :
			<ul>
				<?php
					$rows = $bdd -> prepare('SELECT COUNT(*) FROM participants, events WHERE user = ? AND event = events.id AND deleted = 0 AND date < NOW()');
					$rows -> execute(array($_SESSION['id']));

					if ($rows -> fetchColumn() > 0)
					{
						$get_past_events = $bdd -> prepare('SELECT events.id, title, date FROM participants, events WHERE user = ? AND event = events.id AND deleted = 0 AND date < NOW() ORDER BY date DESC');
						$get_past_events -> execute(array($_SESSION['id']));

						while (($past_events_results = $get_past_events -> fetch(PDO::FETCH_ASSOC)) !== false)
						{
							echo
								'<li>
									<a href="event.php?id='.$past_events_results['id'].'">'.$past_events_results['title'].'</a>
								</li>'
							;
						}
					}
					else
					{
						echo
							'Vous n\'avez participé à aucun événement dans le passé.'
						;
					}
				?>
			</ul>
		</div>
	
		<div style="text-align: left;">
			Vous avez créé les événements suivants :
			<ul>
				<?php
					$rows = $bdd -> prepare('SELECT COUNT(*) FROM events WHERE username = ? AND deleted = 0');
					$rows -> execute(array($_SESSION['id']));

					if ($rows -> fetchColumn() > 0)
					{
						$get_created_events = $bdd -> prepare('SELECT id, title FROM events WHERE username = ? AND deleted = 0 ORDER BY date ASC');
						$get_created_events -> execute(array($_SESSION['id']));

						while ($created_events_results = $get_created_events -> fetch(PDO::FETCH_ASSOC))
						{
							echo
								'<li>
									<a href="event.php?id='.$created_events_results['id'].'">'.$created_events_results['title'].'</a>
								</li>'
							;
						}
					}
					else
					{
						echo
							'Vous n\'avez encore créé aucun événement.
							<br>
							<a href=\'create.php\'>Lancez-vous !</a>'
						;
					}
				?>
			</ul>
		</div>
	</div>
</div>

<?php
} ?>

<?php require('../assets/php/footer.php');?>