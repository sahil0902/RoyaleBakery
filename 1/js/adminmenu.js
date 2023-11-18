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
    closeButton.onclick = () => notification.remove();

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
  
      // Remove the notification after 3 seconds and display the next one
      setTimeout(() => {
          notification.remove();
          displayNextNotification();
      }, 3000);
  
}


// Ensure global availability of the function
window.showNotification = showNotification;

console.log('Toast notification script loaded and ready.');

console.log('Script loaded');

// Ensure the toggleEditForm function is defined in the global scope
window.toggleEditForm = function(itemId) {
    console.log('toggleEditForm called with itemId:', itemId); // Add this line for debugging

    // Ensure that the element with the ID exists
    const menuItem = document.getElementById(`menuItem${itemId}`);
    console.log(`menuItem${itemId}`);
    
    if (menuItem) {
        // Look for the edit form within the menu item
        const editForm = menuItem.querySelector('.edit-form');
        if (editForm) {
            // Toggle the display of the edit form
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        } else {
            // Log an error if the edit form is not found
            console.error('Edit form not found for itemId:', itemId);
        }
    } else {
        // Log an error if the menu item is not found
        console.error('Menu item not found for itemId:', itemId);
    }
};


// Global function to explicitly hide the edit form
window.hideEditForm = function(itemId) {
    const menuItem = document.getElementById(`menuItem${itemId}`);
    const editForm = menuItem ? menuItem.querySelector('.edit-form') : null;
    if (editForm) {
        editForm.style.display = 'none'; // Explicitly hide the form
    } else {
        console.error('Edit form not found for itemId:', itemId);
    }
};
// document.addEventListener('DOMContentLoaded', () => {
//         // Create the notification element
//         let notification = document.createElement('div');
//         notification.className = 'top-notification';
//         notification.textContent = message;

//         // Add the notification to the body
//         document.body.appendChild(notification);

//         // Remove the notification after a delay
//         setTimeout(() => {
//             notification.remove();
//         }, 3000); // 3 seconds delay
    
// });
  




    // Add event listeners to Edit buttons to open the edit form
    // Set up event listeners for Edit buttons
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-warning').forEach(button => {
        button.addEventListener('click', () => {
            const itemId = button.getAttribute('data-item-id');
            if (itemId) { // Check if itemId is not null or undefined
                window.toggleEditForm(itemId);
            } else {
                console.error('Item ID is null or undefined.');
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-form form').forEach(form => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const itemId = form.querySelector('input[name="id"]').value;
            const formData = new FormData(form);

            // Check if a new image is selected and append it under the 'image' key
            const imageInput = form.querySelector('input[type="file"]');
            if (imageInput && imageInput.files.length > 0) {
                formData.append('image', imageInput.files[0]);
            }

            try {
                const response = await fetch('edit_menu.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if (data.status === 'success') {
                    // Update the UI to reflect the change
                    updateMenuItemDisplay(itemId, formData, data.updatedData.imageData);
            
                    showNotification('Item updated successfully!', itemId);
                    showNotification('If you have changed the image, please refresh the page to see the updated image.');
                    window.toggleEditForm(itemId); // Hide the form after successful update
                } else {
                    showNotification('Failed to update item.', itemId);
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('An error occurred during the update.', itemId);
            }
        });
    });
});



const updateMenuItemDisplay = (itemId, formData, imageData) => {
    const menuItem = document.querySelector(`#menuItem${itemId}`);
    if (!menuItem) {
        console.error('Menu item element not found:', `#menuItem${itemId}`);
        return;
    }

    // Update the menu item's details
    menuItem.querySelector('.card-title').textContent = formData.get('name');
    menuItem.querySelectorAll('.card-text')[0].textContent = formData.get('description');
    menuItem.querySelectorAll('.card-text')[1].textContent = "Category: " + formData.get('category');
    menuItem.querySelectorAll('.card-text')[2].textContent = "Price: £" + formData.get('price');

    // Update the image
    const imgElement = menuItem.querySelector(`#image-preview-${itemId} img`);
    if (imgElement) {
        // Check if imageData is provided in the response, update the image source with base64 data
        if (imageData) {
            imgElement.src = 'data:image/jpeg;base64,' + imageData;
        } else {
            // Update the image source to force reload the image
            imgElement.src = imgElement.src.split('?')[0] + '?timestamp=' + new Date().getTime();
        }
    } else {
        console.error('Image element not found in menu item:', `#image-preview-${itemId}`);
        showNotification('Failed to update item.', itemId);
    }
};



// ent.querySelectorAll('.edit-form input[type="file"]').forEach(fileInput => {
//     fileInput.addEventListener('change', function() {
//         if (this.files && this.files[0]) {
//             const reader = new FileReader();
//             reader.onload = function(e) {
//                 const imgElement = document.querySelector(`#menuItem${fileInput.dataset.itemId} img`);
                
//                 // Debugging: Log the imgElement and itemId
//                 console.log('imgElement:', imgElement, 'itemId:', fileInput.dataset.itemId);

//                 // Error handling: Check if imgElement is not null
//                 if (imgElement) {
//                     imgElement.src = e.target.result;
//                 } else {
//                     console.error('Image element not found for itemId:', fileInput.dataset.itemId);
//                 }
//             };
//             reader.readAsDataURL(this.files[0]);
//         }
//     });
// });

document.getElementById('image').addEventListener('change', function(event) {
    var label = document.querySelector("label[for='image']");
    var fileInput = event.target;
    var fileName = fileInput.files && fileInput.files.length > 0 ? fileInput.files[0].name : "No file chosen";
    label.setAttribute("data-file-name", fileName); 
    var imagePreview = document.getElementById('imagePreview');
    var files = event.target.files;
    if (files && files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            if(imagePreview) { // Check if the imagePreview element exists
                imagePreview.innerHTML = '<img src="' + e.target.result + '" alt="Image preview" class="img-thumbnail">';
                imagePreview.style.display = 'block'; // Show the preview
            } else {
                console.error('imagePreview element not found');
            }
        };
        reader.readAsDataURL(files[0]);
    }
});

function previewImage(input, itemId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewDiv = document.getElementById(`new-image-preview-${itemId}`);
            previewDiv.style.display = 'block';
            previewDiv.innerHTML = '<img src="' + e.target.result + '" class="img-fluid" />'; // Adjust image styling as needed
        };
        reader.readAsDataURL(file);
    }
}



    async function updateInStockStatus(itemId, inStock) {
        try {
            const formData = new FormData();
            formData.append('id', itemId);
            formData.append('in_stock', inStock ? '1' : '0');
    
            const response = await fetch('update_in_stock.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            if (data.status === 'success') {
                console.log('In stock status updated successfully');
               // showNotification('In stock status updated successfully', itemId);
                showNotification(data.message, itemId)
                // Add UI update logic here
            } else {
                console.error('Failed to update in stock status');
               /// showNotification(data.message, itemId)
                showNotification('Failed to update in stock status.', itemId);
                // Add error notification here
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('An error occurred during the update.', itemId);
            // Add error notification here
        }
    }
    
    
    // Event listener for in-stock checkbox change
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.in-stock-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const itemId = this.dataset.itemId;
                updateInStockStatus(itemId, this.checked);
            });
        });
    });
    
    // Add event listeners to Delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', () => {
            const itemId = button.getAttribute('data-item-id');
          

            if (confirm('Are you sure you want to delete this item?')) {
                fetch('delete_menu_item.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${itemId}`
                })
                .then(response => response.json())
                .then(data => {
                    showNotification(data.message);
                    if (data.status === 'success') {
                        document.querySelector(`#menuItem${itemId}`).remove();
                        toggleEditForm(itemId);
                    }
                })
                .catch(error => {
                    console.error('Delete operation failed:', error);
                    showNotification('Error deleting item.');
                });
            }
        });
    });

    


