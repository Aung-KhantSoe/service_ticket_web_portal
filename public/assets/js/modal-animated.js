"use strict";
function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
};
var modal_animate_custom = {
    init: function() {
        $('#passForgotModal').on('show.bs.modal', function (e) {
            //var anim = $('#entrance').val();
            var anim = 'slideInUp';
            testAnim(anim);
        })
        $('#passForgotModal').on('hide.bs.modal', function (e) {
            //var anim = $('#exit').val();
            var anim = 'slideOutDown';
            testAnim(anim);
        })
        // $("a").tooltip();
    }
};
(function($) {
    "use strict";
    modal_animate_custom.init()
})(jQuery);