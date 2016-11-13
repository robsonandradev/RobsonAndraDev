$(document).ready(function(){
    var baseurl = 'http://localhost:8080/RobsonAndraDev/';
    footerPosition();
    $(window).resize(function(){
        footerPosition();
    });
    
    $( "#article" ).click( function() {
        $.get( baseurl + "artigo/lista" )
         .done( function( callback ) {
            callback = $.parseJSON(callback);
            console.log( callback );
            var div = $("<div>");
            $.each( callback, function( index, article ) {
                console.log(article);
                $( "<p>" ).append( $( "<b>" ).append(article.title) )
                    .append( "<br />" ).append( article.text )
                    .append( "<br />" ).appendTo(div);
            });
            $( "#sendArt" ).hide();
            $( ".main" ).append(div);
            $('footer').css( "margin-top", "10px" );
        }).fail( function( e ) {
            $( "#error" ).text( "" ).append( $( "<p>" ).append( e ).css( "color", "red" )).show();
        });
    });
});

function footerPosition(){
    var footerHeigth = $("footer").height(),
        marginTop = $(window).height() - (footerHeigth*5),
        marginLeft = ($(window).width()/2) - 365;
    $('footer').css("margin-top", marginTop + "px");
    $('footer').css("padding-left", marginLeft + "px");
    $('header').css("padding-left", marginLeft + "px");
    $( ".main" ).css( "margin-left", marginLeft + "px" ).css( "padding-top", "10px" );
}

//$( 'footer' ).css( "margin-top", ($(window).height() - $("footer").height()) + "px" ) 