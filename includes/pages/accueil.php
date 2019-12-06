<!--
<h2><?php echo(($_SESSION["blindMode"]) ? true : false);?></h2>

<form action='./includes/classes/actions.php' method="POST"> 
    <input type="hidden" name="action" value="blind-mode" />
    <div style="text-align: center;">
        <input type="submit" value="Mode Aveugle" />
    </div>
</from>
-->

<!DOCTYPE html>
<html lang="fr">

<?php include("./includes/pages/header.php"); ?>

<body id="index" class="wrap">
		<div id="navigation-home">
			<img id="logo" src="<?php echo(getSrc("./resources/img/logo.svg")); ?>" alt="Logo Le Bon étudiant">
			<nav>
				<div>
					<li>Connexion</li>
				</div>
				<div>
					<li>Inscription</li>
				</div>
			</nav>
		</div>
		<div id="selection" class="wrap-home">
			<div>
				<img src="<?php echo(getSrc("./resources/img/arrow_left.svg")); ?>" alt="Ressources à droite">
				<a href="/ressources"><p>Ressources</p></a>
			</div>
			<div>
				<img src="<?php echo(getSrc("./resources/img/arrow_left.svg")); ?>" alt="Services à droite">
				<a href="/services"><p>Services</p></a>
			</div>
			<div>
				<img src="<?php echo(getSrc("./resources/img/arrow_left.svg")); ?>" alt="Jobs à droite">
				<a href="/jobs"><p>Jobs</p></a>
			</div>
		</div>

	<script src="<?php echo(getSrc("./js/libs/jquery.js")); ?>"></script>

</body>

</html>