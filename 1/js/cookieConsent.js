document.addEventListener('DOMContentLoaded', function() {
    var consentBanner = document.getElementById('cookieConsentBanner');
    var overlay = document.getElementById('cookieConsentOverlay');
    var acceptButton = document.getElementById('acceptCookies');
    var declineButton = document.getElementById('declineCookies');

    // Function to hide the consent overlay and banner
    function hideConsent() {
        overlay.style.display = 'none';
        consentBanner.style.display = 'none';
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }

    // Function to show the consent banner
    function showBanner() {
        consentBanner.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    // Check if the consent cookie is set
    if (getCookie('cookie_consent') !== 'true') {
        showBanner();
    } else {
        hideConsent();
    }

    // Event listener for accepting cookies
    acceptButton.addEventListener('click', function() {
        setCookie('cookie_consent', 'true', 365);
        var deviceInfo = getDeviceInfo();
        sendDeviceInfo(deviceInfo);
        hideConsent();
    });

    // Event listener for declining cookies
    declineButton.addEventListener('click', function() {
        setCookie('cookie_consent', 'false', 365);
        hideConsent();
    });

    // Function to collect device information
    function getDeviceInfo() {
        var width = window.screen.width;
        var height = window.screen.height;
        var userAgent = navigator.userAgent;
        var platform = navigator.platform;
        var connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
        var connectionType = connection ? connection.effectiveType : 'unknown';

        return {
            screenWidth: width,
            screenHeight: height,
            userAgent: userAgent,
            platform: platform,
            connectionType: connectionType
        };
    }

    // Function to send device information to the server
    function sendDeviceInfo(deviceInfo) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "cookies.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) {
                    showNotification('Cookies accepted');
                    console.log('Device info sent successfully');
                    // You can update the UI to show a success message
                } else {
                    console.error('There was a problem with the request.');
                }
            }
        }
        xhr.send("action=storeDeviceInfo&deviceInfo=" + encodeURIComponent(JSON.stringify(deviceInfo)));
    }
    
    // Function to set a cookie
    function setCookie(name, value, days) {
        var expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/';
    }

    // Function to get a cookie
    function getCookie(name) {
        var cookieArr = document.cookie.split(';');
        for(var i = 0; i < cookieArr.length; i++) {
            var cookiePair = cookieArr[i].split('=');
            if(name == cookiePair[0].trim()) {
                return decodeURIComponent(cookiePair[1]);
            }
        }
        return null;
    }
});
