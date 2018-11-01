<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>YouClick</title>
		<link rel="stylesheet" href="assets/css/style.css" />
		<link rel="icon" href="assets/img/favicon.ico" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script async src="assets/js/move.js"></script>
	</head>
	<body>
		<div id="menu">
			<ul>
				<li style="float:left;"><a class="accueilMenu" href="#Accueil">ACCUEIL</a></li>
				<li style="float:left;"><a href="#Evaluer">Évaluateur de putaclic</a></li>
				<li style="float:left;"><a href="#Top5">Top 5 </a></li>
				<li style="float:left;"><a href="#Achievements">Les succès</a></li>
				<li style="float:right;"><a href="#AboutUS">À propos</a></li>
			</ul>
		</div>
		<a style="position:absolute; top:-52px;" id="Accueil"></a>
		<div id="backgroundLogo">
			<a href="#Evaluer"><img id="Logo" src="assets/img/logo.png"></a>
			<br>
			<a href="#Evaluer"><img style="margin: auto; margin-top: 3%;max-width: 100%;height: auto;" src="assets/img/scroll-down.png"></a>
		</div>
		<div style="height:0px;"></div>
		<a id="Evaluer"></a>
		<div style="height:10px;"></div>
		<div class="box">
			<h2>Évaluateur de putaclic</h2>
			<p>L'évaluateur de putaclic est simple : collez l'URL d'une vidéo YouTube. Notre évaluateur se chargera de vérifier le niveau de putaclic du titre.</p>
			<h3><font color="#FF0000">*Veuillez uniquement analyser des vidéos FRANÇAISES !</font></h3>
			<br>
			<form action="?#Evaluer" method="POST">
				<input class="input" name="videoURL" type="url" autocomplete="off" spellcheck="false" maxlength="43" required="true" placeholder="Mettez ici le lien de la vidéo à évaluer..."/>
				<input class="btn" type="submit" value="Évaluer le niveau de putaclic !"/>
				<br>
			</form>
			<br>
			<?php
				$systemTimeStart = microtime(true);
				// Clé API :
				$apiKEY = '';
				$videoURL = htmlspecialchars($_POST['videoURL']);

				// On vérifie que le formulaire a bien été rempli
				if (!empty($videoURL)){
					$videoID = substr($videoURL, -11);
					$videoJSON	= file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$videoID.'&key='.$apiKEY.'&fields=items(id,snippet(channelId,channelTitle,title,tags,description,thumbnails(standard(url))),statistics)&part=snippet,statistics');
					$videoJSON = json_decode($videoJSON, true);

					// On vérifie que c'est bien une vidéo youtube
					if ($videoID == $videoJSON["items"][0]["id"]){

						// On stock les infos de la vidéo
						$videoTITRE  = $videoJSON["items"][0]["snippet"]["title"];
						$videoAUTEUR = $videoJSON["items"][0]["snippet"]["channelTitle"];
						$videoMINIA  = 'http://img.youtube.com/vi/'.$videoID.'/mqdefault.jpg';

						// === Algo sur les MAJUSCULES DANS LE TITRE ===
						// On supprime les accents ambiguës pour le php
						$longueurTITRE = strlen($videoTITRE);
						$algoTITRE = $videoTITRE;
						$algoTITRE = preg_replace('#œ|Œ|ç|Ç|è|è|é|é|ê|ë|È|É|Ê|Ë|à|á|â|ã|ä|å|À|Á|Â|Ã|Ä|Å|ì|í|î|ï|Ì|Í|Î|Ï|ð|ò|ó|ô|õ|ö|Ò|Ó|Ô|Õ|Ö|ù|ú|û|ü|Ù|Ú|Û|Ü|ý|ÿ|Ý#','', $algoTITRE);

						// On compare les MAJS et les MINS
						$NBmaj = strlen(preg_replace('#[^A-Z]*#', '', $algoTITRE));
						$algoLONGUEURLETTRES = strlen(preg_replace('#[^A-z]*#', '', $algoTITRE));
						$detect0 = round($NBmaj/$algoLONGUEURLETTRES*100);
						if ($detect0 < 21) {$detect0 = 0;}
						$pt1 = round($detect0/3);

						// Suppression des caractères accentués et des majuscules
						$algoTITRE = strtolower($videoTITRE);
						$algoTITRE = preg_replace('#œ|Œ#',                    'oe', $algoTITRE);
						$algoTITRE = preg_replace('#ç|Ç#',                     'c', $algoTITRE); 
						$algoTITRE = preg_replace('#è|è|é|é|ê|ë|È|É|Ê|Ë#',     'e', $algoTITRE);
						$algoTITRE = preg_replace('#à|á|â|ã|ä|å|À|Á|Â|Ã|Ä|Å#', 'a', $algoTITRE); 
						$algoTITRE = preg_replace('#ì|í|î|ï|Ì|Í|Î|Ï#',         'i', $algoTITRE);
						$algoTITRE = preg_replace('#ð|ò|ó|ô|õ|ö|Ò|Ó|Ô|Õ|Ö#',   'o', $algoTITRE);
						$algoTITRE = preg_replace('#ù|ú|û|ü|Ù|Ú|Û|Ü#',         'u', $algoTITRE);
						$algoTITRE = preg_replace('#ý|ÿ|Ý#',                   'y', $algoTITRE);

						/* Émotions */
						$array1 = array("...", "?", "!", "?!", "!?");
						
						/* Personnel et négations */
						$array2 = array("moi ", "il ", "elle ", "je suis", "je fais", "je me", "je le", "je ne suis", "ne ", "je suis", "je donne", "je vous", "j'ouvre", "venez", "j'ai", "je vole", "j'essaye", "je test", "il se", "croire", "ma vie", "frere", "soeur", "mere", "pere", "gens", "kikoo");

						/* Concepts aguicheurs */
						$array3 = array("troll", "prank", "challenge", "clash", "hard", "secret", "dossier", "piege", "pieg", "surprise", "erreur", "bid", "money", "youtube", "achet", "achat", "rekt", "funny", "random", "reaction", "accuse", "en vrai", "unboxing", "best of", "canular", "top", "compilation", "challenge", "hd", "cout", "argent", "fric", "experience", "reagi", "vlog", "defi", "fake", "easter egg", "easteregg", "hand spinner", "salaire", "budget", "€", "$", "💵", "fail", "coincidence", " vs ", "pas rire");

						/* Adjectifs */
						$array4 = array("pire", "mal", "en plein", "honte", "probl", "fou", "ouf", "folle", "scandale", "moment", "vraiment", "malais", "mignon", "gros", "enorm", "geant", "antesque", "impossible", "incroyable", "flippant", "epic", "epiq", "meilleur", "jamais", "nial", "niaux", "cool", "etrang", "pret", "danger", "emouv", "degue", "degou", "chelou", "haut", "fun", "trop", "fort", "plus", "dingue", "mito");

						/* Choquant */
						$array5 = array("defonc", "taser", "hack", "meur", "mourir", "peur", "agress", "danger", "echapp", "trahison", "tape", "frappe", "omg", "omfg", "wow", "wtf", "choc", "choqu", "vos yeux", "mes yeux", "police", "flic", "pls", "dispute", "drogue", "😱", ":o", "pleur", "pirate", "hack", "ddos", "boot", "mort", "crime", "crash", "otage", "arme", "suicide", "tue", "cheat", "rage", "bloque", "alligator", "risque", "survi", "saigne", "alcool", "superpouvoir", "super pouvoir", "swatting", "swating", "swat", "virus", "braqu", "cocaine", "casse", "accuse", "emeute", "manifestation");

						/* putaclic pur */
						$array6 = array("ne regarde", "ne clique", "ne pas clique", "vous devez", "tourne mal", "mal tourn", "la fin", "j'arrete", "essay", "l'aise", "hack", "racket", "ban ", "bannir", "rat", "trojan", "pirate", "cambriol", "⛔", "gueule", "hallucine", "hard", "satisfai", "fumigene", "mal a l'aise", "enerve", "vole", "rester", "enferme", "mytho", "sur ce", "sur cette", "soumettre", "ce que", "jamais", "revelation", "a voir", "gratuit", "chance", "extrem", "triche", "devez", "dois", "clic", "clik", "clique");

						/* Sexe */
						$array7 = array("-18", "porn", "branl", "masturb", "gemi", "sexe", "viole", "seins", "boobs", "chatte", "teub", "bite", " nus ", " nues ", " nu ", " nue ", "nude", "madame", " dame", "homme", "a poil", "prostitu", "pute", "amour", "galoche", "suce", "embrasser", "premiere fois", "preservatif", "baise", "draguer", "sedu", "nudiste", "aborder", "sex", "vagin", "testicule", "couille", "kiss", "drague", "pecho", " nique", "youporn", "tinder", "badoo");

						$longueurTITRE2 = $longueurTITRE;
						if ($longueurTITRE2 < 20) {$longueurTITRE2 = 20;}
						if ($longueurTITRE2 > 60) {$longueurTITRE2 = 60;}
						// Algo sur les mots clés
						foreach ($array1 as &$value) {
							$pt2 += substr_count($algoTITRE, $value)*10/($longueurTITRE2/25);
							if (substr_count($algoTITRE, $value) > 0) {$detect1 += strlen($value)*substr_count($algoTITRE, $value);}
						}						
						foreach ($array2 as &$value) {
							$pt2 += substr_count($algoTITRE, $value)*20/($longueurTITRE2/25);
							if (substr_count($algoTITRE, $value) > 0) {$detect2 += strlen($value)*substr_count($algoTITRE, $value);}
						}
						foreach ($array3 as &$value) {
							$pt2 += substr_count($algoTITRE, $value)*30/($longueurTITRE2/25);
							if (substr_count($algoTITRE, $value) > 0) {$detect3 += strlen($value)*substr_count($algoTITRE, $value);}
						}
						foreach ($array4 as &$value) {
							$pt2 += substr_count($algoTITRE, $value)*40/($longueurTITRE2/25);
							if (substr_count($algoTITRE, $value) > 0) {$detect4 += strlen($value)*substr_count($algoTITRE, $value);}
						}
						foreach ($array5 as &$value) {
							$pt2 += substr_count($algoTITRE, $value)*50/($longueurTITRE2/25);
							if (substr_count($algoTITRE, $value) > 0) {$detect5 += strlen($value)*substr_count($algoTITRE, $value);}
						}
						foreach ($array6 as &$value) {
							$pt2 += substr_count($algoTITRE, $value)*60/($longueurTITRE2/25);
							if (substr_count($algoTITRE, $value) > 0) {$detect6 += strlen($value)*substr_count($algoTITRE, $value);}
						}
						foreach ($array7 as &$value) {
							$pt2 += substr_count($algoTITRE, $value)*70/($longueurTITRE2/25);
							if (substr_count($algoTITRE, $value) > 0) {$detect7 += strlen($value)*substr_count($algoTITRE, $value);}
						}

						$detect1 = round($detect1/$longueurTITRE*100);
						$detect2 = round($detect2/$longueurTITRE*100);
						$detect3 = round($detect3/$longueurTITRE*100);
						$detect4 = round($detect4/$longueurTITRE*100);
						$detect5 = round($detect5/$longueurTITRE*100);
						$detect6 = round($detect6/$longueurTITRE*100);
						$detect7 = round($detect7/$longueurTITRE*100);

						// Calcul final
						$score = round($pt1+$pt2);

						echo '<br><a target="_blank" href="'.$videoURL.'><img class="miniature" src="http://img.youtube.com/vi/'.$videoID.'/mqdefault.jpg"/></a>';
						echo '<p style="font-size:18px;"><strong>'.$videoAUTEUR.'</strong> - <i>'.$videoTITRE.'</i></p>';

						echo "<h2>Score : ".$score."</h2><h3>Notre algorithme a détecté dans ce titre :</h3>";
						echo "<p>Majuscules abusives : ".$detect0."%</p>";
						echo "<p>Exclamatif/interrogatif : ".$detect1."%</p>";
						echo "<p>Personnel/Désignation : ".$detect2."%</p>";
						echo "<p>Concept aguicheur : ".$detect3."%</p>";
						echo "<p>Adjectifs/adverbes forts : ".$detect4."%</p>";
						echo "<p>Choquant : ".$detect5."%</p>";
						echo "<p>Clickbait pur : ".$detect6."%</p>";
						echo "<p>Allusions au sexe : ".$detect7."%</p>";

						echo "<h3>Résultat : ";

						if ($score > 399) echo "[CHOC] OMG WTF Le Saint putaclic... :o ! La vidéo putaclic suprême...";
						else if ($score > 349) echo "HO-RRI-PI-LANT ! JE  VAIS MOURIR SI TU CONTINUES !";
						else if ($score > 249) echo "HO-RRIBLE ! TU VEUX MA MORT AVEC CE GENRE DE VIDÉOS ?!";
						else if ($score > 199) echo "AAAAAAAAAAAAH ! Bah bravo avec ce putaclic extrême, j'ai envie de vomir là.";
						else if ($score > 160) echo "AAAAH ! C'est du gros putaclic pur et dur ça !";
						else if ($score > 140) echo "Bouargl, du bon gros putaclic :@";
						else if ($score > 99) echo "Beurk, plus de 100, je tiens à ma vie moi ! >:(";
						else if ($score > 70) echo "Ouch, bien putaclic ça :'(";
						else if ($score > 50) echo "Arg, on sent le putaclic :(";
						else if ($score > 30) echo "Pas très putaclic mais on s'approche... :/";
						else if ($score > 10) echo "Mmmh un petit air de putaclic au loin, mais c'est honnête :)";
						else if ($score > 0) echo "Pas du tout putaclic ! Ça fait du bien de temps en temps. :D";
						else echo "C'est beau... La pureté extrême. Aucun putaclic. Aucun. :O";

						echo "</h3>";


						// Ajout dans la base de donnée //
						// Si le fichier existe pas on le crée et on enregistre la vidéo dedans 
						if (!file_exists('data.db')){

							$arrayDATABASE[$videoID] = array($score, $videoURL, $videoID, $videoAUTEUR, $videoTITRE);
							file_put_contents('data.db', serialize($arrayDATABASE));
						
						} else {
							$arrayDATABASE = unserialize(file_get_contents('data.db'));
							// On vérifie que la vidéo n'est pas dans la base de donnée
							$videoESTDANSDB = FALSE;
							if ($videoID == $arrayDATABASE[$videoID][2]) {
								$videoESTDANSDB = TRUE;
								echo '<p><small>(Vidéo déjà testée auparavant)</small></p>';
								// Si la vidéo trouvé n'a plus le même score alors on update
								if ($arrayDATABASE[$videoID][0] !== $score) {
									unset($arrayDATABASE[$videoID]);
									$arrayDATABASE[$videoID] = array($score, $videoURL, $videoID, $videoAUTEUR, $videoTITRE);
									file_put_contents('data.db', serialize($arrayDATABASE));
								}
							}
							// Si elle y est pas on l'ajoute
							if ($videoESTDANSDB == FALSE) {
								$arrayDATABASE[$videoID] = array($score, $videoURL, $videoID, $videoAUTEUR, $videoTITRE);
								file_put_contents('data.db', serialize($arrayDATABASE));
							}
						}
					} else {
						echo "<br><h3>Euh... Il faut mettre le lien d'une vidéo youtube !</h3><br>";
					}
				}
			?>
			<a style="float:right;text-decoration: none;" href="#Evaluer"><p>Remonter</p></a>
		</div>
		<?php
			// Succès
			if ($videoESTDANSDB == FALSE) {
				if (!empty($score)) {
					$_SESSION['compteur'] += 1;
					if ($_SESSION['compteur'] == 1) $achievements = $achievements.'<h2>Succès débloqué : Première analyse d\'une vidéo</h2>';
					if ($_SESSION['compteur'] == 10) $achievements = $achievements.'<h2>Succès débloqué : 10 vidéos analysées</h2>';
					if ($_SESSION['compteur'] == 30) $achievements = $achievements.'<h2>Succès débloqué : 30 vidéos analysées</h2>';
					if ($_SESSION['compteur'] == 50) $achievements = $achievements.'<h2>Succès débloqué : 50 vidéos analysées</h2>';
					if ($_SESSION['compteur'] == 100) $achievements = $achievements.'<h2>Succès débloqué : 100 vidéos analysées</h2>';
					if (empty($_SESSION['angel'])) {
						if ($score == 0) {
							$achievements = $achievements.'<h2>Succès débloqué : Vidéo avec score de 0 !</h2></div>';
							$_SESSION['angel'] = true;
						}
					}
					if (empty($_SESSION['devil'])) {
						if ($score > 199) {
							$achievements = $achievements.'<h2>Succès débloqué : Vidéo avec score d\'au moins 200 !</h2></div>';
							$_SESSION['devil'] = true;
						}
					}
					if (empty($_SESSION['maj'])) {
						if ($detect0 == 100) {
							$achievements = $achievements.'<h2>Succès débloqué : VIDÉO EN FULL MAJUSCULES !</h2></div>';
							$_SESSION['maj'] = true;
						}
					}
					if (!empty($achievements)) echo '<div class="achievement">'.$achievements.'</div>';
				}
			}
		?>
		<a id="Top5"></a>
		<div style="height:10px;"></div>
		<div class="box">
			<h2>Top putaclic :</h2>
			<p>Ici c'est du lourd (attention à vos yeux) car est répertorié le top du putaclic de ce vous nous avez trouvé !</p>
			<br>
			<?php 
				if (file_exists('data.db')){
					$arrayDATABASE = unserialize(file_get_contents('data.db'));
					rsort($arrayDATABASE);
					$arrayDATABASE = array_slice($arrayDATABASE, 0, 5, TRUE);
					$videoTOP = 0;
					// Pour chaque sous array (sous array = une vidéo) on met les infos dans des variables et on les affiche (et on incrémente la variable pour le top)
					foreach($arrayDATABASE as $arraySECOND){
						$videoTOP++;
						$videoSCORE  = $arraySECOND[0];
						$videoURL    = $arraySECOND[1];
						$videoID     = $arraySECOND[2];
						$videoAUTEUR = $arraySECOND[3];
						$videoTITRE  = $arraySECOND[4];
						if ($videoTOP < 4) {
							echo '<h3><img style="vertical-align:middle; height:35px;" src="assets/img/'.$videoTOP.'.png"/> TOP '.$videoTOP.' <img style="vertical-align:middle; height:35px;" src="assets/img/'.$videoTOP.'.png"/></h3>';
						} else {
							echo '<h3>TOP '.$videoTOP.'</h3>';
						}
						echo '<a target="_blank" href="'.$videoURL.'"><img class="miniature" src="http://img.youtube.com/vi/'.$videoID.'/mqdefault.jpg"></a><p style="font-size:18px;"><strong>'.$videoAUTEUR.'</strong> - <i>'.$videoTITRE.'</i></p><h2>Score : '.$videoSCORE.'</h2>';
						if ($videoTOP !== 5) echo '<br><hr><br>';
					}
				} else {
					echo "Aucune vidéo n'a été testée, le TOP 5 est vide :(";
				}
				$systemTimeStop = preg_replace('/\./', '', round(microtime(true) - $systemTimeStart, 3));
				echo "Temps d'éxecution : ".$systemTimeStop."ms<br>";
			?>

			<br>
			<br>
			<a style="float:right;text-decoration: none;" href="#Evaluer"><p>Remonter</p></a>
		</div>

		<a id="Achievements"></a>
		<div style="height:10px;"></div>

		<div class="box">
			<br>
			<h2>Les succès</h2>
			<h3>Vous pouvez obtenir des succès qui fonctionnent avec les sessions stockées sur notre serveur (Ils seront donc effacés si vous effacez les informations de notre site stockés sur votre navigateur, mais pas besoin d'inscription !). Il y a en tout 10 succès à obtenir, allant du nombre des vidéos analysées ou à leur score, leur analyse... Voici les succès que vous avez obtenus :</h3>
			<h3>Première vidéo analysée : <?php if ($_SESSION['compteur'] > 0) {echo "<font color='#06ce00'>Réussi !</font>";} else {echo "<font color='#ff0000'>Pas encore obtenu...</font>";} ?></h3>
			<h3>10e vidéo jamais entrée auparavant analysée : <?php if ($_SESSION['compteur'] > 9) {echo "<font color='#06ce00'>Réussi !</font>";} else {echo "<font color='#ff0000'>Pas encore obtenu...</font>";} ?></h3>
			<h3>30e vidéo jamais entrée auparavant analysée : <?php if ($_SESSION['compteur'] > 29) {echo "<font color='#06ce00'>Réussi !</font>";} else {echo "<font color='#ff0000'>Pas encore obtenu...</font>";} ?></h3>
			<h3>50e vidéo jamais entrée auparavant analysée : <?php if ($_SESSION['compteur'] > 49) {echo "<font color='#06ce00'>Réussi !</font>";} else {echo "<font color='#ff0000'>Pas encore obtenu...</font>";} ?></h3>
			<h3>100e vidéo jamais entrée auparavant analysée : <?php if ($_SESSION['compteur'] > 99) {echo "<font color='#06ce00'>Réussi !</font>";} else {echo "<font color='#ff0000'>Pas encore obtenu...</font>";} ?></h3>
			<h3><?php if ($_SESSION['maj'] == true) {echo "Vidéo 100% en majuscules jamais entrée auparavant analysée : <font color='#06ce00'>Réussi !</font>";} else {echo "??? : <font color='#ff0000'>Pas encore obtenu...</font>";} ?></h3>
			<h3><?php if ($_SESSION['angel'] == true) {echo "Vidéo avec 0 de score jamais entrée auparavant analysée : <font color='#06ce00'>Réussi !</font>";} else {echo "??? : <font color='#ff0000'>Pas encore obtenu...</font>";} ?></h3>
			<h3><?php if ($_SESSION['devil'] == true) {echo "Vidéo avec au moins 200 de score jamais entrée auparavant analysée : <font color='#06ce00'>Réussi !</font>";} else {echo "??? : <font color='#ff0000'>Pas encore obtenu...</font>";} ?></h3>
			<h3><?php if ($_SESSION['intop'] == true) {echo "Soon...";} else {echo "Soon...";} ?></h3>
			<h3><?php if ($_SESSION['top1'] == true) {echo "Soon...";} else {echo "Soon...";} ?></h3>
			<br>
			<a style="float:right;text-decoration: none;" href="#Evaluer"><p>Remonter</p></a>
		</div>

		<a id="AboutUS"></a>
		<div style="height:10px;"></div>

		<div class="box">
			<br>
			<h2>YouClick</h2>
			<h3>YouClick est un site créé de toutes pièces par <a target="_blank" href="https://twitter.com/Ozachi_" style="text-decoration: none;">Ozachi</a> et <a target="_blank" href="https://twitter.com/SkywalkerFR" style="text-decoration: none;">SkywalkerFR</a>. Nous avons souhaité faire ce site suite à l'amont du putaclic sur YouTube, bien trop fade à notre goût face à la représentation saine de YouTube que l'on pouvait se faire.</h3>
			<h3>Ce site pourra vous servir à analyser le niveau de putaclic d'une vidéo par un algorithme secret fait par nos soins. Des succès seront évidemment à obtenir au fur et à mesure (trouvez les tous :D !). Un top putaclic est également disponible.</h3>
			<h3>Sachez que ce site est avant tout un espace de détente et de rigolade, ne prenez pas ce travail pour une manière d'agresser ceux qui pratiquent cette méthode sur YouTube (d'autant plus après les soucis financiers publicitaires) ! Bonne visite :D</h3>
			<br>
			<h3>PS : Merci énormément à toi <a target="_blank" href="https://www.youtube.com/c/aMOODIEsqueezie" style="text-decoration: none;">Squeezie</a> d'avoir accepté, ça nous fait extrêmement plaisir ^^</h3>
			<br>
			<a style="float:right;text-decoration: none;" href="#Evaluer"><p>Remonter</p></a>
		</div>
		<br><br><br><br><br><br><br><br>
	</body>
</html>