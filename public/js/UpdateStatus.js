
//Update Status
// تعديل حالة المساعدات الجماعية
// من معلق إلى موافق

    $(document).on('click', '.action-button', function() {
        var button = $(this);
        var aidId = button.data('aid-id');
        var currentStatus = button.data('status');
    
        console.log('Aid ID:', aidId);
        console.log('Current Status:', currentStatus);
    
        // تحقق من الحالة الحالية
        if (currentStatus == 1) {
            var newStatus = 2;
            var buttonText = 'موافق';
            var buttonColor = 'btn-danger'; // اللون الأحمر
    
            // تحديث الزر
            button.data('status', newStatus);
            button.text(buttonText);
            button.removeClass('btn-primary').addClass(buttonColor);
    
            // تخزين الحالة في Local Storage
            localStorage.setItem('aidStatus_' + aidId, newStatus);
    
            // تنفيذ طلب AJAX لتحديث الحالة
            $.ajax({
                url: '/update-aid-status',
                method: 'POST',
                data: {
                    id: aidId,
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Status updated successfully:', response);
                },
                error: function(xhr) {
                    console.error('Error updating status:', xhr);
                    // إعادة الحالة القديمة إذا حدث خطأ
                    button.data('status', currentStatus);
                    button.text('معلق');
                    button.removeClass(buttonColor).addClass('btn-primary');
                }
            });
        }
    });
    
    // استرجاع الحالة من Local Storage عند تحميل الصفحة
    $(document).ready(function() {
        $('.action-button').each(function() {
            var button = $(this);
            var aidId = button.data('aid-id');
            var storedStatus = localStorage.getItem('aidStatus_' + aidId);
    
            if (storedStatus) {
                button.data('status', storedStatus);
                if (storedStatus == 2) {
                    button.text('موافق').removeClass('btn-primary').addClass('btn-danger');
                }
            }
        });
    });
