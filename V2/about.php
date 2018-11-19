<?php
ini_set('display_errors', '0');
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_USER_NOTICE);

// On charge la langue
include_once('lang/index.php');
$about = translate("about", $language);
$enroll = translate("enrollment", $language);
$interviews = translate("interviews", $language);

function twitter($a) {
	$b = $a;
	if (strlen($b) >= 15) {$b = substr($b, 0, 12)."...";}
	return '<a href="https://twitter.com/'.$a.'" target="_blank"><div class="btn twitter"><img src="/assets/img/twitter_btn.png" alt="Twitter"><p class="arobase">@'.$b.'</p></div></a><br>';
}
function interview($a) {
	global $interviews;
	if (!isset($a)) return false;
	$len = strlen($a);
	$i = 0;
	foreach ($interviews as $name => $content) {
		if (substr($name, 0, $len) == $a) {
			$i += 1;
			if ($i%2 == 0) echo "<br>- ".str_replace("'", "’", $content)."<br><br>";
			else echo "► ".str_replace("'", "\'", $content);
		}
	}
}
?>
<!DOCTYPE html>
<html lang="<?=$language?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>YouClick — <?=$about['name']?></title>
	<meta name="description" content="<?=$description0?>">
	<link rel="stylesheet" href="/assets/css/style_v2.css">
	<link rel="stylesheet" href="/assets/css/about.css">
	<link rel="icon" href="https://youclick.fr/assets/img/favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script async src="/assets/js/move.js"></script>
	<script async src="/assets/js/about.js"></script>
	<?php include('hreflang.php'); ?>
</head>
<body id="dialog_scroll">
	<?php include_once('menu.php'); ?>
	<a id="AboutUS"></a>
	<div class="box color1">
		<?php include_once('langmenu.php'); ?>
		<h1>YouClick</h1>
		<p><?=$about['description']?></p>
	</div>
	<div class="box color3">
		<h1>Staff</h1>
		<p><?=$about['description2']?></p>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>Ozachi','<?=interview('ozachi')?>','')">
			<img class="avatarimg" src="/assets/img/interview/ozachi.jpg"><h2>Ozachi</h2><p style="margin-top:-15px"><font color="#FF0000"><?=$about['admin']?></font><br><font color="#41bf41"><?=$about['dev']?></font><br><font color="#2980b9"><?=$about['cm']?></font></p>
			<?=twitter("Ozachi_")?>
		</div>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>SkywalkerFR','<?=interview('sky')?>','')">
			<img class="avatarimg" src="/assets/img/interview/skywalker.jpg"><h2>SkywalkerFR</h2><p style="margin-top:-15px"><font color="#FF0000"><?=$about['admin']?></font><br><font color="#AA0000"><?=$about['sysadmin']?></font><br><font color="#41bf41"><?=$about['dev']?></font></p>
			<?=twitter("SkywalkerFR")?>
		</div>
		<br><br><br>
		<div class="interview-class">
			<img class="avatarimg" src="/assets/img/interview/grey.jpg"><h2>Greyscales</h2><p style="margin-top:-15px;color:#E0951D;">Host</p>
			<?=twitter("greyscalesteam")?>
		</div>
		<div class="interview-class">
			<img class="avatarimg" src="/assets/img/interview/greg.jpg"><h2>Greg</h2><p style="margin-top:-15px;color:#E0951D;">Host</p>
			<?=twitter("gregjlen")?>
		</div>
		<div class="interview-class">
			<img class="avatarimg" src="/assets/img/interview/anto.jpg"><h2>Antonin</h2><p style="margin-top:-15px;color:#E0951D;">Host</p>
			<?=twitter("baccaloreal")?>
		</div>
		<br><br><br>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>AntoZzz','<?=interview('antozzz')?>','')">
			<img class="avatarimg" src="/assets/img/interview/antozzz.jpg"><h2>AntoZzz</h2><p style="margin-top:-15px"><font color="#41bf41"><?=$about['devweb']?></font></p>
			<?=twitter("AntoZzzOfficial")?>
		</div>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>Skull','','')">
			<img class="avatarimg" src="/assets/img/interview/skull.jpg"><h2>Skull</h2><p style="margin-top:-15px"><font color="#41bf41"><?=$about['devweb']?></font></p>
			<?=twitter("Basile_Bron")?>
		</div>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>Hickacou','','')">
			<img class="avatarimg" src="/assets/img/interview/hickacou.jpg"><h2>Hickacou</h2><p style="margin-top:-15px"><font color="#41bf41"><?=$about['devweb']?></font></p>
			<?=twitter("PuddingMangue")?>
		</div>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>Spyromain','','')">
			<img class="avatarimg" src="/assets/img/interview/spyromain.jpg"><h2>Spyromain</h2><p style="margin-top:-15px"><font color="#41bf41"><?=$about['devweb']?></font></p>
			<?=twitter("SpyromainTweets")?>
		</div>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/de.png\' class=\'flag\' alt=\'DE\'>Finn','<?=interview('finn')?>','')">
			<img class="avatarimg" src="/assets/img/interview/finn.jpg"><h2>Finn</h2><p style="margin-top:-15px"><font color="#41bf41"><?=$about['devyb']?></font></p>
			<?=twitter("mfinn_")?>
		</div>
		<br><br><br>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>Speed','<?=interview('speed')?>','')">
			<img class="avatarimg" src="/assets/img/interview/speed.jpg"><h2>Speed</h2><p style="margin-top:-15px"><font color="#2980b9"><?=$about['tra']?></font></p>
			<?=twitter("MatthSLS")?>
		</div>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>Alexandru','<?=interview()?>','')">
			<img class="avatarimg" src="/assets/img/interview/xely.jpg"><h2>Alexandru</h2><p style="margin-top:-15px"><font color="#2980b9"><?=$about['tra']?></font></p>
			<?=twitter("isp_alexandru")?>
		</div>
		<br>
		<div class="interview-class" onclick="Alert.render('<img src=\'/assets/img/langs/fr.png\' class=\'flag\' alt=\'FR\'>Laizrod','<?=interview('laizrod')?>','')">
			<img class="avatarimg" src="/assets/img/interview/laizrod.jpg"><h2>Laizrod</h2><p style="margin-top:-15px"><font color="#2980b9"><?=$about['cmplus']?></font></p>
			<?=twitter("Laizrod_")?>
		</div>
		<br><br><br>
		<h1><?=$about['thk']?></h1>
		<div class="interview-class">
			<img class="avatarimg" src="/assets/img/interview/lau.jpg"><h2>Lau</h2><p style="margin-top:-15px"><?=$about['designer']?></p>
			<?=twitter("Switch_Draw")?>
		</div>
		<div class="interview-class">
			<img class="avatarimg" src="/assets/img/interview/hugo.jpg"><h2>Hugo7</h2><p style="margin-top:-15px"><?=$about['maths']?></p>
			<?=twitter("HugoLand_MC")?>
		</div>
		<div class="interview-class">
			<img class="avatarimg" src="/assets/img/interview/squeezie.jpg"><h2>Squeezie</h2><p style="margin-top:-15px"><?=$about['sharer']?></p>
			<?=twitter("xSqueezie")?>
		</div>
		<div class="interview-class">
			<img class="avatarimg" src="/assets/img/interview/tarting.jpg"><h2>TartinEx</h2><p style="margin-top:-15px"><?=$about['sharer']?></p>
			<?=twitter("TartinEx")?>
		</div>
		<div class="interview-class">
			<img class="avatarimg" src="/assets/img/interview/arti.jpg"><h2>ARTISHOW</h2><p style="margin-top:-15px"><?=$about['sharer']?></p>
			<?=twitter("Artishow_A")?>
		</div>
	</div>
	<input type="submit" value="Rejoindre notre staff" onclick="location.replace('recrutement');">
	<br><br>
	<!-- Box interviews -->
	<div id="dialog_overlay" onclick="Alert.ok()" style="z-index:9999;height:99999px;"></div>
	<div id="dialog_box">
		<div id="dialog_structure">
			<div id="dialog_box_header"></div><hr style="margin:0">
			<div id="dialog_box_body" style="height:60vh;"></div>
			<div id="dialog_box_footer"></div>
		</div>
	</div>
	<!-- End -->
	<?php include_once('footer.php'); ?>
</body>
</html>	
