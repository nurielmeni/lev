var App = App || (function ($) {

    // Hide the share widget buttons
    function hideShareButtons(shareWrapper) {
        $(shareWrapper).find('.share-item').hide(200, function () {
            $(shareWrapper).removeClass('drop-shadow-md	 rounded-full');
        });

        $(shareWrapper).removeAttr('open');
    }

    // Hide the share widget buttons
    function showShareButtons(shareWrapper) {
        hideAllShareButtons();

        $(shareWrapper).addClass('drop-shadow-md rounded-full');
        $(shareWrapper).find('.share-item').show(200);

        $(shareWrapper).attr({ open: true });
    }

    // Hide all the share widget buttons
    function hideAllShareButtons() {
        var shareWrapper = $('.share-wrapper nav[open]');
        if (shareWrapper.length === 0) return;

        hideShareButtons(shareWrapper);
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

        // Hide click outside opened share
        $(document).on('click', function (event) {
            var shareWrapper = $('.share-wrapper nav[open]');
            if (shareWrapper.length === 0) return;

            if (!shareWrapper.is(event.target) && !shareWrapper.has(event.target).length) {
                hideShareButtons(shareWrapper);
            }
        });
    });
})(jQuery);