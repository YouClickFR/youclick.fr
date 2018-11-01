<?php
ini_set('display_errors', '0');
ini_set('session.cookie_secure', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_USER_NOTICE);

// On charge la langue
include_once('lang/index.php');
$contact = translate("contact", $language);

$form1 = htmlspecialchars($_POST['form1']);
if ($form1 != "") {
	$result = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld52l0UAAAAAAojM_nEsHcUKkr6d_bEavXueFlN&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['HTTP_X_FORWARDED_FOR']), true);
	if ($result['success'] != 1) die("Captcha_invalid");
	$form1 = htmlspecialchars($_POST['form1']);
	$form2 = htmlspecialchars($_POST['form2']);
	$form3 = htmlspecialchars($_POST['form3']);
	$form4 = htmlspecialchars($_POST['form4']);
	$form5 = htmlspecialchars($_POST['form5']);
	file_put_contents('databases/contact.txt', date("[d/m/Y H:i,s] ").$form1."\n".$form2."\n".$form3."\n".$form4."\n".$form5."\nLocalisation : (".$form7." | ".$form8.")\n\n", FILE_APPEND);
	die($contact['thk']);
}
?>
<!DOCTYPE html>
<html lang="<?=$language?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>YouClick — Contact</title>
	<meta name="description" content="<?=$description0?>" />
	<link rel="stylesheet" href="/assets/css/style_v2.css" />
	<link rel="stylesheet" href="/assets/css/contact.css" />
	<link rel="stylesheet" href="/assets/css/lang.css" />
	<link rel="icon" href="assets/img/favicon.ico" />
	<?php include_once('hreflang.php'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script async src="assets/js/move.js"></script>
	<script>
		function fin(token) {
			$.post("contact", $("#form").serialize(), function(data) {
				alert(data);
				location.reload();
			});
		}
	</script>
</head>

<body>
	<?php include_once('menu.php'); ?>
	<?php include_once('langmenu.php'); ?>
	<div class="box color1" style="padding-top:70px;">
		<br><br><br>
		<img src="assets/img/logo.png" alt="YouClick" style="display:block;margin:0 auto;min-width:200px;width:30%;">
		<h1><?=$contact['name']?></h1>
		<p><?=$contact['description']?></p>
		<br>
		<div class="form">
			<form action="?" method="post" id="form">
				<p class="formtext"><?=$contact['fname']?><font color="#ff0000">*</font></p><input type="text" placeholder="Michel" name="form1">
				<p class="formtext"><?=$contact['lname']?></p><input type="text" placeholder="Rodriguez" name="form2">
				<p class="formtext"><?=$contact['mail']?><font color="#ff0000">*</font></p><input type="text" placeholder="michel@youclick.fr" name="form3">
				<p class="formtext"><?=$contact['twitter']?></p><input type="text" placeholder="@D4rkM1ch3L" name="form4">
				<br>
				<p class="formtext" style="width:auto;"><?=$contact['msg']?><font color="#ff0000">*</font></p>
				<textarea placeholder="<?=$contact['why']?>" name="form5"></textarea>
				<br>
				<button class="g-recaptcha" data-sitekey="6Ld52l0UAAAAAFKTKNIQKWdPsf8YB77peL1DKGX0" data-callback="fin"><?=$contact['send']?></button>
			</form>
		</div>
	</div>
	<!-- End -->
	<?php include('footer.php'); ?>
</body>
</html>