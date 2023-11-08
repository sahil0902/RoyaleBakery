console.log('Script loaded');

// Ensure the toggleEditForm function is defined in the global scope
window.toggleEditForm = function(itemId) {
  
    // Ensure that the element with the ID exists
    const menuItem = document.getElementById(`menuItem${itemId}`);
    console.log('menuItem${itemId}');
    if (menuItem) {
        const editForm = menuItem.querySelector('.edit-form');
        if (editForm) {
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        } else {
            console.error('Edit form not found for itemId:', itemId);
        }
    } else {
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
document.addEventListener('DOMContentLoaded', () => {
    
    window.toggleEditForm = function(itemId) {
        const menuItem = document.getElementById(`menuItem${itemId}`);
        const editForm = menuItem ? menuItem.querySelector('.edit-form') : null;
        if (editForm) {
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        } else {
            console.error('Edit form not found for itemId:', itemId);
        }
    };




    // Add event listeners to Edit buttons to open the edit form
    document.querySelectorAll('.btn-warning').forEach(button => {
        button.addEventListener('click', () => {
            const itemId = button.getAttribute('data-item-id');
            toggleEditForm(itemId);
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
            .then(response => {
                console.log(response); // Check the raw response
                return response.json(); // This will fail if the response is not proper JSON
            })
            .then(data => {
                showNotification(data.message, itemId); // Use this for styled notification
                if (data.status === 'success') {
                    updateMenuItemDisplay(itemId, formData);
                    hideEditForm(itemId); // Hide the form when changes are saved
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                showNotification('Error updating item.', itemId);
            });
        });
    });

    const updateMenuItemDisplay = (itemId, formData) => {
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
    
        // Update the In Stock status
        // Add an element with class 'in-stock-status' in your HTML to display this status
        const inStockElement = menuItem.querySelector('.in-stock-status');
        if (inStockElement) {
            const inStockValue = formData.has('in_stock') && formData.get('in_stock') === '1';
            inStockElement.textContent = `In Stock: ${inStockValue ? 'Yes' : 'No'}`;
        } else {
            console.error('In-stock status element not found:', '.in-stock-status');
        }
    
        // Image update logic goes here...
    };
    
    

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

    const showNotification = (message, itemId) => {
        // Create the notification element
        let notification = document.createElement('div');
        notification.className = 'top-notification';
        notification.textContent = message;

        // Add the notification to the body
        document.body.appendChild(notification);

        // Remove the notification after a delay
        setTimeout(() => {
            notification.remove();
        }, 3000); // 3 seconds delay
    };

});
