function validateForm(event) {
    let valid = true;

    // Clear previous error messages
    document.getElementById("errorMessages").innerHTML = "";

    // Get values
    const form = document.forms[0];
    const firstName = form["name"][0].value.trim();
    const lastName = form["name"][1].value.trim();
    const username = form["username"].value.trim();
    const password = form["password"].value;
    const confirmPassword = form["confirm_password"].value;
    const dob = new Date(form["dob"].value);

    // Error list
    let errors = [];

    if (firstName.length < 2) {
        errors.push("First name must be at least 2 characters.");
        valid = false;
    }
    if (lastName.length < 2) {
        errors.push("Last name must be at least 2 characters.");
        valid = false;
    }

    if (!/^[a-z0-9]+$/i.test(username)) {
        errors.push("Username must be alphanumeric.");
        valid = false;
    }

    if (password.length < 6) {
        errors.push("Password must be at least 6 characters.");
        valid = false;
    }

    if (password !== confirmPassword) {
        errors.push("Passwords do not match.");
        valid = false;
    }
    const today = new Date();
    const age = today.getFullYear() - dob.getFullYear();
    if (isNaN(dob) || age < 13 || (age === 13 && today < new Date(dob.getFullYear() + 13, dob.getMonth(), dob.getDate()))) {
        errors.push("You must be at least 13 years old.");
        valid = false;
    }

    if (!valid) {
        document.getElementById("errorMessages").innerHTML = errors
            .map(msg => `<p style="color:red;">${msg}</p>`)
            .join('');
        event.preventDefault();
    }
}
