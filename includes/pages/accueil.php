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

<body id="index">
		<div id="navigation-home" class="wrap">
			<img id="logo" src="<?php echo(getSrc("./resources/img/logo.svg")); ?>" alt="Logo Le Bon étudiant">
			<nav>
				<div>
					<a href="connexion.html"><li>Connexion</li></a>
				</div>
				<div>
					<a href="inscription.html"><li>Inscription</li></a>
				</div>
			</nav>
		</div>
		<button class="hamburger hamburger--squeeze menu_h" type="button">
				<span class="hamburger-box menu_h">
				<span class="hamburger-inner menu_h"></span>
				</span>
		</button>
		<div class="menu_js">
			<ul class="menu_ ul">
				<li><a href="#">Connexion</a></li>
				<li><a href="#">Inscription</a></li>
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
			<div>
			<img src="<?php echo(getSrc("./resources/img/arrow_left.svg")); ?>" alt="Télécharger le flyer à droite">
			<form action='./includes/classes/actions.php' method="POST">
				<input type="hidden" name="action" value="teleflyer" />
				<div style="text-align: center;">
					<input type="submit" value="Téléchargement flyer" />
				</div>
			</from>
			</div>
		</div>

	<script src="<?php echo(getSrc("./js/libs/jquery.js")); ?>"></script>
	<script src="<?php echo(getSrc("./js/menu_js.js")); ?>"></script>

</body>

</html>
