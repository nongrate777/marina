/**
 * Script: Members
 */
document.addEventListener('DOMContentLoaded', function () {
    const sortForm = document.getElementById('sort-form');
    const sortSelect = document.getElementById('sort');

    const ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";

    sortForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const selectedValue = sortSelect.value;

        jQuery.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'sort_users',
                sort_by: selectedValue
            },
            success: function (response) {
                const profileMain = document.querySelector('.profile__main');
                profileMain.innerHTML = response.html;
            },
            error: function (error) {
                console.log('ERROR AJAX: ' + error);
            }
        });
    });
});
