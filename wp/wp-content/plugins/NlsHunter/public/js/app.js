var App = App || (function ($) {

    // Hide the share widget buttons
    function hideShareButtons(shareWrapper) {
        $(shareWrapper).find('button.share-item').hide(200, function () {
            $(shareWrapper).removeClass('drop-shadow-md	 rounded-full');
        });

        $(shareWrapper).removeAttr('open');
    }

    // Hide the share widget buttons
    function showShareButtons(shareWrapper) {
        $(shareWrapper).addClass('drop-shadow-md rounded-full');
        $(shareWrapper).find('button.share-item').show(200);

        $(shareWrapper).attr({ open: true });
    }

    $(document).ready(function () {
        // Close notice
        $('.notice .close[role="button"]').on('click', function () {
            $(this).parents('.notice').remove();
        });

        // Toggle share widget
        $('.share-wrapper button.share-trigger').on('click', function () {
            $shareWrapper = $(this).parent();
            $open = !!$shareWrapper.attr('open');
            if ($open) hideShareButtons($shareWrapper);
            else showShareButtons($shareWrapper);
        });
    });
})(jQuery);