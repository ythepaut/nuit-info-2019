<!DOCTYPE html>
<html lang="fr">

<?php include("./includes/pages/header.php"); ?>

<body id="inscription" class="wrap">
	<div id="navigation">
		<div>
			<a href="/">
				<img src="<?php echo(getSrc("./resources/img/arrow_left2.svg")); ?>" alt="">
				<p>Retour</p>
			</a>
		</div>
		<div></div>
	</div>
	<div class="wrap-inscription">
		<h1>Enchanté !</h1>
		<form action="">
			<div>
				<input type="text" placeholder="Nom">
				<input type="text" placeholder="Prénom">
			</div>
			<input type="email" placeholder="Adresse Mail">
			<input type="password" placeholder="Mot de Passe">
			<input type="submit" value="S'inscrire">
		</form>
		
	</div>
	

	<script src="<?php echo(getSrc("./js/libs/jquery.js")); ?>"></script>

</body>

</html>