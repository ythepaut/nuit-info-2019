<!DOCTYPE html>
<html lang="fr">

<?php include("./includes/pages/header.php"); ?>

<body id="ressources" class="wrap">
		<div id="navigation">
			<div>
				<a href="/">
					<img src="<?php echo(getSrc("./resources/img/arrow_left.svg")); ?>" alt="Retour à la page précédente">
					<p>Retour</p>
				</a>
			</div>
			<div>
				<p>Mon compte</p>
				<img src="<?php echo(getSrc("./resources/img/icon_compte.svg")); ?>" alt="Accéder à mon compte">
			</div>

		</div>
	<section class="wrap-content">
		<h1>Jobs</h1>
		<ul>
			<li>Aides financières</li>
			<li>Aides sociales</li>
			<li>Médecine</li>
			<li>Handicap</li>
			<li>Etudiants étrangers</li>
			<li>Sport/Culture</li>
		</ul>
		<div class="list-container">
		<div class="list-container">
			<?php jobsList($connection); ?>
		</div>
	</section>

	<script src="<?php echo(getSrc("./js/libs/jquery.js")); ?>"></script>

</body>

</html>