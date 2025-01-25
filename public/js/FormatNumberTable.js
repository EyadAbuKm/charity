

// تنسيق قيم المبلغ عند تحميل الصفحة باستخدام JavaScript 
// تنسيق القيم الرقمية الخاصة بالمبالغ في خلايا الجدول عند تحميل الصفحة 



    // عند تحميل الصفحة بالكامل  
    document.addEventListener('DOMContentLoaded', function() {  
        // الحصول على جميع خلايا المبلغ بتحديد العناصر بالـ class  
        const amountCells = document.querySelectorAll('.amount');  
        
        // تكرار على كل خلية من خلايا المبلغ  
        amountCells.forEach(cell => {  
            // الحصول على القيمة الخام من خاصية data-amount  
            const rawAmount = cell.getAttribute('data-amount');  
            // تنسيق الرقم مع الفواصل وتحديث النص في الخلية  
            cell.innerText = parseFloat(rawAmount).toLocaleString();  
        });  
    });  