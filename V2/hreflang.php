<?php
$bpage = substr($_SERVER['PHP_SELF'], 0, -4);
if ($bpage == "/index") $bpage = "/";
if (substr($bpage, -1) == ".") $bpage = substr($bpage, 0, -1);
$bpage = htmlspecialchars($bpage);
?>
<link rel="alternate" hreflang="fr" href="https://youclick.fr<?=$bpage?>?lang=fr" />
	<link rel="alternate" hreflang="en" href="https://youclick.fr<?=$bpage?>?lang=en" />
	<link rel="alternate" hreflang="es" href="https://youclick.fr<?=$bpage?>?lang=es" />
	<link rel="alternate" hreflang="de" href="https://youclick.fr<?=$bpage?>?lang=de" />
	<link rel="alternate" hreflang="ro" href="https://youclick.fr<?=$bpage?>?lang=ro" />
	<link rel="alternate" hreflang="x-default" href="https://youclick.fr<?=$bpage?>" />
