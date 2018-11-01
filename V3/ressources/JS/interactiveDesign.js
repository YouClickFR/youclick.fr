$(document).ready(function() {
    // [HEADER PARALLAX]
    // [MENU]
    $(document).scroll(() => {
        console.log($("#youclickHeader").offset().top);
        $("#youclickHeader").css("background-position","center -" + $(document).scrollTop()/1.3 + "px");
        if ($(document).scrollTop()+$(window).height() >= $("#youclickHeader").height()+$("#home").height()){
             $("#topMenu").addClass("active");
             setTimeout(() =>$("#topMenu #logo").addClass("active"),300);
        }
        else $("#topMenu").removeClass("active");
    });
    
    $(document).scroll();
    // [HEADER SCROLL DOWN] 
    $("#youclickHeader #scrollDown").click(() => {
        $("html, body").animate({
            scrollTop: $("#youclickHeader").height()-75
        },500, 'swing');
    })



    // [CLOSE INTERVIEW]
    $(document).keydown((e) => { if (e.keyCode == 27) $(".interviewContainer.active").removeClass("active")});
    // [PARTY EASTER EGG] 
    $("#fleche").click(() => location.href+= "?party");
    if (location.href.split("/")[location.href.split("/").length-1].includes("?party")) {$("body").addClass("party");}

    //[ANALYSE]
    var analyse = () => {
        clearTimeout(out);
        let url = $("#evaluatorContainer input").val();
        if (url.length < 17 || !url.includes("youtu")) {
            $("#evaluatorContainer #evalError").addClass("active");
            var out = setTimeout(() => $("#evaluatorContainer #evalError").removeClass("active"),2000)
        }
        else {
            console.log("bite");
        }
    }
    $("#evaluatorContainer").keypress((e) => {if (e.keyCode == 13) analyse();});
    $("#evaluatorContainer button").click(analyse);

});