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
		<h1>Ressources</h1>
		<ul>
			<li id="aides-financieres">Aides financières</li>
			<li id="aides-sociales">Aides sociales</li>
			<li id="medecine">Médecine</li>
			<li id="handicap">Handicap</li>
			<li id="etudiants-etrangers">Etudiants étrangers</li>
			<li id="sport">Sport/Culture</li>
		</ul>
		<div class="list-container">
			<div class="list-element aides-financieres">
				<div>
					<h2>APL</h2>
					<p>L’aide personnalisée au logement est une aide fournie aux étudiants comme aux alternants. Ils y ont droit pour les aider à prendre en charge une partie de leur loyer.</p>
				</div>
				<div>
					<a href="http://www.caf.fr/allocataires/droits-et-prestations/s-informer-sur-les-aides/logement-et-cadre-de-vie/les-aides-au-logement"><img src="<?php echo(getSrc("./resources/img/img/plus.svg")); ?>" alt="Afficher plus d'informations"></a>
				</div>
			</div>
			<div class="list-element aides-financieres">
				<div>
					<h2>APL</h2>
					<p>L’aide personnalisée au logement est une aide fournie aux étudiants comme aux alternants. Ils y ont droit pour les aider à prendre en charge une partie de leur loyer.</p>
				</div>
				<div>
					<a href="http://www.caf.fr/allocataires/droits-et-prestations/s-informer-sur-les-aides/logement-et-cadre-de-vie/les-aides-au-logement"><img src="<?php echo(getSrc("./resources/img/img/plus.svg")); ?>" alt="Afficher plus d'informations"></a>
				</div>
			</div>
			<div class="list-element aides-financieres">
				<div>
					<h2>LOCA PASS</h2>
					<p>Loca Pass est un système de caution gratuite qui a pour but de prendre en charge les impayés de loyers à la place de l’occupant.</p>
				</div>
				<div>
					<a href="https://www.actionlogement.fr/l-avance-loca-pass"><img src="<?php echo(getSrc("./resources/img/img/plus.svg")); ?>" alt="Afficher plus d'informations"></a>
				</div>
			</div>
			<div class="list-element aides-financieres">
				<div>
					<h2>GARANTIE VISALE</h2>
					<p>Comme Loca Pass,  c’est également une caution locative à destination des jeunes locataires visant à couvrir les impayés de loyers.</p>
				</div>
				<div>
					<a href="https://www.visale.fr/"><img src="<?php echo(getSrc("./resources/img/img/plus.svg")); ?>" alt="Afficher plus d'informations"></a>
				</div>
			</div>
			<div class="list-element aides-financieres">
				<div>
					<h2>AIDE D’URGENCE DU CROUS</h2>
					<p>Pour les étudiants en situation critique, il existe des aides spécifiques pour répondre aux situations particulières.</p>
				</div>
				<div>
					<a href="https://www.etudiant.gouv.fr/cid96350/aides-financieres-particulieres.html"><img src="<?php echo(getSrc("./resources/img/img/plus.svg")); ?>" alt="Afficher plus d'informations"></a>
				</div>
			</div>
			<div class="list-element aides-sociales">
				<div>
					<h2>Violence Femmes Info</h2>
					<p>3919</p>
				</div>
			</div>
			<div class="list-element aides-sociales">
				<div>
					<h2>SOS Homophobie </h2>
					<p>0 810 108 135 / 01 48 06 42 41</p>
				</div>
			</div>
			<div class="list-element aides-sociales">
				<div>
					<h2>Croix-Rouge Écoute </h2>
					<p>0 800 858 858</p>
				</div>
			</div>
			<div class="list-element aides-sociales">
				<div>
					<h2>Violence Femmes Info</h2>
					<p>3919</p>
				</div>
			</div>
			<div class="list-element aides-sociales">
				<div>
					<h2>Maison départementale des personnes handicapées</h2>
					<p>01 53 32 39 39</p>
				</div>
			</div>

		</div>
	</section>

	<script src="js/libs/jquery.js"></script>
	<script>
		var i = -1;
		$(".list-element").css('opacity', '0');
		$("#aides-financieres").click(function() {
			$(".aides-financieres").css('opacity', '1');
			$(".aides-financieres").css('order', i);
			i--;
		});
		$("#aides-sociales").click(function() {
			$(".aides-sociales").css('opacity', '1');
			$(".aides-sociales").css('order', i);
			i--;
		});
		$("#medecine").click(function() {
			$(".medecine").css('opacity', '1');
			$(".medecine").css('order', i);
			i--;
		});
		$("#handicap").click(function() {
			$(".handicap").css('opacity', '1');
			$(".handicap").css('order', i);
			i--;
		});
	</script>

</body>

</html>