


// البحث ضمن مجموعة المساعدات
//بحث عام عن أي شيء ضمن المجموعة

$(document).ready(function() {
    $('input[id^="searchInput-"]').on('keyup', function() {
        var groupId = $(this).attr('id').split('-')[1]; // الحصول على groupId من id المدخل
        var value = $(this).val().toLowerCase();
        // تصفية الصفوف في الجدول الخاص بالمجموعة
        $(`.details-row[data-group-id="${groupId}"] table tbody tr`).filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
    