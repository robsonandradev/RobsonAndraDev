$(document).ready(function(){
    var tags = new Array();
    centerMidle();
    $(window).resize(function(){
        centerMidle();
    });
    $("#sendArt").submit(function(e){
        e.preventDefault();
        if($("#addTag").val() == ""){
            $.post("dinamic/controller/envartigo.php", {
                title: $("#title").val(),
                textArt: $("#textArt").text(),
                tags: tags
            }).done(function(e){
                $("#error").text("").append($("<p>").append(e).css("color", "green"));
                $("#sendArt").hide();
            }).fail(function(e){
                $("#error").text("").append($("<p>").append(e).css("color", "red"));
            });
        }else{
            var tag = $("#addTag").val();
            if(tag[0] == "#"){
                tag = tag.substr(1, tag.length);
            }
            if(tags.indexOf(tag) == -1 ){
                tags.push(tag);
                $("#listOfTags").append("#").append(tag)
                    .append(" ");
                if(tags.length % 5 == 0){
                    $("#listOfTags").append($("<br />"));
                }
            }
            $("#addTag").val("");
        }
    });
});
function centerMidle(){
    var xCenter = ($(window).width()/2) - 365;
    $("#contentArticle").css("margin-left", xCenter + "px")
                        .css("padding-top", "10px");
}