<?php
ini_set("display_errors", "off");
$title0 = htmlspecialchars($_POST['url']);
if (!empty($title0)) {
    $sub1 = substr($title0, 0, 32);
    if ($sub1 != "https://www.youtube.com/watch?v=") {
        $sub1 = substr($title0, 0, 21);
        if ($sub1 != "https://www.youtu.be/") {
            goto after;
        } else {
            $pieces = explode("/", $title0);
            $title0 = "https://www.youtube.com/watch?v=".$pieces[3];
        }
    }
    $title0 = file_get_contents($title0);
    $title = htmlspecialchars(preg_replace('#.*<span id="eow-title" class="watch-title" dir="ltr" title="(.*?)">.*#si','$1', $title0, 1));

    /* MAJ DETECT */
    $array = array("[", "]", " ", "(", ")", "!", "?", ".", ",", ";", "/", "\\", "-", "_", "&", "|");
    $title2 = str_replace($array, "", $title);
    $NB1 = strlen($title2);
    $title2 = ereg_replace("[^A-Z]", "", $title2);
    $NB2 = strlen($title2);    
    $pt1 = $NB2 / $NB1 * 30;

    /* INTERROGATION/EXCLAMATION */
    $title3 = strtolower($title);
    $array1 = array("je ", "tu ", "il ", "elle ", "nous ", "vous ");
    $array2 = array("troll", "prank", "challenge", "croire", "!", "?", "...");
    $array3 = array("argent", "genant", "gênant", "draguer", "ne ", "pas", "hard", "fou", "folle");
    $array4 = array("pire", "secret", "piege", "piège", "bid", "random", "funny", "surprise", "awesome", "honte", "moment", "pleur", "malaise", "mignon", "erreur", "gros", "sexe", "cyprien", "squeezie", "norman", "amixem", "ibra");
    $array5 = array("viole", "tue", "hack", "seins", "chatte", "teub", "bite", "nu ", "nue ", "a poil", "à poil", "meur", "mourir", "jamais", "impossible", "incroyable", "suce", "tape", "prostitu", "pute", "frappe", "tu dois", "omg", "omfg", "choc", "vos yeux");
    $array6 = array("ne regarde", "ne clique", "tourne mal");
    foreach ($array1 as &$value) {
        $pt2 += substr_count($title3, $value)*5;
    }
    foreach ($array2 as &$value) {
        $pt2 += substr_count($title3, $value)*10;
    }
    foreach ($array3 as &$value) {
        $pt2 += substr_count($title3, $value)*15;
    }
    foreach ($array4 as &$value) {
        $pt2 += substr_count($title3, $value)*20;
    }
    foreach ($array5 as &$value) {
        $pt2 += substr_count($title3, $value)*25;
    }
    foreach ($array6 as &$value) {
        $pt2 += substr_count($title3, $value)*30;
    }

    after:
    /* TOTAL */
    $total = $pt1+$pt2;
    if ($total > 100) {
        $total = "100%";
    } else {
        $total = round($total)."%";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>YouClick</title>
</head>
<body>
    <img class="logo" src="logo.png" />
    <ul>
        <li><a class="active" href="#home">Accueil</a></li>
        <li><a href="#eval">Évaluateur de putaclick</a></li>
        <li><a href="#2">Générateur de putaclick</a></li>
        <li><a href="#3">À propos</a></li>
    </ul>
    <div class="eval">
        <a name="eval"></a>
        <h2>Évaluateur de putaclick</h2>
        <p>L'évaluateur de putaclick est simple : collez l'URL d'une vidéo YouTube. Notre évaluateur se chargera de vérifier le niveau de putaclick du titre.</p>
        <br />
        <form action="?#eval" method="POST">
            <input class="input" name="url" type="text" value="https://www.youtube.com/watch?v=" />
            <input class="btn" type="submit" value="Évaluateur de putaclick" />
        </form>
        <br />
        <h2><?php echo $total; ?></h2>
        <p><?php echo $title; ?></p>
    </div>
</body>
</html>