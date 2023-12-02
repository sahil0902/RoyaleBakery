function addStyles() {
    const css = `
    
    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Distribute buttons with space in between */
        width: 80px; /* Approximate width to contain both buttons with space */
        position: relative;
        z-index: 10;
    }

    .quantity-controls button {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        transition: all 0.3s ease;
        cursor: pointer;
        margin: 0 2px;
        box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.2);
    }

    .quantity-controls button:hover {
        background-color: #388E3C;
        transform: translateY(-2px);
        box-shadow: 0px 4px 18px rgba(0, 0, 0, 0.25);
    }

    .quantity-controls button:active {
        transform: translateY(1px);
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    }

    .quantity-controls button i {
        font-size: 18px;
    }

    /* Adding a gold focus outline to the input elements */
    input:focus {
        outline: 2px solid gold;
        box-shadow: none;  /* Optional: Removing any default browser shadows */
    }
    @media (max-width: 768px) { 
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Distribute buttons with space in between */
            width: 70px; /* Approximate width to contain both buttons with space */
            position: relative;
            z-index: 10;
        }

        .quantity-controls button {
            width: 28px; 
            height: 28px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-controls button i {
            font-size: 14px; 
        }
    
    `;

    const styleElement = document.createElement('style');
    styleElement.type = 'text/css';
    styleElement.innerHTML = css;
    document.head.appendChild(styleElement);
}


// Call the function to add the styles
addStyles();


let basket = [];

document.addEventListener('DOMContentLoaded', function() {
    const parentContainer = document.getElementById('parent-container');

    parentContainer.addEventListener('click', function(event) {
        // Find the clicked "Add to Basket" button
        let button = event.target;
        while (button !== null && !button.classList.contains('addToBasket')) {
            button = button.parentElement;
        }

        // If a button was clicked, handle the event
        if (button !== null && button.classList.contains('addToBasket')) {
            console.log("Add to Basket button clicked");
            const itemId = button.getAttribute('data-id');
            const itemName = button.getAttribute('data-name');
            const itemPrice = parseFloat(button.getAttribute('data-price'));
            addToBasket(itemId, itemName, itemPrice);
        }
    });
    const addToBasketButtons = document.querySelectorAll('.addToBasket');
    console.log(addToBasketButtons); // Check if buttons are selected

    const basketIcon = document.getElementById('basketIcon');

    addToBasketButtons.forEach(button => {
        button.addEventListener('click', function() {
            console.log("Add to Basket button clicked");
            const itemId = this.getAttribute('data-id');
            const itemName = this.getAttribute('data-name');
            const itemPrice = parseFloat(this.getAttribute('data-price'));
            addToBasket(itemId, itemName, itemPrice);
        });
    });

    basketIcon.addEventListener('click', toggleDropdown);
    // initializePreloaderAnimations();
});

function addToBasket(id, name, price) {
    showNotification("This feature will be available in the future. We'll send you an email with the total price and products for your reference.");
    console.log(`Adding item with ID: ${id}, Name: ${name}, Price: ${price}`);
    let foundItem = basket.find(item => item.id === id);
    
    if (foundItem) {
   
        foundItem.quantity++;
    } else {
        basket.push({id, name, price, quantity: 1});
    }
    updateBasketDisplay();
    updateItemCount();
}

function toggleDropdown() {
    const dropdown = document.getElementById('basketDropdown');
    if (dropdown.style.display === 'none' || !dropdown.style.display) {
       // showNotification();
        dropdown.style.display = 'block';
        console.log("Dropdown should now be VISIBLE");
    } else {
        dropdown.style.display = 'none';
        console.log("Dropdown should now be HIDDEN");
    }
}


function updateBasketDisplay() {
    const basketItemsList = document.getElementById('basketItemsList');
    const basketTotal = document.getElementById('basketTotal');
    basketItemsList.innerHTML = '';
    let total = 0;

    basket.forEach(item => {
        const listItem = document.createElement('li');
        listItem.classList.add('item-details'); // Add flex layout class
        
        // Create a span for item name and price
        const itemNameAndPrice = document.createElement('span');
        itemNameAndPrice.textContent = `${item.name} x${item.quantity} - £${item.price * item.quantity}`;
        listItem.appendChild(itemNameAndPrice);
        
        // Container for quantity control buttons
        const quantityContainer = document.createElement('div');
        quantityContainer.classList.add('quantity-controls');
        
        // Create a button to decrease quantity
        const decreaseButton = document.createElement('button');
        decreaseButton.innerHTML = '<i class="fas fa-minus"></i>';
        decreaseButton.style.backgroundColor = "#ff0000"; // Change to red
        decreaseButton.style.border = "1px solid #e0e0e0";
        decreaseButton.setAttribute('aria-label', 'Decrease Quantity');
        decreaseButton.addEventListener('click', function() {
            if (item.quantity > 1) {
                item.quantity--;
                updateBasketDisplay();
            } else {
                const index = basket.findIndex(basketItem => basketItem.id === item.id);
                if (index > -1) {
                    basket.splice(index, 1);
                }
                updateBasketDisplay();
            }
        });

        // Create a button to increase quantity
        const increaseButton = document.createElement('button');
        increaseButton.innerHTML = '<i class="fas fa-plus"></i>';
        increaseButton.setAttribute('aria-label', 'Increase Quantity');
        increaseButton.addEventListener('click', function() {
            item.quantity++;
            updateBasketDisplay();
        });

        // Append the buttons to the quantityContainer
        quantityContainer.appendChild(decreaseButton);
        quantityContainer.appendChild(increaseButton);
        
        // Append the quantityContainer to the listItem
        listItem.appendChild(quantityContainer);
        
        basketItemsList.appendChild(listItem);
        total += item.price * item.quantity;
    });
    updateItemCount();
    basketTotal.textContent = total.toFixed(2);
}



function updateItemCount() {
    const itemCountElement = document.getElementById('itemCount');
    let totalItems = 0;

    basket.forEach(item => {
        totalItems += item.quantity;
    });

    itemCountElement.textContent = totalItems;
}



// Assuming there's an endpoint named 'save_order.php' on the server
document.getElementById('checkoutButton').addEventListener('click', function() {
    const email = document.getElementById('customerEmail').value;
    if (!email) {
        showNotification("Please enter your email!");
        return;
    }

    const customerName = document.getElementById('customerName').value;
    if (!customerName) {
        showNotification("Please enter your name!");
        return;
    }

    const requestData = {
        email: email,
        customerName: customerName,
        items: basket,
        total_amount: document.getElementById("basketTotal").textContent
    };

    fetch('save_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            //showNotification("Order saved and email sent!");
            showNotification("Order saved and email sent!");
            basket = [];
            updateBasketDisplay();
        } else {
            
            showNotification("There was an error!");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        showNotification("There was a problem with the network.");
    });
});
function showReservationNotification() {
    showNotification("The reservation feature will be available in the near future.");
    
    // Collapse the navbar after showing the notification
    var navbarCollapse = document.querySelector('.navbar-collapse');
    if (navbarCollapse.classList.contains('show')) {
      new bootstrap.Collapse(navbarCollapse, {
        toggle: true
      });
    }
  }
  $(document).ready(function() {
    $('#feedback-form').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting via the browser.

        var formData = $(this).serialize(); // Serialize the form data.

        $.ajax({
            type: 'POST',
            url: 'send_feedback.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Call your showNotification function with the response message.
                showNotification(response.message);
            },
            error: function(xhr, status, error) {
                // Call your showNotification function with any error message.
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                showNotification('Error - ' + errorMessage);
            }
        });
    });
});
  