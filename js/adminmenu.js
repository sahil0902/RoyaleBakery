// // Function to show notifications

const showNotification = (message, itemId) => {
    let notification = document.createElement('div');
    notification.className = 'top-notification';
    notification.textContent = message;
    document.body.appendChild(notification);
    setTimeout(() => {
        notification.remove();
    }, 3000); // 3 seconds delay
};
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
                    showNotification('Item updated successfully!', itemId);
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

    // For image updates, a more advanced solution is needed to handle preview and upload
    // Consider adding an image preview feature here
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
                // Add UI update logic here
            } else {
                console.error('Failed to update in stock status');
                // Add error notification here
            }
        } catch (error) {
            console.error('Error:', error);
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

    


