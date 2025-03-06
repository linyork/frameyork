$(document).ready(function(){
    $('.skill-star').each(function( index ) {

        var fraction = $(this).attr('data-id');
        var starDiv = document.createElement("div");
        starDiv.style.float = 'right';
        starDiv.style.color = 'gold';

        for (i = 1; i <= Math.abs(fraction); i++) {
            var fullStar = document.createElement("i");
            fullStar.classList.add("fa");
            fullStar.classList.add("fa-star");
            $(starDiv).append(fullStar);
        }

        if(fraction.match(".5"))
        {
            var halfStar = document.createElement("i");
            halfStar.classList.add("fa");
            halfStar.classList.add("fa-star-half-o");
            $(starDiv).append(halfStar);
        }


        for (i = 1; i <= Math.abs(5-fraction); i++) {
            var noStar = document.createElement("i");
            noStar.classList.add("fa");
            noStar.classList.add("fa-star-o");
            $(starDiv).append(noStar);
        }

        this.append(starDiv);
    });
});