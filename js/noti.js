function showNotification() {
    var modal = document.getElementById('notificationModal');
    modal.style.display = 'block';
    
    // Make the modal disappear after 5 seconds
    setTimeout(function() {
        modal.style.display = "none";
    }, 5000);
}

function closeNotification() {
    document.getElementById('notificationModal').style.display = 'none';
}
