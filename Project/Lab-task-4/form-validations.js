// Login Form Validation
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset error messages
            document.getElementById('usernameError').innerHTML = '';
            document.getElementById('passwordError').innerHTML = '';
            
            // Get form values
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            let isValid = true;
            
            // Validation 1: Username must be at least 4 characters
            if (username.length < 4) {
                document.getElementById('usernameError').innerHTML = 'Username must be at least 4 characters';
                isValid = false;
            }
            
            // Validation 2: Password must be at least 6 characters
            if (password.length < 6) {
                document.getElementById('passwordError').innerHTML = 'Password must be at least 6 characters';
                isValid = false;
            }
            
            // If all validations pass, submit the form
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
            
            // Reset all error messages
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(element => {
                element.innerHTML = '';
            });
            
            // Get form values
            const fullname = document.getElementById('fullname').value.trim();
            const email = document.getElementById('email').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const confirmPassword = document.getElementById('confirm_password').value.trim();
            
            let isValid = true;
            
            // Validation 1: Full name must be at least 2 words
            if (fullname.split(' ').length < 2) {
                document.getElementById('fullnameError').innerHTML = 'Please enter your full name (first and last name)';
                isValid = false;
            }
            
            // Validation 2: Email must be valid format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').innerHTML = 'Please enter a valid email address';
                isValid = false;
            }
            
            // Validation 3: Username must be 4-20 characters (letters and numbers only)
            const usernameRegex = /^[a-zA-Z0-9]{4,20}$/;
            if (!usernameRegex.test(username)) {
                document.getElementById('usernameError').innerHTML = 'Username must be 4-20 characters (letters and numbers only)';
                isValid = false;
            }
            
            // Validation 4: Password must be at least 8 characters with at least 1 number and 1 special character
            const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
            if (!passwordRegex.test(password)) {
                document.getElementById('passwordError').innerHTML = 'Password must be at least 8 characters with at least 1 number and 1 special character';
                isValid = false;
            }
            
            // Validation 5: Passwords must match
            if (password !== confirmPassword) {
                document.getElementById('confirmPasswordError').innerHTML = 'Passwords do not match';
                isValid = false;
            }
            
            // If all validations pass, submit the form
            if (isValid) {
                this.submit();
            }
        });
    }
});