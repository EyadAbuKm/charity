// public/js/form-validation.js
// To check null inputs Fields

function FormValidationNull() {
    // Select all required inputs
    let requiredFields = document.querySelectorAll('input[required], select[required]');
    let isValid = true;

    requiredFields.forEach(function(field) {
        // If a required field is empty
        if (!field.value.trim()) {
            isValid = false;
            field.style.borderColor = "red"; // Highlight the field in red
        } else {
            field.style.borderColor = ""; // Reset the border color
        }
    });

    if (!isValid) {
        alert("يرجى التأكد من ملء جميع الحقول المطلوبة"); // Alert if any fields are empty
    }

    return isValid; // Prevent form submission if any required field is empty
}
