
// Check Duplicate Family_ID

$(document).ready(function() {
    $('#Family_ID').on('blur', function() {
        var familyID = $(this).val();

        // Clear previous error messages
        $('#family-id-error').text('').hide();

        // Send AJAX request to check for duplicate Family_ID
        $.ajax({
            url: '{{ route("check.Family_ID") }}', // Route to handle the validation
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Laravel CSRF token for security
                Family_ID: familyID
            },
            success: function(response) {
                if (response.status === 'error') {
                    // Display the error message if Family_ID is not unique
                    $('#family-id-error').text(response.message).show();
                }
            }
        });
    });
});