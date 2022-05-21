var App = App || (function ($) {

    $(document).ready(function () {
        // Close notice
        $('.notice .close[role="button"]').on('click', function () {
            $(this).parents('.notice').remove();
        });
    });
})(jQuery);