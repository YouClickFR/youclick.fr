<!DOCTYPE HTML>
<html prefix="og: http://ogp.me/ns#">
<?php require("ressources/INC/head.php");?>
<body>
<?php require("ressources/INC/header.php");?>
<?php require("ressources/INC/topMenu.php")?>
<?php require("ressources/INC/languageMenu.php")?>
<section id="home">
    <h1>Bienvenue sur YouClick !</h1>
    <p>
        Le putaclic est une pratique exercée sur un titre et/ou une miniature afin d'attirer les clics de manière trop exagérée par des manières telles que la nudité, le suspens, le choc...
    </p>
    <button  target="_blank"><i class="fab fa-chrome"></i>Notre extenstion anti-putaclic YouBlock</button><br />
        <button href="https://youclick.fr/extern?facebook" target="_blank" id="facebook"><i class="fab fa-facebook"></i>Notre Facebook YouClickFR</button>
        <button href="https://youclick.fr/extern?twitter" target="_blank" id="twitter"><i class="fab fa-twitter"></i>Notre Twitter YouClickFR</button>
        <button href="https://youclick.fr/extern?discord" target="_blank" id="discord"><i class="fab fa-discord"></i>Rejoindre Notre Discord</button>
</section>
<section id="Evaluator">
<div id="fleche"><img src="ressources/IMG/redarrow.png"></img></div>
<h1>Évaluateur de putaclic</h1>
<p>Collez l'URL d'une vidéo YouTube. Notre évaluateur se chargera d'analyser le niveau de putaclic du titre et de la miniature</p>
<div id="evaluatorContainer">
<div id="evalError">Veuillez entrer l'URL d'une vidéo YouTube !</div>
<input type="text" placeholder="https://youtu.be/KmUSvblT4II" maxlength=43 spellcheck=off autocomplete=off/>
<button id="analyseVideo">Évaluer le niveau de putaclic</button>
</div>
<div id="loader"><img src="ressources/IMG/handspinner.gif" alt="Loading..."></div>
<div id="analyses" class="bottomText"><span id="f1"></span><span id="f2"></span></div>
</section>
<section id="Top5">
    <h1>Top 5 des vidéos postées cette semaine <a href="#" id="top5switch">depuis toujours</a></h1>
    <div id="top5List">
    <div class="topVideo" id="top1">
            <header>Score: 902</header>
            <div id="thumb"></div>
            <div id="rightText">
                <h1>Top 1</h1>
                <h2>Une vidéo incroyable omg c ouf woaw ntm.</h2>
                <div class="shittyYouTuber">GameMixPd</div>
            </div>
        </div><br />
        <div class="topVideo">
            <header>Score: 902</header>
            <div id="thumb"></div>
            <div id="rightText">
                <h1>Top 1</h1>
                <h2>Une vidéo incroyable omg c ouf woaw ntm.</h2>
                <div class="shittyYouTuber">GameMixPd</div>
            </div>
        </div>
        <div class="topVideo">
            <header>Score: 902</header>
            <div id="thumb"></div>
            <div id="rightText">
                <h1>Top 1</h1>
                <h2>Une vidéo incroyable omg c ouf woaw ntm.</h2>
                <div class="shittyYouTuber">GameMixPd</div>
            </div>
        </div>
    </div>
</section>
<section id="ranking">
    <h1>Top Youtubeurs</h1>
    <p>Pour intégrer ce top, au moins 5 vidéos du youtuber concerné doivent être analysées. Plus vous analyserez de vidéos du Youtuber concerné, plus la Fiabilité du Youtuber augmentera.
    <BR>ATTENTION : Les résultats ci-dessous ne sont fiables qu'après amples analyses, et sont soumises à des changements. Ne prenez-pas ce tableau au pied de la lettre.
    </p>
    <div id="tableCropper">
        <table>
            <thead>
                <tr>
                    <th>Rang</th>
                    <th>Youtubeur</th>
                    <th>Moyenne</th>
                    <th>Putaclic</th>
                    <th>Vidéo analysées</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>TrendingPranks</td>
                    <td>174</td>
                    <td>Extrême</td>
                    <td>58</td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <script>
        for (var x=1;x<=100;x++) {
            $("#ranking table tbody").append("<tr><td>"+x+"</td><td>TrendingPranks</td><td>174</td><td>Extrême</td><td>58</td></tr>")
        }
    </script>
</section>
<?php require_once("ressources/INC/footer.php"); ?>
</html>