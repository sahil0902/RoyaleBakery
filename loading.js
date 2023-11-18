document.addEventListener("DOMContentLoaded", function() {
    // Simulate loading progress
    let progress = 0;
    const interval = setInterval(function() {
        progress += 10;
        document.getElementById("loadingBar").style.width = progress + "%";
        document.getElementById("loadingPercentage").textContent = progress + "%";

        if (progress >= 100) {
            clearInterval(interval);
            // Hide the loading bar and percentage after reaching 100%
            document.getElementById("loadingBarContainer").style.display = "none";
            // Show the page content
            document.getElementById("pageContent").style.display = "block";
        }
    }, 200); // This will increase the progress by 10% every 200ms
});
