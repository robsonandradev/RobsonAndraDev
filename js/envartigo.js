$( document ).ready( function() {
    var tags = new Array(),
        baseurl = 'http://localhost:8080/RobsonAndraDev/';
    $('footer').css("margin-top", "60px" );
    $( "#sendArt" ).submit( function( e ) {
        e.preventDefault();
        if( $( "#addTag" ).val() == "" ) {
            $.post( baseurl + "artigo/novo", {
                title: $( "#title" ).val(),
                textArt: $( "#textArt" ).val(),
                tags: tags
            }).done( function( e ) {
                var color = "red";
                if( e.trim() == "Artigo salvo com sucesso!" || e.trim() == "Sucesso[no tags]" ) {
                    color = "green";
                    $("#sendArt").hide();
                    $( 'footer' ).css( "margin-top", ($(window).height() - $("footer").height()) + "px" );
                }
                $( "#error" ).text( "" ).append( $("<p>" ).append( e ).css( "color", color ));
            }).fail( function( e ) {
                $( "#error" ).text( "" ).append( $( "<p>" ).append( e ).css( "color", "red" ));
            });
        }else{
            var tag = $( "#addTag" ).val();
            if( tag[0] == "#" ) {
                tag = tag.substr( 1, tag.length );
            }
            if( tags.indexOf(tag) == -1 ) {
                tags.push( tag );
                $( "#listOfTags" ).append( "#" ).append( tag ).append( " " );
                if( tags.length % 5 == 0 ) {
                    $( "#listOfTags" ).append( $( "<br />" ) );
                }
            }
            $( "#addTag" ).val( "" );
        }
    });
});