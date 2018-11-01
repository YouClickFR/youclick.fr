function analyze() {
    var url = $("#url").val();
    if (url == "") {
        error(plsurl);
    } else {
        $("#url").val('');
        $("#load").show();
        $('#result').hide().load('analyse?videoURL='+url, function() {
            $('#load').hide();
            var valresult = $("#result").html();
            if (valresult == "0") {
                error(plsvideo);
            } else {
                $('#result').show();
                $("#topvideos").load("top?lang="+language+"&classement="+type);
                $("#topytb").load('topytb?lang='+language);
            }
        });
    }
}
function error($e) {
    if (!$('.ui-effects-wrapper').length){
        $('#formidable').effect('shake', {times:3}, 300);
        $('.error-tip').html($e);$('#error').show('fast');
    }
}
var type = "semaine";
function topchange($type) {
    $("#topvideos").load("top?lang="+language+"&classement="+$type);
    $("#topytb").load('topytb?lang='+language);
    if ($type == "semaine") {
        $(".toptop1").show();
        $(".toptop2").hide();
    } else {
        $(".toptop1").hide();
        $(".toptop2").show();
    }
    type = $type;
}
$(function(){
    $.get('tip.php', function(data) {
        aTip = JSON.parse(data);
    });
    setInterval(function(){
        $('.tips').html(aTip[Math.random() * aTip.length | 0]);
        $('#c_analyze').load('/api/?analyzes&type=text&format=french&key=YouClick');
    }, 2000);
});
