const showNotification = (message, type) => {
    let notification = document.createElement('div');
    notification.className = `toast-notification ${type}`; // Add the type of notification as a class
    notification.textContent = message;
  
    // Optionally, add a button or icon to close the notification
    const closeButton = document.createElement('button');
    closeButton.textContent = '×';
    closeButton.className = 'toast-close-button';
    closeButton.onclick = () => notification.remove();
    notification.appendChild(closeButton);
  
    // Append the notification to a container div for toasts, if it exists; otherwise, append to body
    const toastContainer = document.getElementById('toast-container') || document.body;
    toastContainer.appendChild(notification);
  
    // Automatically remove the notification after 3 seconds
    setTimeout(() => {
      notification.remove();
    }, 3000);
  };
  
  // Call this function to create a notification
  // showNotification('Your message here', 'success'); // Call it with types like 'success', 'error', etc.
  

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
// AJAX Implementation for Inline Editing
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-form form').forEach(form => {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            const itemId = form.querySelector('input[name="id"]').value;
            const formData = new FormData(form);

            try {
                const response = await fetch('edit_menu.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if (data.status === 'success') {
                    // Update the UI to reflect the change
                    updateMenuItemDisplay(itemId, formData);
                    //showNotification('Item updated successfully!', itemId);
                    showNotification(data.message, success)
                    window.toggleEditForm(itemId); // Hide the form after successful update
                } else {
                    showNotification(data.message, error)
                   // showNotification('Failed to update item.', itemId);
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('An error occurred during the update.', error);
            }
        });
    });
});


   // Dynamically Updating the Content
const updateMenuItemDisplay = (itemId, formData) => {
    const menuItem = document.querySelector(`#menuItem${itemId}`);
    if (!menuItem) {
        console.error('Menu item element not found:', `#menuItem${itemId}`);
        return;
    }

    // Update the menu item's name, description, category, and price
    menuItem.querySelector('.card-title').textContent = formData.get('name');
    menuItem.querySelectorAll('.card-text')[0].textContent = formData.get('description');
    menuItem.querySelectorAll('.card-text')[1].textContent = "Category: " + formData.get('category');
    menuItem.querySelectorAll('.card-text')[2].textContent = "Price: £" + formData.get('price');
    

};
document.querySelectorAll('.edit-form input[type="file"]').forEach(fileInput => {
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.querySelector(`#menuItem${fileInput.dataset.itemId} img`);
                imgElement.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});
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

function previewImage(input, previewId) {
    var previewContainer = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            // Clear any existing content in the preview container
            previewContainer.innerHTML = '';
            // Create an img element and set its source to the file content
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '300px'; // Adjust this value to your preference
            img.style.maxHeight = '300px'; // Adjust this value to your preference
            img.alt = 'Image preview';
            // Append the image to the preview container
            previewContainer.appendChild(img);
            // Make sure the preview container is visible
            previewContainer.style.display = 'block';
        };

        reader.onerror = function(e) {
            // Handle errors here
            console.error('File could not be read! Code ' + e.target.error.code);
        };

        // Read the image file as a data URL to trigger the onload event
        reader.readAsDataURL(input.files[0]);
    } else {
        // Hide the preview container if no image is selected
        previewContainer.style.display = 'none';
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
               // showNotification(data.message, itemId)
                showNotification('In stock status updated successfully', success);
                // Add UI update logic here
            } else {
                console.error('Failed to update in stock status');
                showNotification(data.message, error)
                //showNotification('Failed to update in stock status.', itemId);
                // Add error notification here
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('An error occurred during the update.', error);
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
                        showNotification('Item deleted successfully', success);
                        document.querySelector(`#menuItem${itemId}`).remove();
                        toggleEditForm(itemId);
                    }
                })
                .catch(error => {
                    console.error('Delete operation failed:', error);
                    showNotification('Error deleting item.',error);
                });
            }
        });
    });

    


