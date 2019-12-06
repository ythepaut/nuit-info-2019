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
		<form action="<?php echo(getSrc("./includes/classes/actions.php")); ?>" method="POST" class="ajax">
			<input type="text" name="register-username" placeholder="Pseudonyme">
			<input type="email" name="register-email" placeholder="Adresse Mail">
			<input type="password" name="register-password" placeholder="Mot de Passe">
            <input type="hidden" name="action" value="register" />
			<input type="submit" value="S'inscrire">
		</form>
		
	</div>
    <div id="hint_register" style="display: hidden;"></div>
	

	<script src="<?php echo(getSrc("./js/libs/jquery.js")); ?>"></script>
	<script src="<?php echo(getSrc("./js/ajax.js")); ?>"></script>

</body>

</html>