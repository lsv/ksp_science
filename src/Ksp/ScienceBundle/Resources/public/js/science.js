jQuery(function ($) {

    var clonedHeaderRow;

    $(".panel").each(function () {
        clonedHeaderRow = $(".panel-heading", this);
        clonedHeaderRow
            .before(clonedHeaderRow.clone())
            .css("width", clonedHeaderRow.outerWidth())
            .addClass("floatingHeader");

    });

    $(window)
        .scroll(UpdateTableHeaders)
        .trigger("scroll");

    $('.panel-heading').click(function () {
        var body = $(this).next();
        if (body.css('display') == 'none') {
            body.show();
        } else {
            body.hide();
        }
    });

    $('.place-heading').click(function () {
        var body = $(this).next();
        if (body.css('display') == 'none') {
            body.show();
        } else {
            body.hide();
        }
    });

    $(".nav a[href]").click(function () {
        var target = $(this).attr("href");
        target = target.substring(1, target.length);
        $('html, body').animate({
            scrollTop: $('[id="' + target + '"]').offset().top - 100
        }, 500);
        return false;
    });

});

function UpdateTableHeaders() {
    $(".panel").each(function () {
        var el = $(this),
            offset = el.offset(),
            scrollTop = $(window).scrollTop() + 50,
            floatingHeader = $(".floatingHeader", this);

        if ((scrollTop > offset.top) && (scrollTop < offset.top + (el.height() - 50))) {
            floatingHeader.css({
                "visibility": "visible"
            });
        } else {
            floatingHeader.css({
                "visibility": "hidden"
            });
        }
    });
}