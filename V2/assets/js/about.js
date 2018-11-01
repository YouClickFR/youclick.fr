function ChangelogsAlert() {
    this.render = function(title,body,footer) {
        var dialog_overlay = document.getElementById('dialog_overlay');
        var dialog_box = document.getElementById('dialog_box');
        var winW = window.innerWidth;
        dialog_overlay.style.display = "block";
        dialog_box.style.display = "block";
        document.getElementById('dialog_scroll').style.overflow = "hidden";
        document.getElementById('dialog_box_header').innerHTML = '<p class="dialog_box_header_p"><img class="mic" src="/assets/img/micro.png">'+title+'</p><img onclick="Alert.ok()" class="img_loaded" src="/assets/img/croix.png"><br>';
        document.getElementById('dialog_box_body').innerHTML = body;
    }
    this.ok = function() {
        document.getElementById('dialog_scroll').style.overflow = "auto";
        document.getElementById('dialog_box').style.display = "none";
        document.getElementById('dialog_overlay').style.display = "none";
    }
}
var Alert = new ChangelogsAlert();