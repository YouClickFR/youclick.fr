<?php
if (isset($_GET['share'])) {
	include_once('lang/index.php');
	$evaluator = translate("evaluator", $language);
	$text = $evaluator['tweet0']." ".htmlspecialchars($_GET['yt']).' (https://youtu.be/'.$_GET['id'].') '.str_replace("{score}", $_GET['score'], $evaluator['tweet2']);
	header("Location: https://twitter.com/intent/tweet?text=".$text);exit;
}
if (isset($_GET['chrome'])) {
	header("Location: https://chrome.google.com/webstore/detail/youblock-clickbait-blocke/knhmojopckcibfjafjmdffhfaakobdko");
	exit;
}
if (isset($_GET['firefox'])) {
	header("Location: https://addons.mozilla.org/firefox/addon/youblock-clickbait-blocker");
	exit;
}
if (isset($_GET['twitter'])) {
	header("Location: https://twitter.com/YouClickFR");
	exit;
}
if (isset($_GET['facebook'])) {
	header("Location: https://facebook.com/YouClickFR");
	exit;
}
if (isset($_GET['youtube'])) {
	header("Location: https://www.youtube.com/channel/UCG4-fr6fM6Ryo17gP88ixhw");
	exit;
}
if (isset($_GET['discord'])) {
	header("Location: https://discord.gg/ncyA2Pm");
	exit;
}
if (isset($_GET['youblock']) || $_GET['dl'] == "extension_auto") {
	if (strstr($_SERVER['HTTP_USER_AGENT'], "Chrome") == true) {
		header("Location: https://chrome.google.com/webstore/detail/youblock-clickbait-blocke/knhmojopckcibfjafjmdffhfaakobdko");
		exit;
	}
	if (strstr($_SERVER['HTTP_USER_AGENT'], "Firefox") == true) {
		header("Location: https://addons.mozilla.org/firefox/addon/youblock-clickbait-blocker");
		exit;
	}
	header("Location: https://chrome.google.com/webstore/detail/youblock-clickbait-blocke/knhmojopckcibfjafjmdffhfaakobdko");
	exit;
}
echo '<h1>Error : The link is not available.</h1>';
?>