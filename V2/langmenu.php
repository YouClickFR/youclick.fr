<?php
$bpage = $_SERVER['PHP_SELF'];
if ($bpage == "/index.php") $bpage = "/";
if (substr($bpage, -4) == ".php") $bpage = substr($bpage, 0, -4);
$bpage = htmlspecialchars($bpage);
?><link rel="stylesheet" href="/assets/css/lang.css" />
		<div class="langage_button_structure">
			<div class="langage_button_princ" style="background-image: url(./assets/img/langs/<?=$language?>.png);"></div>
			<div class="langage_button-content">
		<?php if ($language != "fr") { ?>
		<a href="https://youclick.fr<?=$bpage?>?lang=fr" class="langage_button lang-fr"></a>
		<?php } if ($language != "en") { ?>
		<a href="https://youclick.fr<?=$bpage?>?lang=en" class="langage_button lang-en"></a>
		<?php } if ($language != "de") { ?>
		<a href="https://youclick.fr<?=$bpage?>?lang=de" class="langage_button lang-de"></a>
		<?php } if ($language != "es") { ?>
		<a href="https://youclick.fr<?=$bpage?>?lang=es" class="langage_button lang-es"></a>
		<?php } if ($language != "ro") { ?>
		<a href="https://youclick.fr<?=$bpage?>?lang=ro" class="langage_button lang-ro"></a>
<?php } ?>
			</div>
		</div>
