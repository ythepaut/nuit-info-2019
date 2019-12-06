<!DOCTYPE html>
<html lang="fr">

<?php include("./includes/pages/header.php"); ?>

<body id="connexion" class="wrap">
	<div id="navigation">
		<div>
			<a href="/">
            <img src="<?php echo(getSrc("./resources/img/arrow_left2.svg")); ?>" alt="">
				<p>Retour</p>
			</a>
		</div>
		<div></div>
	</div>
	<div class="wrap-connexion">
		<h1>Rebonjour !</h1>
		<form action="<?php echo(getSrc("./includes/classes/actions.php")); ?>" class="ajax">
			<input type="email" placeholder="Adresse Mail">
			<input type="password" placeholder="Mot de Passe">
			<input type="submit" value="Se connecter">
		<form action="#">
            <p>Mot de passe oublié ?</p>
        </form>
	</div>
	

	<script src="<?php echo(getSrc("./js/libs/jquery.js")); ?>"></script>

</body>

</html>