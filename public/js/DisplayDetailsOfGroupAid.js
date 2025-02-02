// عرض تفاصيل المساعدات الجماعية

document.addEventListener('DOMContentLoaded', function () {
    // Handle "عرض التفاصيل" button click
    const buttons = document.querySelectorAll('.show-details');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const groupId = this.getAttribute('data-group-id');
            const detailsRow = document.querySelector(`.details-row[data-group-id="${groupId}"]`);
            
            // Toggle the visibility of the details row
            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = 'table-row';
                this.textContent = 'إخفاء التفاصيل';
            } else {    
                detailsRow.style.display = 'none';
                this.textContent = 'عرض التفاصيل';
            }
        });
    });
});