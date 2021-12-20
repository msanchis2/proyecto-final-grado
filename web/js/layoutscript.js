$(document).ready(function () {
    $('.active').removeClass('active');
    var nav = localStorage.getItem('active');
    if(nav!=null)
        nav.addClass('active');

    $('nav-link').click(function(){
        localStorage.setItem('active',$(this));
    });
});