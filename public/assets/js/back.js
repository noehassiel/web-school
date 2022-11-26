$('#asideBtn').on( "click", function(e) {
    e.preventDefault();

    if ($('.aside').hasClass('minimized')) {
        $('.aside').removeClass('minimized');
    } else {
        $('.aside').addClass('minimized');        
    }

});