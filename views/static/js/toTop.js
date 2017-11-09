$(function () {

    $(document).scroll(function () {
        var winHeight = $(window).height(),
            scrTop = $(document).scrollTop();
        if (scrTop >= winHeight) {
            $('#toTop').stop().fadeIn(300);
        } else {
            $('#toTop').stop().fadeOut(300);
        }
    });

    $('#toTop').click(function () {
        $(document).scrollTop(0);
    });

});