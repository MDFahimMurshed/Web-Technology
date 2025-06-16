// Client-side form validation
document.addEventListener('DOMContentLoaded', function() {
    // Login Form Validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            clearErrors('loginForm');
            
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            let isValid = true;
            
            if (username.length < 4) {
                showError('usernameError', 'Username must be at least 4 characters');
                isValid = false;
            }
            
            if (password.length < 6) {
                showError('passwordError', 'Password must be at least 6 characters');
                isValid = false;
            }
            
            if (isValid) {
                this.submit();
            }
        });
    }

    // Registration Form Validation
    const registrationForm = document.getElementById('registrationForm');
    if (registrationForm) {
        registrationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            clearErrors('registrationForm');
            
            const fullname = document.getElementById('fullname').value.trim();
            const email = document.getElementById('email').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const confirmPassword = document.getElementById('confirm_password').value.trim();
            
            let isValid = true;
            
            if (fullname.split(' ').length < 2) {
                showError('fullnameError', 'Please enter your full name (first and last name)');
                isValid = false;
            }
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showError('emailError', 'Please enter a valid email address');
                isValid = false;
            }
            
            const usernameRegex = /^[a-zA-Z0-9]{4,20}$/;
            if (!usernameRegex.test(username)) {
                showError('usernameError', 'Username must be 4-20 characters (letters and numbers only)');
                isValid = false;
            }
            
            const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
            if (!passwordRegex.test(password)) {
                showError('passwordError', 'Password must be at least 8 characters with at least 1 number and 1 special character');
                isValid = false;
            }
            
            if (password !== confirmPassword) {
                showError('confirmPasswordError', 'Passwords do not match');
                isValid = false;
            }
            
            if (isValid) {
                this.submit();
            }
        });
    }

    function clearErrors(formType) {
        const errorElements = document.querySelectorAll(`#${formType} .error-message`);
        errorElements.forEach(element => {
            element.textContent = '';
        });
    }

    function showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.textContent = message;
        }
    }
});