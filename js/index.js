$(document).ready(function(){
    footerPosition();
    $(window).resize(function(){
        footerPosition();
    });
});

function footerPosition(){
    var footerHeigth = $("footer").height(),
        marginTop = $(window).height() - (footerHeigth*5),
        marginLeft = ($(window).width()/2) - 365;
    $('footer').css("margin-top", marginTop + "px");
    $('footer').css("padding-left", marginLeft + "px");
    $('header').css("padding-left", marginLeft + "px");
}