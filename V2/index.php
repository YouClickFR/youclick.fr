<?php
ini_set('display_errors', '0');
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_USER_NOTICE);

$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
$ua = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
$re = htmlspecialchars($_SERVER['HTTP_REFERER']);

// Chargement du fichier de langue adéquat
include_once('lang.php');
// On charge la langue
include_once('lang/index.php');

$index = translate("index", $language);
$evaluator = translate("evaluator", $language);
$translator = translate("translator", $language);
$top = translate("top", $language);

// RÉFÉRENCEMENT
if (strstr($ua, "bot") == true || strstr($ua, "Google") == true || strstr($ua, "crawl") == true) $bot = true;
else $bot = false;

if ($bot == true) $title = 'YouClick — '.$index['description1'];
else $title = 'YouClick';
?>
<!DOCTYPE html>
<html lang="<?=$language?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Title -->
	<title><?=$title?></title>
	<meta property="og:site_name" content="YouClick" />
	<meta property="og:title" content="YouClick" />
	<meta property="og:url" content="https://youclick.fr/" />
	<meta property="og:image" content="https://youclick.fr/assets/img/logo_360p_card.png" />

	<!-- Description -->
	<meta name="description" content="<?=$index['description0']?>" />
	<meta property="og:description" content="<?=$index['description0']?>" />

	<!-- Twitter -->
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:title" content="YouClick">
	<meta name="twitter:description" content="<?=$index['description0']?>" />
	<meta name="twitter:creator" content="YouClickFR" />
	<meta name="twitter:site" content="@YouClickFR" />
	<meta name="twitter:image" content="https://youclick.fr/assets/img/logo_360p_card.png" />

	<!-- Images/Themes -->
	<meta name="msapplication-TileImage" content="https://youclick.fr/assets/img/logo_360p_card.png">
	<meta name="theme-color" content="#E61818" />
	<link rel="icon" href="/assets/img/favicon.ico" />

	<meta name="keywords" content="youclick putaclic clickbait youtube evaluateur evaluator evaluador auswertung youtuber youtubeur top squeezie tartinex アナライザ クリックベイト トップ" />
	<link rel="stylesheet" href="/assets/css/style_v2.css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>

	<meta name="google-site-verification" content="mepwUJZffrB0kVxeG7Me-BZvO-y7ty5W9imFHtrWJu4" />
	<script>
		var language = "<?=$language?>";
		var plsurl = "<?=$evaluator['plsurl']?>";
		var plsvideo = "<?=$evaluator['plsvideo']?>";
	</script>
	<script async src="/assets/js/move.js"></script>
	<script async src="/assets/js/evaluator.js"></script>
	<?php include('hreflang.php'); ?>
</head>
<body>
	<?php include_once('menu.php'); ?>
	<!-- JavaScript detection -->
	<noscript><div id="javascript"><div style="color:white;font-size:40px;width:85%;margin-left:7%;text-align:center;"><?=$index['error0']?></div></div></noscript>
	<div id="backgroundLogo">
		<?php include_once('langmenu.php'); ?>
		<img id="Logo" src="/assets/img/logo_hd.png" alt="YouClick">
	</div>
	<a id="Home"></a>
	<div class="box color1">
		<h1><?=$index['welcome']?></h1>
		<p><?=$index['quote']?></p>
<?php
	// Detect browser and advertise extension
	if (strstr($_SERVER['HTTP_USER_AGENT'], "Chrome") == true) {echo '<a href="extern?chrome" target="_blank"><div class="btn chrome"><img src="/assets/img/chrome_btn.png"  alt=""><p>'.$index['extension'].'</p></div></a>';}
	else if (strstr($_SERVER['HTTP_USER_AGENT'], "Firefox") == true) {echo '<a href="extern?firefox" target="_blank"><div class="btn firefox"><img src="/assets/img/firefox_btn.png"  alt=""><p>'.$index['extension'].'</p></div></a>';}
	else {echo '<a href="extern?chrome" target="_blank"><div class="btn chrome"><img src="/assets/img/chrome_btn.png"  alt=""><p>'.$index['extension'].'</p></div></a>&nbsp;<a href="extern?firefox" target="_blank"><div class="btn firefox"><img src="/assets/img/firefox_btn.png"  alt=""><p>'.$index['extension'].'</p></div></a>';}
?>
		<br>
		<a href="extern?facebook" target="_blank"><div class="btn facebook"><img src="/assets/img/facebook_btn.png" alt=""><p><?=$index['facebook']?></p></div></a>
		<a href="extern?twitter" target="_blank"><div class="btn twitter"><img src="/assets/img/twitter_btn.png" alt=""><p><?=$index['twitter']?></p></div></a>
		<a href="extern?discord" target="_blank"><div class="btn discord"><img src="/assets/img/discord_btn.png" alt=""><p><?=$index['discord']?></p></div></a>
	</div>
	<a id="Evaluer"></a>
	<div class="box color2">
		<img style="position:absolute;left:1%;transform:rotate(90deg);width:8%;height:auto;" src="/assets/img/redarrow.png" alt="" onclick="location.replace('?party');">
		<h1><?=$evaluator['name']?></h1>
		<p><?=$evaluator['description']?></p>
		<br>
		<div id="formidable">
			<div id="error" style="display:none;">
				<div class="error-tip"></div>
				<div class="error-arrow"></div>
			</div>
			<input id="url" type="text" class="text" autocomplete="off" spellcheck="false" maxlength="43" placeholder="https://youtu.be/KmUSvblT4II" onclick="$('#error').hide('fast');" onkeypress="if (event.keyCode == 13) analyze();" />
			<input type="button" value="<?=$evaluator['evalue']?>" onclick="analyze();" />
			<br>
		</div>
		<div id="load" style="display:none;">
			<img src="/assets/img/spinner.gif" /><br>
			<div class="tips" style="font-weight: 700;"><?=$evaluator['error1']?></div>
			<br>
		</div>
		<div id="result" style="padding-top:35px;display:none"></div>

<?php
// Show ads only is the user is not a bot
if ($bot == false) {
?>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<ins class="adsbygoogle" style="display:block;min-width:0px;max-width:900px;width:100%;height:90px;margin:auto" data-ad-client="ca-pub-3442302031393170" data-ad-slot="3005397649"></ins>
		<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<?php
}
?>

		<p class="analyses-box color3" style="position:absolute;width:20%;left:40%;padding:12px 0px 12px 0px;margin-top:34px;display:inline-block;"><?=str_replace("<b>0", '<b id="c_analyze">'.number_format(file_get_contents('nombreVideo.txt'), 0, ',', ' '), $index['analyzes'])?></p>
	</div>
	<a id="Top5"></a>
	<div id="top" class="box color3">
		<h1 class="toptop1"><?=$top['top1']?> | <span style="color:#dd0000;font-weight:700;text-decoration:underline;cursor:pointer;" onclick="topchange('toujours')"><?=$top['always']?></span></h1>
		<h1 class="toptop2" style="display:none;"><?=$top['top2']?> | <span style="color:#dd0000;font-weight:700;text-decoration:underline;cursor:pointer;" onclick="topchange('semaine')"><?=$top['week']?></span></h1><br>
		<img style="position:absolute;right:1%;transform:rotate(-10deg);width:8%;height:auto;" src="/assets/img/shock.png" alt="">
		<div id="topvideos">
			<?php include_once('top.php'); ?>
		</div>
	</div>
	<div id="topytb" class="box color2">
		<?php include_once('topytb.php'); ?>
	</div>
	<?php include_once('footer.php'); ?>
</body>
</html>