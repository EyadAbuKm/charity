
// لإظهار الفاصلة العائمة عند إدخال رقم

function formatNumber(input) {  
        // إزالة الفواصل من المدخل  
        const rawValue = input.value.replace(/,/g, '');  
        
        // التأكد من أن القيمة عبارة عن رقم  
        if (!isNaN(rawValue) && rawValue.trim() !== '') {  
            // تنسيق الرقم مع الفواصل  
            input.value = parseFloat(rawValue).toLocaleString();  
            // تحديث القيمة الفعلية في الحقل المخفي  
            document.getElementById('RawAmount').value = rawValue;  
        } else {  
            input.value = ''; // إفراغ المدخل إذا كانت القيمة غير صالحة  
            document.getElementById('RawAmount').value = ''; // إفراغ الحقل المخفي  
        }  
    }  
 
