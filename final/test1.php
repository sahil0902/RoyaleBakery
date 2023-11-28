<!DOCTYPE html>
<html>
<head>
    <title>My Website</title>
    <link rel="stylesheet" type="text/css" href="css/cookies.css">
</head>
<body>
    <?php include 'config.php'; ?>
    <?php include 'search_results.php'; ?>
    <?php include 'cookies.php'; ?>
    
    <!-- Consent Banner (placed at the end of your body tag) -->
    <div id="cookieConsentBanner">
            <p>This website uses cookies to enhance your experience. By continuing to use our website, you agree to our use of cookies.</p>
            <button id="acceptCookies">Accept</button>
            <button id="declineCookies">Decline</button>
    </div>

    <script src="js/cookieConsent.js" defer></script>

    <?php
    if (isset($_POST['accept'])) {
        include 'cookies.php';
    }
    ?>
</body>
</html>
