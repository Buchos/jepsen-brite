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

<div>
	<figure>
		<img class="gravatar" src="<?php echo $grav_url; ?>" alt="" />
	</figure>
	
	<h2>
		<?php echo $userinfo['username']; ?>
	</h2>
	
	<p>
		username = <?php echo $userinfo['username']; ?>
	</p>
	
	<p>
		E-mail = <?php echo $userinfo['mail']; ?>
	</p>
	
	<?php if (isset($_SESSION['id']) and $userinfo['id'] == $_SESSION['id']) { ?>
	
	<p>
		<a href="editprofile.php">Edit profile</a>
	</p>
	<p>
		<a href="logout.php">LOG OUT</a>
	</p>
	
	<form action="deleteuser.php" method="post">
		<input type="submit" value="SUPPRIMER VOTRE PROFIL" />
	</form>
	
	<?php }; ?>
</div>

<div>
	<?php
		$current_date = new DateTime();
		$get_events = $bdd -> prepare('SELECT title FROM participants, events WHERE user = ? AND event = events.id');
		$get_events -> execute(array($_SESSION['id']));
	?>
	
	<div>
		Vous êtes inscrits aux événements à venir suivants :
		<?php
			while ($events_results = $get_events -> fetch(PDO::FETCH_ASSOC))
			{
				foreach ($events_results as $one_event)
				{
					if ($one_event < $current_date)
					{
						echo "<li>".$one_event."</li>";
					}
				}
			}
		?>
	</div>
	
	<div>
		Vous avez participé aux événements passés suivants :
		<ul>
			<?php
				while ($events_results = $get_events -> fetch(PDO::FETCH_ASSOC))
				{
					foreach ($events_results as $one_event)
					{
						if ($one_event > $current_date)
						{
							echo "<li>".$one_event."</li>";
						}
					}
				}
			?>
		</ul>
	</div>
</div>

<div>
	Vous avez créé les événements suivants :
	<?php
		try
		{
			$get_created_event = $bdd -> prepare('SELECT title FROM events, users WHERE events.username = ? AND events.username = users.id');
			$get_created_event -> execute(array($_SESSION['id']));
			$created = $get_created_event -> fetch(PDO::FETCH_ASSOC);
		}
		catch (Exception $e)
		{
			echo "Error :".$e -> getMessage();
		}
	?>

	<ul>
		<?php
			foreach ($created as $event_created)
			{
				echo "<li>".$event_created."</li>";
			}
		?>
	</ul>
</div>

<?php
} ?>

<?php require('../assets/php/footer.php');?>