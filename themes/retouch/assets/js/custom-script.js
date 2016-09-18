(function ($) {
    // Inside of this function, $() will work as an alias for jQuery()
    // and other libraries also using $ will not be accessible under this shortcut
    $('.widget_calendar table').addClass('table table-bordered');
    $('.attachment-post-thumbnail').addClass('img-responsive');
    $('ul.page-numbers').addClass('pagination');
    $('.page-numbers.current, .page-numbers.dots').parent().addClass('disabled');   
})(jQuery);

jQuery(document).ready(function ($) {
    // Inside of this function, $() will work as an alias for jQuery()
    // and other libraries also using $ will not be accessible under this shortcut
    $('iframe').each(function () {
        var url = $(this).attr("src");
        if ($(this).attr("src").indexOf("?") > 0) {
            $(this).attr({
                "src": url + "&wmode=transparent",
                "wmode": "Opaque"
            });
        }
        else {
            $(this).attr({
                "src": url + "?wmode=transparent",
                "wmode": "Opaque"
            });
        }
    });

    // PrettyPhoto
    $("a[rel^='prettyPhoto']").prettyPhoto({
        theme: 'light_square',
        social_tools: false
    });

    $(".entry-thumb, .post-thumb, .portfolio-thumbnail").fitVids();

    $(".skin-chooser-toggle").click(function () {
        $(".skin-chooser-wrap").toggleClass("show");
    });
    $(".color-skin").click(function () {
        var cls = this.id;
        $(".color-skin").removeClass("active");
        $(this).addClass("active");
        $("body").removeClass("color-skin-1 color-skin-2 color-skin-3 color-skin-4 color-skin-5").addClass(cls);
    });

    $(".color-pattern").click(function () {
        var bgim = $(this).css("background-image");
        $(".color-pattern").removeClass("active");
        $(this).addClass("active");
        $(".retouch-background").css( "background-image", bgim );
    });

    $("#l-wide").click(function (event) {
        event.preventDefault();
        $("body").removeClass("l-boxed retouch-background").addClass("l-wide");
        $(window).resize();
    });

    $("#l-boxed").click(function (event) {
        event.preventDefault();
        $("body").removeClass("l-wide").addClass("l-boxed retouch-background");
        $(window).resize();
    });
});
