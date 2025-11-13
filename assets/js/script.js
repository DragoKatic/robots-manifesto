/**
 * Robots Manifesto Admin Script
 *
 * Allows users to hide the shared manifesto container in the WordPress admin dashboard.
 * Compatible with Human Manifesto plugin for parallel display.
 */

(function () {
    function addCloseButtons() {
        var entries = document.querySelectorAll('#robots-manifesto-section .rm-entry');
        if (!entries) return;

        entries.forEach(function(entry) {
            var closeBtn = entry.querySelector('.rm-close-btn');
            if (!closeBtn) return;

            closeBtn.addEventListener('click', function() {
                entry.style.display = 'none';
            });
        });
    }

    document.addEventListener('DOMContentLoaded', addCloseButtons);
})();