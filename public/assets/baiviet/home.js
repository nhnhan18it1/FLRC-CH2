$(document).ready(function () {
    
    $('#logo').hover(function () {
            $('#logo span').addClass('HienRa');
            $('#logo span').removeClass('if')
        }, function () {
            $('#logo span').addClass('if');
            $('#logo span').removeClass('HienRa');
        }
    );
});