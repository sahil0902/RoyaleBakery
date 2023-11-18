/*===== LOGIN SHOW and HIDDEN =====*/
const signUp = document.getElementById('sign-up'),
      signIn = document.getElementById('sign-in'),
      loginIn = document.getElementById('login-in'),
      loginUp = document.getElementById('login-up');

signUp.addEventListener('click', () => {
    loginIn.classList.add('none');
    loginUp.classList.remove('none');
    loginUp.classList.add('block');
});

signIn.addEventListener('click', () => {
    loginUp.classList.add('none');
    loginIn.classList.remove('none');
    loginIn.classList.add('block');
});

window.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');
    
    // The values for isLoginError and isLoginSuccessful are provided by the PHP script
    console.log('Is login error:', isLoginError);
    console.log('Is login successful:', isLoginSuccessful);

    if (isLoginError) {
        var messageType = 'Error';
        var displayMessage = loginMessage || 'An unknown error occurred.';
        showToast(messageType, displayMessage);
    }
    if (isLoginSuccessful) {
        // If login was successful, delay the success toast by 1 second
        setTimeout(function() {
            showToast(messageType, displayMessage);
        }, 1000); // Delay the success message by 1 second
    }
});

function showToast(type, message) {
    const toastHeader = document.getElementById('toast-header');
    const toastBody = document.getElementById('toast-body');
    const toast = document.getElementById('toast');
    const progress = document.querySelector('.toast .progress');
    const toastIcon = document.querySelector('.toast-content .check'); // Assuming you have an icon with class 'check' inside your toast HTML

    // Set the text
    toastHeader.textContent = type;
    toastBody.textContent = message;

    // Clear previous styles
    toast.classList.remove('toast-success', 'toast-error');
    toastHeader.classList.remove('toast-header-success', 'toast-header-error');
    toastIcon.classList.remove('icon-success', 'icon-error');
    progress.classList.remove('progress-success', 'progress-error');
   // Apply specific classes based on the message type
   if (type === 'Error') {
    toast.classList.add('toast-error');
    toastHeader.classList.add('toast-header-error');
    progress.classList.add('progress-error'); // Add this line to apply the error class to the progress bar
    toastIcon.classList.add('icon-error');
    toastIcon.classList.add('icon-error-bg'); // Add error background class
    toastIcon.classList.add('fa-times');
} else if (type === 'Success') {
    toast.classList.add('toast-success');
    toastHeader.classList.add('toast-header-success');
    progress.classList.add('progress-success'); // Make sure this class exists in your CSS
    toastIcon.classList.add('icon-success');
    toastIcon.classList.add('icon-success-bg'); // Add success background class
    toastIcon.classList.add('fa-check'); // Add check class
}

    // Show the toast
    toast.classList.add('active');
    progress.classList.add('active');

    // Automatically close the toast after 5 seconds
    const timeoutId = setTimeout(() => {
        closeToast();
    }, 5000);

    // Allow manual closing of the toast
    const closeIcon = document.querySelector(".toast .close");
    closeIcon.onclick = function() {
        clearTimeout(timeoutId);
        closeToast();
    };
}

function closeToast() {
    const toast = document.getElementById('toast');
    const progress = document.querySelector('.toast .progress');
    toast.classList.remove('active');
    setTimeout(() => {
        progress.classList.remove('active');
    }, 300);
}
