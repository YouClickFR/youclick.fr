$(document).ready(() => {
    $("button").click(function() {
        if (typeof $(this).attr("href") == "undefined") {return;}
        window.open($(this).attr("href"),$(this).attr("target") || "_self");
    });
});