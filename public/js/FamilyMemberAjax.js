
$.ajax({
    url: '/get-applicant-name?family_id=' + Family_ID,  
    type: 'GET',
    dataType: 'json',
    success: function(data) {
        if (data.status === 'success') {
            $('#Applicant_Name').val(data.Applicant_Name);
        } else {
            $('#Applicant_Name').val('');
        }
    },
    error: function() {
        $('#Applicant_Name').val('');
    }
});
