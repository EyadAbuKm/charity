
//Update Status
// تعديل حالة المساعدات الجماعية
// من معلق إلى موافق

$(document).ready(function() {  
    // عندما يتم تحميل الصفحة، نبدأ بإعداد المستمع على الزر  
    $('.action-button').on('click', function() {  
        var aidId = $(this).data('aid-id'); // الحصول على ID المساعدة من البيانات المرتبطة بالزر  
        var status = $(this).data('status'); // الحصول على الحالة الحالية من البيانات المرتبطة بالزر  
        
        // الاستمرار فقط إذا كانت الحالة 1  
        if (status == 1) {  
            $.ajax({  
                url: '/update-aid-status', // تعديل عنوان URL حسب الضرورة  
                method: 'POST',   // تحديد طريقة الطلب كـ POST  
                data: {  
                    id: aidId,  // تمرير ID المساعدة إلى الخادم  
                    _token: '{{ csrf_token() }}' // تضمين توكن CSRF لأغراض الأمان  
                },  
                success: function(response) {  
                    // هذا الجزء ينفذ عند نجاح الطلب  
                    if (response.status === 'success') {  
                        // تحديث نص الزر إلى "موافق"  
                        $(this).text('موافق').data('status', 2); // تحديث البيانات المرتبطة  

                        // تحديث نص الحقل "Status" في الصف لهذه المساعدة فقط  
                        $(this).closest('tr').find('.status-text').text('موافق').css('color', 'red'); // تحديث نص الحالة                         
                    }  
                }.bind(this), // ربط 'this' للوصول إلى الزر داخل دالة النجاح  
                error: function(xhr) {  
                    // في حالة حدوث خطأ، يمكن طباعة رسالة خطأ  
                    console.error('حدث خطأ:', xhr.responseText);  
                }  
            });  
        } else {  
            // إذا كانت الحالة ليست 1، تجاوز الطلب  
            console.log('تمت الموافقة مُسبقاً');  
        }  
    });  
});  