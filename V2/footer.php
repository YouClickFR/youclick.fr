<footer id="footer">
<?php
include_once('lang/index.php');
$footer = translate("footer", $language);
?>
    <link rel="stylesheet" href="/assets/css/footer.css" />
	<div id="respLanguageSelection">
	<ul>
	<li><a href="?lang=fr"><img src="/assets/img/fr.png" alt="FR" width=25 /></a></li>
	<li><a href="?lang=en"><img src="/assets/img/en.png" alt="EN" width=25 /></a></li>
	<li><a href="?lang=de"><img src="/assets/img/de.png" alt="DE" width=25 /></a></li>
	<li><a href="?lang=es"><img src="/assets/img/es.png" alt="ES" width=25 /></a></li>
	<li><a href="?lang=ro"><img src="/assets/img/ro.png" alt="RO" width=25 /></a></li>
	</ul>
	</div>
	<div id="flex">
	<div id="language" class="boxFlex">
	<h2><?=$footer['cat0']?></h2>
	<ul id="languageSelection">
	<li><a href="?lang=fr"><img src="/assets/img/langs/fr.png" alt="FR" width=25 />Français</a></li>
	<li><a href="?lang=en"><img src="/assets/img/langs/en.png" alt="EN" width=25/>English</a></li>
	<li><a href="?lang=de"><img src="/assets/img/langs/de.png" alt="DE" width=25/>Deutsch</a></li>
	<li><a href="?lang=es"><img src="/assets/img/langs/es.png" alt="ES" width=25/>Español</a></li>
	<li><a href="?lang=ro"><img src="/assets/img/langs/ro.png" alt="RO" width=25 />Română</a></li>
</ul>	
</div>
<br>
<div id="links" class="boxFlex">
	<h2>YouClick</h2>
	<ul>
	<li><a style="color:white;" href="https://youclick.fr/api">API</a></li>
	<li><a style="color:white;" href="https://youclick.fr/contact"><?=$footer['contact']?></a></li>
	<li><a style="color:white;" href="https://youclick.fr/translator"><?=$footer['link2']?></a></li>
	<li><a style="color:white;" href="https://youclick.fr/about#Enrollment"><?=$footer['enrollment']?></a></li>
	<li><a style="color:white;" href="https://youclick.fr/mentions_legales"><?=$footer['tos']?></a></li>
	</ul>
</div>
<div id="social" class="boxFlex">
	<h2><?=$footer['cat2']?></h2>
	<ul>
		<li id="fb"><a href="https://youclick.fr/extern?facebook" target="_blank"><img width=25 src="/assets/img/facebook_btn.png" /></a></li>
		<li id="tw"><a href="https://youclick.fr/extern?twitter" target="_blank"><img width=25 src="/assets/img/twitter_btn.png" /></a></li>
		<li id="ds"><a href="https://youclick.fr/extern?discord" target="_blank"><img width=25 src="/assets/img/discord_btn.png" /></a></li>
		<li id="yt"><a href="https://youclick.fr/extern?youtube" target="_blank"><img width=25 src="/assets/img/yt_btn.png" /></a></li>
	</ul>
</div>
</div>
<div id="footerText"><p style="display:inline-block;width:80%;padding:18px;"><?=$footer['description']?> © YouClick 2017-2018&nbsp;</p></div>
</footer>
