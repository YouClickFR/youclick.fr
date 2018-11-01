<?php
// On charge la langue
include_once('lang/index.php');
$slot = translate("menu", $language);
?>
<div id="menu">
	<a href="<?php if ($self != "/index.php"){echo '/';} else {echo '#Home';}?>"><?=$slot['slot0']?></a><a href="<?php if ($self != "/index.php"){echo '/';}?>#Evaluer"><?=$slot['slot1']?></a><a class="hideresponsive" href="<?php if ($self != "/index.php"){echo '/';}?>#Top5"><?=$slot['slot2']?></a><a style="float:right;" href="<?php if ($self != "/about"){echo '/about';}?>"><?=$slot['slot4']?></a>
</div>