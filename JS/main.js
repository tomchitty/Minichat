function hide_msg(id) {
    var msg = document.getElementById('msg_'+id);
    var btn = document.getElementById('btn_'+id);
    var btn_content = btn.innerHTML;
    if (btn_content == '^') {
        msg.style.display = 'none';
        document.getElementById('btn_'+id).innerHTML = '...';
    }
    else {
        msg.style.display = 'block';
        document.getElementById('btn_'+id).innerHTML = '^';
    }
}

function change_trash(id) {
    var link = document.getElementById('delete_msg_'+id);
    var img = link.getElementsByTagName('img')[0];
    img.setAttribute('src', 'CSS/Images/trash2.png');
}

function reset_trash(id) {
    var link = document.getElementById('delete_msg_'+id);
    var img = link.getElementsByTagName('img')[0];
    img.setAttribute('src', 'CSS/Images/trash1.png');
}

function sure(id) {
    var rep = confirm("Voulez-vous vraiment supprimer le message ?");
    if (!rep){
        document.location.href="main.php#msg_"+(id + 2);
    }
    else{
        document.location.href="delete_msg.php?id="+id;
    }
}

window.onload = function get_current_url() {
    setTimeout(hello_popup, 0);
    setTimeout(hello_newpopup, 9 * 1000);
    var menu = document.getElementsByClassName("dropdown_content");
    var content = menu[0].getElementsByTagName("a");
    var current_url = window.location.href.split('?')[0];
    var i = 0;
    while (content[i] != current_url && content[i]){
        i++;
    }
    if (content[i]){
        curicon = document.getElementById("cur"+ (i+1));
        curicon.style.color = "#A2C614";
    }
}

function hide_it() {
    div = document.getElementById("hello_div");
    div.style.display = 'none';
}

function hide_popup() {
    div = document.getElementById("hello_div");
    div.style.animation = "anim2 1.5s";
    setTimeout(hide_it, 1500);
}

function display_popup() {
    div = document.getElementById("hello_div");
    div.style.animation = "anim1 1.5s";
    div.style.display = 'block';
    delay = 10;
    setTimeout(hide_popup, delay * 1000);
}

function hello_popup() {
    delay = 1;
    setTimeout(display_popup, delay * 1000);
}

function hide_new() {
    div = document.getElementById("new_msg_div");
    div.style.display = 'none';
}

function hide_newpopup() {
    div = document.getElementById("new_msg_div");
    div.style.animation = "anim2 1.5s";
    setTimeout(hide_new, 1500);
}

function display_newpopup() {
    div = document.getElementById("new_msg_div");
    div.style.animation = "anim1 1.5s";
    div.style.display = 'block';
    delay = 7;
    setTimeout(hide_newpopup, delay * 1000);
}

function hello_newpopup() {
    delay = 0.5;
    setTimeout(display_newpopup, delay * 1000);
}