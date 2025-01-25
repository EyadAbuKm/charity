
// Get the dropdown for donation type, the donation details input, and the radio buttons  
const donationTypeDropdown = document.getElementById('donationType'); // Dropdown element for donation type  
const donationDetailsInput = document.getElementById('dt'); // Input element for donation details  
const radioButtons = document.querySelectorAll('input[name="Donation_Type"]'); // Radio buttons for donation type  

// Function to populate the dropdown with specific options  
function populateDropdown(options) {  
    donationTypeDropdown.innerHTML = ''; // Clear previous options in the dropdown  

    // Add each new option to the dropdown  
    options.forEach(option => {  
        const newOption = document.createElement('option'); // Create a new option element  
        newOption.text = option; // Set the text of the option  
        newOption.value = option; // Set the value of the option  
        donationTypeDropdown.add(newOption); // Add the option to the dropdown  
    });  
}  

// Add event listener to each radio button  
radioButtons.forEach(radio => {  
    radio.addEventListener('change', function() {  
        // Check the value of the selected radio button and populate the dropdown accordingly  
        if (this.value === 'عيني') {  
            populateDropdown(['', 'وجبة طعام', 'سلة غذائية', 'منظفات', 'بطانيات']);  
        } else if (this.value === 'كفالة') {  
            populateDropdown(['', 'كفالة يتيم', 'كفالة طالب']);  
        } else if (this.value === 'نقدي') {  
            populateDropdown(['', 'زكاة فطر', 'زكاة مال', 'صدقة', 'صدقة جارية', 'اشتراكات']);  
        }  
    });  
});  

// Add event listener to the dropdown to update the donation details input when a selection is made  
donationTypeDropdown.addEventListener('change', function() {  
    donationDetailsInput.value = this.value; // Update the donation details input value based on the selected dropdown option  
});  

// Consolidated form validation function  
function validateForm(event) {  
    // If no donation type selected  
    const donationType = document.querySelector('input[name="Donation_Type"]:checked');  
    if (!donationType) {  
        event.preventDefault();  
        alert("يرجى اختيار نوع التبرع.");  
        return; // Stop form submission  
    }  

    const selectedDonationType = donationType.value; // Selected type value  
    const rawAmount = document.getElementById('RawAmount').value; // The hidden amount field  

    // If donation type is 'نقدي', validate amount  
    if (selectedDonationType === 'نقدي') {  
        if (rawAmount.trim() === '' || isNaN(rawAmount) || rawAmount <= 0) {  
            event.preventDefault(); // Prevent form submission  
            alert("للتبرعات النقدية، يجب أن يكون المبلغ أكبر من 0.");  
            return; // Stop form submission  
        }  
    }  

    // If all validations pass, submit the form  
}  

// Add submit event listener to the form  
const form = document.querySelector('form');  
form.addEventListener('submit', validateForm);
