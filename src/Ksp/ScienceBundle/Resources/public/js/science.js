jQuery(function($) {
    
    $('.panel-heading').click(function() {
        var body = $(this).next();
        if (body.css('display') == 'none') {
            body.show();
        } else {
            body.hide();
        }
    });
    
    $('.place-heading').click(function() {
        var body = $(this).next();
        if (body.css('display') == 'none') {
            body.show();
        } else {
            body.hide();
        }
    });
    
});