/**
 * Component: Cookies
 */
document.addEventListener('DOMContentLoaded', function() {
    // Selecting DOM elements related to the cookie banner
    const cookieBanner = document.querySelector('.cookie-banner');
    const allowAllButton = document.querySelector('.cookie-banner__agree');
    const rejectAllButton = document.querySelector('.cookie-banner__reject');
    const rejectAllButtonModal = document.querySelector('.cookie-banner__reject-modal');
    const saveButton = document.querySelector('.cookie-banner__save-modal');
    const checkboxes = document.querySelectorAll('.cookie-manage-content input[type="checkbox"]');
    const openCookieBoxes = document.getElementsByClassName('open-cookie-box');
    const closeBtn = document.querySelector('.cookie-banner__close');

    // Open cookie banner when required
    Array.from(openCookieBoxes).forEach(function(openCookieBox) {
        openCookieBox.addEventListener('click', function(event) {
            event.preventDefault();
            cookieBanner.classList.remove('cookie-banner_closed');
        });
    });

    // Function to set a cookie with a specified expiration date
    const setCookie = (name, value, days) => {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = `${name}=${value}${expires};path=/`;
    }

    // Function to retrieve a specific cookie's value
    const getCookie = (name) => {
        let cookieArray = document.cookie.split(';');
        for(let i = 0; i < cookieArray.length; i++) {
            let cookiePair = cookieArray[i].split('=');
            if(name === cookiePair[0].trim()) {
                return decodeURIComponent(cookiePair[1]);
            }
        }
        return null;
    };

    // Update checkbox states based on current cookies
    const updateCheckboxStates = () => {
        checkboxes.forEach(checkbox => {
            const cookieName = checkbox.getAttribute('data-cookie');
            const cookieValue = getCookie(cookieName);
            if (cookieValue !== null) {
                checkbox.checked = cookieValue === 'true';
            }
        });
    };

    // Check if a decision on cookies has already been made
    const isCookieSet = () => {
        return getCookie('accept_necessary_technologies') !== null;
    };

    // Event handler for 'Allow All' button
    const handleAllowAll = () => {
        setCookie('accept_necessary_technologies', true, 365);
        setCookie('accept_performance_technologies', true, 365);
        setCookie('accept_targeting_technologies', true, 365);
        setCookie('accept_functionality_technologies', true, 365);
        setCookie('accept_unclassified_technologies', true, 365);
        checkboxes.forEach(checkbox => checkbox.checked = true);
        cookieBanner.classList.add('cookie-banner_closed');
    };

    // Event handler for 'Reject All' button
    const handleRejectAll = () => {
        setCookie('accept_necessary_technologies', true, 365); // Necessary cookies are always accepted
        setCookie('accept_performance_technologies', false, 365);
        setCookie('accept_targeting_technologies', false, 365);
        setCookie('accept_functionality_technologies', false, 365);
        setCookie('accept_unclassified_technologies', false, 365);
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkbox.getAttribute('data-cookie') === 'accept_necessary_technologies';
        });
        cookieBanner.classList.add('cookie-banner_closed');
    };

    // Event handler for 'Save' button
    const handleSave = () => {
        checkboxes.forEach(checkbox => {
            const cookieName = checkbox.getAttribute('data-cookie');
            setCookie(cookieName, checkbox.checked, 365);
        });
        cookieBanner.classList.add('cookie-banner_closed');
    };

    // Attach event listeners to buttons
    allowAllButton.addEventListener('click', handleAllowAll);
    rejectAllButton.addEventListener('click', handleRejectAll);
    rejectAllButtonModal.addEventListener('click', handleRejectAll);
    saveButton.addEventListener('click', handleSave);
    closeBtn.addEventListener('click', handleSave);

    // Initialize checkbox states and check if the cookie banner should be displayed
    updateCheckboxStates();
    if (isCookieSet()) {
        cookieBanner.classList.add('cookie-banner_closed');
    }
});
