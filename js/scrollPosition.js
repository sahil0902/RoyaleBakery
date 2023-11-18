// Store the scroll position before the page reloads
window.onbeforeunload = function() {
    localStorage.setItem('scrollPosition', window.scrollY);
}

// Restore the scroll position after the page loads
window.onload = function() {
    if (localStorage.getItem('scrollPosition') !== null) {
        window.scrollTo(0, localStorage.getItem('scrollPosition'));
        localStorage.removeItem('scrollPosition'); // Clear the stored value
    }
}
