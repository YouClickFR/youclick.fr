<?php
$error = htmlspecialchars($_GET['id']);
switch ($error) {
    case "404":
        $msg1 = "Page Not Found";
        $msg2 = "Tu t'es perdu ? C'est une page 404 ici, c'est-à-dire que la page que tu cherchais n'existe pas ou a été dérobée par un lama de fâcheuse humeur.";
    break;
    case "403":
        $msg1 = "Forbidden";
        $msg2 = "Hep hep hep. C'est une page 403 ici, c'est-à-dire que la page que tu cherches est hautement protégée par notre armée de lamas. Déso pas déso.";
    break;
    case "500":
        $msg1 = "Internal Server Error";
        $msg2 = "Oups. Un soucis semble être présent sur notre site... Nous en informons notre équipe de lamas de sécurité pour tout réparer. On sera de retour dans quelques instants.";
    break;
    default:
        $error = "???";
    break;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>YouClick — <?=$error?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>html,body{padding:0;margin:0;width:100%;height:100%;overflow:hidden;}h1{font-size:170px;line-height:180px;color:#99A7AF;margin:0;}h2{font-size:25px;line-height:25px;color:#DE6C5D;font-weight:bold;letter-spacing:-1px;margin-top:-10px;}.p{position:absolute;display:block;width:50%;height:70vh;left:25%;top:15vh;background-color:#ffffff;box-sizing:border-box;border-radius:5px;border-top:5px solid #666666;border-top-left-radius:0px;border-top-right-radius:0px;text-align:center;padding-left:5%;padding-right:5%;font-family:'Arial';}.m{margin-top:33vh;transform:translateY(-50%);}canvas{display:block;vertical-align:bottom;}#particles-js{width:100%;height:100%;background-color:#b61924;background-image:url(/assets/img/logowhite.png);background-repeat:no-repeat;background-size:150px auto;background-position:50% 20px;}@media screen and (max-width:700px){.p{width:100%;height:80vh;left:0;top:10vh;border:0;border-radius:0;}}a{color:inherit;text-decoration:underline;}a:hover{text-decoration:none;}a:visited{color:inherit;text-decoration:inherit;}</style>
</head>
<body>
    <!-- particles.js container -->
    <div class="p">
        <div class="m">
            <h1><?=$error?></h1>
            <h2><?=$msg1?></h2>
            <?=$msg2?>
            <br>Tu peux revenir sur <a href="https://youclick.fr/">https://youclick.fr/</a> ou retourner à ta <a href="javascript:%20history.go(-1)">précédente page</a>.
        </div>
    </div>
    <div id="particles-js"></div>
    <!-- scripts -->
    <script src="/assets/js/particles.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>