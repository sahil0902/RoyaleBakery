
// // Function to show notifications
const notificationQueue = [];
let isNotificationBeingShown = false;
function showNotification(message) {
    // Add the notification message to the queue
    notificationQueue.push(message);

    // If no notification is currently being shown, display the next one
    if (!isNotificationBeingShown) {
        displayNextNotification();
    }
}
function displayNextNotification() {
    if (notificationQueue.length === 0) {
        isNotificationBeingShown = false;
        return;
    }

    isNotificationBeingShown = true;
    const message = notificationQueue.shift(); // Get the next message from the queue

    // Determine the type of notification based on message content
    let type = 'info'; // Default type
    if (message.toLowerCase().includes('error')) {
        type = 'error';
    } else if (message.toLowerCase().includes('success')) {
        type = 'success';
    } else if (message.toLowerCase().includes('warning')) {
        type = 'warning';
    }

    // Create notification element
    const notification = document.createElement('div');
    notification.className = `toast-notification ${type}`;
    notification.textContent = message;

    // Close button for the notification
    const closeButton = document.createElement('button');
    closeButton.textContent = '×';
    closeButton.className = 'toast-close-button';
    closeButton.onclick = () => {
        notification.classList.add('animate-out');
        notification.addEventListener('transitionend', () => notification.remove());
    };

    // Append the close button to the notification
    notification.appendChild(closeButton);

    // Find or create the notification container
    let notificationContainer = document.getElementById('notification-container');
    if (!notificationContainer) {
        notificationContainer = document.createElement('div');
        notificationContainer.id = 'notification-container';
        document.body.appendChild(notificationContainer);
    }

    // Append the notification to the container
    notificationContainer.appendChild(notification);

    // Add the 'animate-in' class to start the show animation
    setTimeout(() => {
        notification.classList.add('animate-in');
    }, 100); // Timeout ensures the element is in the DOM so the animation can occur

    // Remove the notification after 3 seconds with an animation
    setTimeout(() => {
        // Trigger the hide animation
        notification.classList.add('animate-out');
        // Wait for the animation to finish before removing the notification
        notification.addEventListener('transitionend', () => {
            notification.remove();
            // Display the next notification in the queue if any
            displayNextNotification();
        });
    }, 3000); // You can adjust timing to match your CSS animation
}
