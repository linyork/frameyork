$(document).ready(function(){

    $('.skill-star').each(function( index ) {

        creatStar( this, $(this).attr('data-id') );

    });
    var creatStar = function( int ) {
        $('.articleContent').children().remove();
        var innerContent_comment = document.createElement("div");
        innerContent_comment.className = 'innerContent-comment';
        innerContent_comment.id = 'innerContent-comment';
        $('#articleContent').append(innerContent_comment);
    };
});