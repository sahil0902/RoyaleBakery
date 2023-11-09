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
document.querySelectorAll('.edit-form form').forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const itemId = form.querySelector('input[name="id"]').value;
        const formData = new FormData(form);

        fetch('edit_menu.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Convert response to JSON
        .then(data => {
            if (data.status === 'success') {
                // Update the UI to reflect the change if necessary
                showNotification(data.message, itemId); // Show a success notification
            } else {
                console.error('Error in response:', data);
                showNotification('An error occurred.', itemId); // Show an error notification
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            showNotification('Error occurred during fetch.', itemId); // Show a fetch error notification
        });     
    });
});

    const updateMenuItemDisplay = (itemId, formData, form) => {
        // Ensure that the form parameter is defined
    if (!form) {
        console.error('Form is undefined.');
        return;
    }
        // Grab the menu item card element
        const menuItem = document.querySelector(`#menuItem${itemId}`);
        if (!menuItem) {
            console.error('Menu item element not found:', `#menuItem${itemId}`);
            return;
        }
        

        // Update the menu item's name
        const titleElement = menuItem.querySelector('.card-title');
        if (titleElement) titleElement.textContent = formData.get('name');
    
        // Update the menu item's description
        const descriptionElement = menuItem.querySelectorAll('.card-text')[0];
        if (descriptionElement) descriptionElement.textContent = formData.get('description');
    
        // Update the menu item's category
        const categoryElement = menuItem.querySelectorAll('.card-text')[1];
        if (categoryElement) categoryElement.textContent = "Category: " + formData.get('category');
    
        // Update the menu item's price
        const priceElement = menuItem.querySelectorAll('.card-text')[2];
        if (priceElement) priceElement.textContent = "Price: £" + formData.get('price');
       // Inside your form submit event handler

        
        // Update the In Stock status
        // Add an element with class 'in-stock-status' in your HTML to display this status
        // const inStockElement = menuItem.querySelector('.in-stock-status');
        // if (inStockElement) {
        //     const inStockValue = formData.has('in_stock') && formData.get('in_stock') === '1';
        //     inStockElement.textContent = `In Stock: ${inStockValue ? 'Yes' : 'No'}`;
        // } else {
        //     console.error('In-stock status element not found:', '.in-stock-status');
        // }
    
        // Image update logic goes here...
    };
    
    function updateInStockStatus(itemId, inStock) {
        // Prepare the data to be sent in the request
        const formData = new FormData();
        formData.append('id', itemId);
        formData.append('in_stock', inStock ? '1' : '0');
    
        // Send the AJAX request to the PHP script
        fetch('update_in_stock.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                console.log('In stock status updated successfully');
                // You can add any success notification or UI update here
            } else {
                console.error('Failed to update in stock status');
                // You can add any error notification here
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
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

    


