// Wait for the DOM to load before executing any code
document.addEventListener('DOMContentLoaded', function() {

    // Define a function to edit a menu item
    function editMenuItem(id, event) {
        if (event) {
            event.preventDefault();
        }

        // Get the form data
        let formData = new FormData(document.querySelector(`#editModal${id} form`));

        // Log the form data
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]); 
        }

        // Send a fetch request to the server to update the menu item
        fetch('edit_menu.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Add this line to inspect the response from the server
            if (data.status === 'error') {
                alert(data.message);
                return;
            }

            // Show a notification with the message from the server
            showNotification(data.message);

            // Update the menu item on the page if the update was successful
            if (data.status === 'success') {
                document.querySelector(`#menuItem${id} .card-title`).innerText = formData.get('name');
                // Add updates for other fields if needed
            }

            // Hide the edit modal
            $(`#editModal${id}`).modal('hide');
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error.message);
        });
    }

    // Add a click event listener to all save changes buttons
    document.querySelectorAll('.save-changes-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            console.log("Save changes button was clicked!"); // Add this line
            const itemId = this.getAttribute('data-item-id');
            editMenuItem(itemId, event);
        });
    });

    // Add a click event listener to the test button
    document.getElementById('testButton').addEventListener('click', function() {
        console.log("Test button was clicked!");
    });

    // Define a function to delete a menu item
    function deleteItem(id) {
        if (confirm('Are you sure you want to delete this item?')) {
            // Send a fetch request to the server to delete the menu item
            fetch('delete_menu_item.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}`,
            })
            .then(response => response.json())
            .then(data => {
                // Show a notification with the message from the server
                showNotification(data.message);
                if (data.status === 'success') {
                    // Optionally, you can refresh the page or remove the deleted item from the DOM
                    location.reload();
                }
            });
        }
    }

    // Define a function to strip HTML tags from a string
    function stripHtml(html) {
        let doc = new DOMParser().parseFromString(html, 'text/html');
        return doc.body.textContent || "";
    }

    // Define a function to show a notification
    function showNotification(message) {
        let notification = document.createElement('div');
        notification.className = 'fixed bottom-0 right-0 mb-4 mr-4 p-2 max-w-sm bg-red-500 text-white rounded shadow-lg';
        notification.innerText = message;
        document.body.appendChild(notification);
        notification.style.display = 'block';

        // Set a timeout to remove the notification after it has been displayed for 10 seconds
        setTimeout(() => {
            notification.remove();
        }, 10000);
    }

    // Log the save changes button NodeList
    console.log(document.querySelectorAll('.save-changes-btn'));

});
